<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $coupons = Coupon::orderBy('expired_at')
            ->get();

        return view('coupons/index', compact('coupons'));
    }

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

        $redeemed = Coupon::whereHas('users', function($q) use ($user_id) {
                            $q->where('user_id', $user_id);
                        })
                        ->where('code', $request['code'])
                        ->get();

        if ($redeemed->isEmpty()) {
            // Race condition here
            sleep(2);
            // Sleep to make it easier to exploit
            $coupon_id = Coupon::where('code', $request['code'])->first()->id;
            $coupon = Coupon::find($coupon_id);
            $coupon->users()->attach($user_id);
            $cart = Cart::where('user_id', $user_id)->first();
            $cart->total_discount += $coupon->discount;
            $cart->save();
            return redirect()->back()->with('success', 'Coupon redeemed successfully!');
        }
        return redirect()->back()->with('failure', 'Coupon already redeemed!');
    }
}
