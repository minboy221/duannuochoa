<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'username' => 'required|string|max:255|unique:users,username',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $data = $request->all();
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
        // Prevent admin from locking themselves out
        if (auth()->id() == $user->user_id) {
             return redirect()->route('admin.users.index')->with('error', 'Không thể khóa tài khoản của chính mình.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'mở khóa' : 'khóa';
        return redirect()->route('admin.users.index')->with('success', "Đã $status tài khoản {$user->username}.");
    }
}
