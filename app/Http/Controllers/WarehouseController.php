<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productListClass = new Warehouse();
        $productList = $productListClass->getProductList();
        return view('Pos.warhouseProductList', [
            'productData' => $productList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pos.addwarehouseproduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $addProductClass = new Warehouse();
        $addProduct = $addProductClass->addProducts($request);
        return redirect('/warehouse');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productDetailClass = new Warehouse();
        $productDetail = $productDetailClass->getProductDetail($id);
        return view('Pos.editWarehouseProductList', [
            'productDetail' => $productDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateProduct = Warehouse::find($id);
        if ($updateProduct) {
            $updateProduct->update([
                'product_name' => $request->product_name,
                'buy_price' => $request->price,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect('/warehouse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productDelClass = new Warehouse();
        $productDel = $productDelClass->productDel($id);
        return redirect('/warehouse');
    }
}
