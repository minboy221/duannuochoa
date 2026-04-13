<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('clien.home');
    }
    //phần giới thiệu
    public function about()
    {
        return view('clien.about');
    }
    //phần sản phẩm
    public function sanpham()
    {
        return view('clien.sanpham');
    }
    //phần liên hệ
    public function lienhe()
    {
        return view('clien.lienhe');
    }
    //phần giỏ hàng
    public function giohang()
    {
        return view('clien.giohang');
    }
    //phần tài khoản người dùng
    public function taikhoan()
    {
        return view('clien.taikhoan');
    }
    //phần đăng nhập, đăng ký
    public function dangnhap()
    {
        return view('clien.dangnhap');
    }
    //phần xem chi tiết sản phẩm
    public function xemchitiet()
    {
        return view('xemchitiet');
    }
    //phần trang admin tổng quan
    public function tongquan()
    {
        return view('admin.tongquan');
    }
    //phần trang qly sản phẩm
    public function qlysanpham()
    {
        return view('admin.qlysanpham');
    }
    //quản lý tài khoản
    public function qlytaikhoan()
    {
        return view('admin.qlytaikhoan');
    }
}
