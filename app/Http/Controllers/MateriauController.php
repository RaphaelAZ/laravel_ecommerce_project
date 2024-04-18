<?php

namespace App\Http\Controllers;

use App\Models\Materiau;
use App\Http\Requests\StoreMateriauRequest;
use App\Http\Requests\UpdateMateriauRequest;

class MateriauController extends Controller
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
     * @param  \App\Http\Requests\StoreMateriauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMateriauRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function show(Materiau $materiau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiau $materiau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMateriauRequest  $request
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMateriauRequest $request, Materiau $materiau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiau $materiau)
    {
        //
    }
}
