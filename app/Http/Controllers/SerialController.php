<?php

namespace App\Http\Controllers;

use App\Models\DepositSale;
use App\Models\RetailSale;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //display listing of serial number
    public function index()
    {
        $serialClass = new RetailSale();
        $serial = $serialClass->forserial();
        $serialDepClass = new DepositSale();
        $serialDep = $serialDepClass->forserialdep();

        return view('Pos.serialNoWithCustomer', [
            'serialinCash' => $serial,
            'serialinDeposit' => $serialDep,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
