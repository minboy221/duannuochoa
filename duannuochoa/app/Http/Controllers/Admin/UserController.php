<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->where('role_id', '!=', 1)->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('role_id', '!=', 1)->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công.');
    }

    public function show(User $user)
    {
        if ($user->role_id == 1) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xem chi tiết tài khoản Admin.');
        }
        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role_id == 1) {
             return redirect()->route('admin.users.index')->with('error', 'Không thể thao tác trên tài khoản Admin.');
        }
        if (auth()->id() == $user->user_id) {
             return redirect()->route('admin.users.index')->with('error', 'Không thể khóa tài khoản của chính mình.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'mở khóa' : 'khóa';
        return redirect()->route('admin.users.index')->with('success', "Đã $status tài khoản {$user->username}.");
    }
}
