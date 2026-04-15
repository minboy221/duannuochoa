<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\UserDiscount;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'discount_id' => 'required|exists:discounts,discount_id'
        ]);

        $user = Auth::user();
        $discount = Discount::findOrFail($request->discount_id);

        // Check if user has enough points
        if ($user->xu < $discount->points_required) {
            return back()->with('error', 'Bạn không đủ xu để đổi voucher này.');
        }

        // Check if already redeemed
        $alreadyRedeemed = UserDiscount::where('user_id', $user->user_id)
            ->where('discount_id', $discount->discount_id)
            ->whereNull('used_at')
            ->exists();

        if ($alreadyRedeemed) {
            return back()->with('error', 'Bạn đã sở hữu voucher này rồi.');
        }

        // Deduct points and save
        $user->xu -= $discount->points_required;
        $user->save();

        UserDiscount::create([
            'user_id' => $user->user_id,
            'discount_id' => $discount->discount_id,
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Đổi voucher thành công!');
    }
}
