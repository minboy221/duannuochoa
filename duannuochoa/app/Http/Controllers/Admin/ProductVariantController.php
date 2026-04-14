<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    // Cần truyền product vào phương thức index vì variants thuộc về product
    public function index(Product $product)
    {
        $variants = ProductVariant::where('product_id', $product->product_id)->get();
        return view('admin.variants.index', compact('variants', 'product'));
    }

    public function create(Product $product)
    {
        return view('admin.variants.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'volume_id' => 'required|integer',
            'color' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['product_id'] = $product->product_id;
        ProductVariant::create($data);

        return redirect()->route('admin.products.variants.index', $product)->with('success', 'Thêm biến thể thành công.');
    }

    public function edit(ProductVariant $variant)
    {
        return view('admin.variants.edit', compact('variant'));
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'volume_id' => 'required|integer',
            'color' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $variant->update($request->all());
        return redirect()->route('admin.products.variants.index', $variant->product_id)->with('success', 'Cập nhật biến thể thành công.');
    }

    public function destroy(ProductVariant $variant)
    {
        $productId = $variant->product_id;
        $variant->delete();
        return redirect()->route('admin.products.variants.index', $productId)->with('success', 'Xóa biến thể thành công.');
    }
}
