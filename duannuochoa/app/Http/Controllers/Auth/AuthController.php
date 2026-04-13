<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        $expiresAt = Carbon::now()->addMinutes(10);

        // Delete old OTPs for this email
        DB::table('otps')->where('email', $request->email)->where('type', 'register')->delete();

        // Save new OTP
        DB::table('otps')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'type' => 'register',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Send OTP via Mail
        Mail::to($request->email)->send(new OtpMail($otp, 'register'));

        // Store registration data in session temporarily
        session([
            'register_data' => $request->only('username', 'full_name', 'email', 'password', 'phone', 'address'),
            'register_email' => $request->email
        ]);

        return redirect()->route('register.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }

    public function showRegisterOtpForm()
    {
        if (!session('register_data')) {
            return redirect()->route('register');
        }
        return view('auth.verify-register-otp');
    }

    public function verifyRegisterOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string|size:6']);
        $email = session('register_email');
        $registerData = session('register_data');

        if (!$registerData) {
            return redirect()->route('register');
        }

        $otpRecord = DB::table('otps')
            ->where('email', $email)
            ->where('otp', $request->otp)
            ->where('type', 'register')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
        }

        // Create User
        User::create([
            'username' => $registerData['username'],
            'full_name' => $registerData['full_name'],
            'email' => $registerData['email'],
            'password' => Hash::make($registerData['password']),
            'phone' => $registerData['phone'],
            'address' => $registerData['address'],
            'role_id' => 2, // Default role: User
        ]);

        // Cleanup
        DB::table('otps')->where('id', $otpRecord->id)->delete();
        session()->forget(['register_data', 'register_email']);

        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Chào mừng bạn quay lại!');
        }

        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Bạn đã đăng xuất.');
    }
}
