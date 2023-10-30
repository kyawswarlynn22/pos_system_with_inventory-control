<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\StockAdjust;
use App\Models\Warehouse;
use App\Models\Warehousedb;
use Illuminate\Http\Request;

class WarehouseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wareProductListClass = new Warehousedb();
        $wareProductList = $wareProductListClass->pendinglist();
        $DamageProductListClass = new Damage();
        $DamageProductList = $DamageProductListClass->pendinglist();
        return view(
            'Pos.warehouseproductpending',
            [
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
        $productListClass = new Warehouse();
        $productList = $productListClass->getProductList();
        return view('Pos.addandsubstract', [
            'productData' => $productList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeproductClass = new Warehousedb();
        $storeproduct = $storeproductClass->storependingList($request);
        return back();
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
        $editAdjustClass = new Warehousedb();
        $editAdjust = $editAdjustClass->editAdjust($id);

        $getproductClass = new Warehouse();
        $getproduct = $getproductClass->productlist($id);

        return view('Pos.editconfrimstock',[
            'EditAdjust' => $editAdjust,
            'productData' => $getproduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $updateStockClass = new Warehouse();
       $updateStock = $updateStockClass->updateStockCount($request,$id);
       return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delProductPending = Warehousedb::find($id);
        if ($delProductPending) {
            $delProductPending->delete();
        }
        return back();
    }
}
