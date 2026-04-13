<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        if (!session('otp_verified')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    public function reset(ResetPasswordRequest $request)
    {
        if (!session('otp_verified')) {
            return redirect()->route('password.request');
        }

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);

            // Cleanup OTPs
            DB::table('otps')->where('email', $email)->where('type', 'forgot')->delete();

            session()->forget(['reset_email', 'otp_verified']);

            return redirect()->route('login')->with('success', 'Mật khẩu của bạn đã được cập nhật thành công.');
        }

        return back()->withErrors(['email' => 'Không tìm thấy người dùng.']);
    }
}
