<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $data = $request->only('full_name', 'phone', 'address');

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists and not default
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Hồ sơ đã được cập nhật thành công!');
    }
}
