<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');
        $role_id = $request->input('role_id');

        $users = User::with('role')->where('role_id', '!=', 1)
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($role_id, function ($query, $role_id) {
                return $query->where('role_id', $role_id);
            })
            ->paginate(10);

        $roles = Role::where('role_id', '!=', 1)->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        // Chỉ lấy các role dành cho staff quản trị (loại trừ Admin=1 và User=2)
        $roles = Role::whereNotIn('role_id', [1, 2])->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        
        // Tự động sinh mật khẩu ngẫu nhiên
        $plainPassword = \Illuminate\Support\Str::random(8);
        $data['password'] = Hash::make($plainPassword);

        $user = User::create($data);

        // Gửi email thông báo cho Nhân viên/User
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\StaffInviteMail($user, $plainPassword));

        return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công. Thông tin đăng nhập đã được gửi tới email của người dùng.');
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
