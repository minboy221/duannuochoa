<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Http\Requests\Admin\ProductVariantRequest;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    // Cần truyền product vào phương thức index vì variants thuộc về product
    public function index(\Illuminate\Http\Request $request, Product $product)
    {
        $search = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $variants = ProductVariant::where('product_id', $product->product_id)
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('color', 'like', "%{$search}%")
                      ->orWhere('color_code', 'like', "%{$search}%");
                });
            })
            ->when($minPrice != '', function ($query) use ($minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice != '', function ($query) use ($maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->paginate(10);
            
        return view('admin.variants.index', compact('variants', 'product'));
    }

    public function create(Product $product)
    {
        return view('admin.variants.create', compact('product'));
    }

    public function store(ProductVariantRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['product_id'] = $product->product_id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('variants', 'public');
        }

        ProductVariant::create($data);

        return redirect()->route('admin.products.variants.index', $product)->with('success', 'Thêm biến thể thành công.');
    }

    public function edit(ProductVariant $variant)
    {
        return view('admin.variants.edit', compact('variant'));
    }

    public function update(ProductVariantRequest $request, ProductVariant $variant)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($variant->image) {
                Storage::disk('public')->delete($variant->image);
            }
            $data['image'] = $request->file('image')->store('variants', 'public');
        }

        $variant->update($data);
        return redirect()->route('admin.products.variants.index', $variant->product_id)->with('success', 'Cập nhật biến thể thành công.');
    }

    public function destroy(ProductVariant $variant)
    {
        $productId = $variant->product_id;
        
        if ($variant->image) {
            Storage::disk('public')->delete($variant->image);
        }

        $variant->delete();
        return redirect()->route('admin.products.variants.index', $productId)->with('success', 'Xóa biến thể thành công.');
    }
}
