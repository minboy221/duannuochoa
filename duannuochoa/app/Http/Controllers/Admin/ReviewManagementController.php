<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product']);

        // Filter by Rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Search by User or Product
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('full_name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('product', function ($pq) use ($search) {
                    $pq->where('name', 'like', "%{$search}%");
                });
            });
        }

        $reviews = $query->latest('created_at')->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $review->status = !$review->status;
        $review->save();

        $message = $review->status ? 'Đã hiển thị đánh giá.' : 'Đã ẩn đánh giá.';
        return redirect()->route('admin.reviews.index')->with('success', $message);
    }
}
