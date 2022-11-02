<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CouponFixController extends Controller
{
    /**
     * Display cart of products.
     *
     * @return View
     */
    public function cart()
    {
        $user_id = Auth::id();
        $sum = 1000;
        $discount = 0;

        $cart = Cart::where('user_id', $user_id)->first();

        $discount += $cart->total_discount;

        return view('coupons/cart', compact('sum', 'discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function apply(CouponRequest $request)
    {
        $user_id = Auth::id();
        $updated = 0;

        DB::transaction(function () use ($user_id, $request, &$updated) {
            $redeemed = Coupon::whereHas('users', function($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })
                ->where('code', $request['code'])
                ->lockForUpdate()
                ->get();

            if ($redeemed->isEmpty()) {
                $coupon_id = Coupon::where('code', $request['code'])->first()->id;
                $coupon = Coupon::find($coupon_id);
                $coupon->users()->attach($user_id);
                $cart = Cart::where('user_id', $user_id)->lockForUpdate()->first();
                $cart->total_discount += $coupon->discount;
                $cart->save();
                $updated = 1;
            }
        }, 3);

        if ($updated) {
            return redirect()->back()->with('success', 'Coupon redeemed successfully!');
        } else {
            return redirect()->back()->with('failure', 'Coupon already redeemed!');
        }
    }
}
