<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockAdjust;
use Illuminate\Http\Request;

class StockAdjustController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productGetDataClass = new StockAdjust();
        $productGetData    = $productGetDataClass->pendingList();

        return view('Pos.productPending', [
            'productData' => $productGetData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productGetDataClass = new Product();
        $productGetData    = $productGetDataClass->productData();
        return view('Pos.stockAdjust', [
            'productData' => $productGetData
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $addAdjustClass = new StockAdjust();
        $addAdjust = $addAdjustClass->addAdjustment($request);
        return back()->withSuccess('Added Succefully');
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
        $editAdjustClass = new StockAdjust();
        $editAdjust = $editAdjustClass->editAdjust($id);

        $productGetDataClass = new Product();
        $productGetData    = $productGetDataClass->productData();
        return view('Pos.editAdjustment', [
            'EditAdjust' => $editAdjust,
            'productData' => $productGetData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateAdjustClass = new StockAdjust();
        $updateAdjust = $updateAdjustClass->updateAdjust($request, $id);
        return redirect('/stockadjustment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
