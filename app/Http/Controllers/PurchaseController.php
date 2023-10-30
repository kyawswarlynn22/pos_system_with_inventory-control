<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getPurchaseDataClass = new Purchase();
        $getPurchaseData = $getPurchaseDataClass->getPurchaseData();
        $getPurchaseProducts = $getPurchaseDataClass->getPurchaseProduct();
       
        return view('Pos.purchaseList', [
            'purchaseData' => $getPurchaseData,
            'purchaseList' => $getPurchaseProducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getProductClass = new Purchase();
        $getProduct = $getProductClass->getProduct();
        $getLastId = $getProductClass->getlastId();

        return view('Pos.addpurchase', [
            'products' => $getProduct,
            'lastId' => $getLastId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchaseStoreClass = new Purchase();
        $purchaseStore = $purchaseStoreClass->storePurchaseData($request);
        $getLastId = $purchaseStoreClass->getlastId();
        $stockUpdateClass = new PurchaseDetails();
        $stockUpdate = $stockUpdateClass->updateSotckCount($getLastId);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $purchasedProductsClass = new PurchaseDetails();
        $purchasedProducts = $purchasedProductsClass->getPurchaseDetail($id);

        $purchaseDetailClass = new Purchase();
        $purchaseDetail = $purchaseDetailClass->getPurchaseDetail($id);

        return view('Pos.purchaseDetails', [
            'purchaseDetail' => $purchasedProducts,
            'puchaseDetail' => $purchaseDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editPurchaseClass = new PurchaseDetails();
        $editPurchase = $editPurchaseClass->getPurchaseDetail($id);
        $getProductClass = new Purchase();
        $getProduct = $getProductClass->getProduct();
        $grandtotal = $getProductClass->getPurchaseDetail($id);

        return view('Pos.editPurchase', [
            'products' => $getProduct,
            'PurchaseDetails' => $editPurchase,
            'lastId' => $id,
            'grand_total' => $grandtotal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $updatePurchasedDetailClass = new Purchase();
        $updatePurchasedDetail = $updatePurchasedDetailClass->updatePurchaseDetail($request, $id);
        $getPurchaseData = $updatePurchasedDetailClass->getPurchaseData();
        $stockUpdateClass = new PurchaseDetails();
        $stockUpdate = $stockUpdateClass->updateSotckCount($id);
        return redirect('/purchase');
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function getProductDetails(Request $request, $id)
    {
        $price = DB::table('products')->where('id', $id)->first(); // Use first() to get a single record

        if ($price) {
            return response()->json($price);
        } else {
            return response()->json(['error' => 'Not found'], 404); // Return a 404 response if the record is not found
        }
    }
}
