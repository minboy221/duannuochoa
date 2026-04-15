<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Double check eligibility
        $canReview = Order::where('user_id', $userId)
            ->where('status', 'Đã hoàn thành')
            ->whereHas('orderItems.variant', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })->exists();

        if (!$canReview) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm sau khi đã nhận hàng thành công.');
        }

        // Check if already reviewed (optional, usually users can review only once)
        $existingReview = Review::where('user_id', $userId)->where('product_id', $productId)->first();
        if ($existingReview) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $request->rating,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
