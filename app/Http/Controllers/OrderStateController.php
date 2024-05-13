<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderStateRequest;
use App\Http\Requests\UpdateOrderStateRequest;
use App\Models\OrderState;

class OrderStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderStateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderState  $order_state
     * @return \Illuminate\Http\Response
     */
    public function show(OrderState $order_state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderState  $order_state
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderState $order_state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderStateRequest  $request
     * @param  \App\Models\OrderState  $order_state
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStateRequest $request, OrderState $order_state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderState  $order_state
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderState $order_state)
    {
        //
    }
}
