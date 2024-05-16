<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class CouponManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        //all coupons that are not expired
        $active = Coupon::whereDate('expiration', ">=" , Carbon::today())->get();

        //all coupons that have expired
        $expired = Coupon::whereDate('expiration', "<" , Carbon::today())->get();

        $final = [
            "actifs" => $active,
            "expirés" => $expired,
        ];

        return view('admin.coupons.index', [
            'couponsAll' => $final
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCouponRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->insert($request->all([
            "expiration", "discount", "code"
        ]));

        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Coupon $coupon
     * @return Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', [
            "coupon" => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param Coupon $coupon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $toUpdate = $request->all([
            "discount", "code"
        ]);

        $toUpdate["expiration"] = Carbon::parse(
            str_replace("/","-",$request->get('expiration'))
        )->format('Y-m-d');

        $coupon->update($toUpdate);

        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon
     * @return Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
