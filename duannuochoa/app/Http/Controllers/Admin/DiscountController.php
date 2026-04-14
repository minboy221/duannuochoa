<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Http\Requests\Admin\DiscountRequest;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(DiscountRequest $request)
    {
        Discount::create($request->validated());
        return redirect()->route('admin.discounts.index')->with('success', 'Thêm mã giảm giá thành công.');
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());
        return redirect()->route('admin.discounts.index')->with('success', 'Cập nhật mã giảm giá thành công.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Xóa mã giảm giá thành công.');
    }
}
