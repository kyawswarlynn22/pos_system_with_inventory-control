<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Usage;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wareProductListClass = new Usage();
        $wareProductList = $wareProductListClass->pendinglist();
        $DamageProductListClass = new Damage();
        $DamageProductList = $DamageProductListClass->pendinglist();
        return view(
            'Pos.warehouseproductpending',[
                'productData' => $wareProductList,
                'damageData' => $DamageProductList,
            ]
        );
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
        $storeproductClass = new Damage();
        $storeproduct = $storeproductClass->storependingList($request);
        return redirect('/damageproduct');
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
        $updateStockClass = new Damage();
        $updateStock = $updateStockClass->updateStockCount($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delProductPending = Damage::find($id);
        if ($delProductPending) {
            $delProductPending->delete();
        }
        return back();
    }
}
