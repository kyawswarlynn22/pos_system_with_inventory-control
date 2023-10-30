<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usageanddamageListClass = new Damage();
        $usageList = $usageanddamageListClass->usageList();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeproductClass = new Damage();
        $storeproduct = $storeproductClass->storependingList($request);
        return redirect('/warehouseadjustment');
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
       $updateStock = $updateStockClass->updateStockCount($request,$id);
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
