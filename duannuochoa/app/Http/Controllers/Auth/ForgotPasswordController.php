<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = sprintf("%06d", mt_rand(1, 999999));
        $expiresAt = Carbon::now()->addMinutes(10);

        // Delete old OTPs for this email
        DB::table('otps')->where('email', $request->email)->where('type', 'forgot')->delete();

        // Save new OTP
        DB::table('otps')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'type' => 'forgot',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Mail::to($request->email)->send(new OtpMail($otp, 'forgot'));

        session(['reset_email' => $request->email]);

        return redirect()->route('password.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }

    public function showOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $email = session('reset_email');

        $otpRecord = DB::table('otps')
            ->where('email', $email)
            ->where('otp', $request->otp)
            ->where('type', 'forgot')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
        }

        // Mark as verified
        DB::table('otps')->where('id', $otpRecord->id)->update(['is_verified' => true]);
        
        session(['otp_verified' => true]);

        return redirect()->route('password.reset.form')->with('success', 'Xác thực OTP thành công. Vui lòng đặt lại mật khẩu.');
    }
}
