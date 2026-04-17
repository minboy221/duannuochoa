<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\Admin\BrandRequest;

class BrandController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');

        $brands = Brand::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        Brand::create($request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Thêm nhãn hàng thành công.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật nhãn hàng thành công.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Xóa nhãn hàng thành công.');
    }
}
