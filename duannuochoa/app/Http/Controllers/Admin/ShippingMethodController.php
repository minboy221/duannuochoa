<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use App\Http\Requests\Admin\ShippingMethodRequest;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::all();
        return view('admin.shipping-methods.index', compact('shippingMethods'));
    }

    public function create()
    {
        return view('admin.shipping-methods.create');
    }

    public function store(ShippingMethodRequest $request)
    {
        ShippingMethod::create($request->validated());
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Thêm phương thức vận chuyển thành công.');
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-methods.edit', compact('shippingMethod'));
    }

    public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $shippingMethod->update($request->validated());
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Cập nhật phương thức vận chuyển thành công.');
    }

    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Xóa phương thức vận chuyển thành công.');
    }
}
