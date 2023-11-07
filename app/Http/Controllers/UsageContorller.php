<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Product;
use App\Models\Usage;
use Illuminate\Http\Request;

class UsageContorller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usageanddamageListClass = new Damage();
        $usageListClass = new Usage();
        $usageList = $usageListClass->usageList();
        $damageList = $usageanddamageListClass->damageList();

        return view('Pos.useageanddamageList',[
            'usageList' => $usageList,
            'damageList' => $damageList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productListClass = new Product();
        $productList = $productListClass->getProduct();
        return view('Pos.addandsubstract', [
            'productData' => $productList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeproductClass = new Usage();
        $storeproduct = $storeproductClass->storependingList($request);
        return redirect('/usageproduct');
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
        $updateStockClass = new Usage();
        $updateStock = $updateStockClass->updateStockCount($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delProductPending = Usage::find($id);
        if ($delProductPending) {
            $delProductPending->delete();
        }
        return back();
    }
}
