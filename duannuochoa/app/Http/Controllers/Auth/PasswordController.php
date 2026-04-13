<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $otp = sprintf("%06d", mt_rand(1, 999999));
        $expiresAt = Carbon::now()->addMinutes(10);

        DB::table('otps')->where('email', $user->email)->where('type', 'change')->delete();

        DB::table('otps')->insert([
            'email' => $user->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'type' => 'change',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, 'change'));

        session([
            'change_password_new' => $request->new_password,
            'change_password_otp_sent' => true
        ]);

        return redirect()->route('password.change.otp.form')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }

    public function showOtpForm()
    {
        if (!session('change_password_otp_sent')) {
            return redirect()->route('password.change');
        }
        return view('auth.verify-change-otp');
    }

    public function update(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        
        $user = Auth::user();
        $newPassword = session('change_password_new');

        $otpRecord = DB::table('otps')
            ->where('email', $user->email)
            ->where('otp', $request->otp)
            ->where('type', 'change')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
        }

        $user->update(['password' => Hash::make($newPassword)]);

        DB::table('otps')->where('id', $otpRecord->id)->delete();
        session()->forget(['change_password_new', 'change_password_otp_sent']);

        return redirect()->route('password.change')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
