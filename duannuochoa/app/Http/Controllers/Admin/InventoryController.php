<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        
        $query = ProductVariant::with(['product.category', 'product.brand']);

        if ($status === 'low_stock') {
            $query->where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 10);
        } elseif ($status === 'out_of_stock') {
            $query->where('stock_quantity', '<=', 0);
        }

        $variants = $query->latest('variant_id')->paginate(15);
        
        $stats = [
            'total' => ProductVariant::count(),
            'low_stock' => ProductVariant::where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 10)->count(),
            'out_of_stock' => ProductVariant::where('stock_quantity', '<=', 0)->count(),
        ];

        return view('admin.inventory.index', compact('variants', 'stats', 'status'));
    }

    public function updateStock(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'quantity' => 'required|integer|min:0'
        ]);

        $variant = ProductVariant::findOrFail($request->variant_id);
        $variant->stock_quantity = $request->quantity;
        $variant->save();

        // Send alert if stock reaches 0
        if ($variant->stock_quantity <= 0) {
            $adminEmail = env('MAIL_ADMIN_ADDRESS', 'phamtuan20061969@gmail.com');
            try {
                \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\OutOfStockAlert($variant->load('product')));
            } catch (\Exception $e) {
                \Log::error('Manual update out of stock mail error: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true, 
            'message' => 'Cập nhật tồn kho thành công',
            'new_status' => $this->getStatusLabel($variant->stock_quantity)
        ]);
    }

    private function getStatusLabel($quantity)
    {
        if ($quantity <= 0) return 'Hết hàng';
        if ($quantity <= 10) return 'Sắp hết hàng';
        return 'Sẵn có';
    }
}
