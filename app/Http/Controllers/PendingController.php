<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockAdjust;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productAllDataClass = new Product();
        $productAllData = $productAllDataClass->productAllData();
        return view('Pos.productPending', [
            'productData' => $productAllData
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $updateStockClass = new Product();
        $updateStock = $updateStockClass->updateStock($id);
        return back();
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
        $stockAdjustClass = new Product();
        $stockAdjust = $stockAdjustClass->updateStockCount($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
