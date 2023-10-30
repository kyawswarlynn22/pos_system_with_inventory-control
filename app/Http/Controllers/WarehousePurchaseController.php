<?php

namespace App\Http\Controllers;

use App\Models\WarehousePurchase;
use App\Models\WarehousePurDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehousePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getPurchaseDataClass = new WarehousePurDetail();
        $getPurchaseData = $getPurchaseDataClass->getPurchaseData();

        $getPurchaseDataClassList = new WarehousePurchase();
        $getPurchaseDataList = $getPurchaseDataClassList->getPurchaseData();

        return view('Pos.warehousePurchaseList', [
            'purchaseData' => $getPurchaseData,
            'purchaseList' => $getPurchaseDataList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getProductClass = new WarehousePurchase();
        $getProduct = $getProductClass->getProduct();
        $getLastId = $getProductClass->getlastId();

        return view('Pos.addwarehousePurchase', [
            'products' => $getProduct,
            'lastId' => $getLastId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $purchaseStoreClass = new WarehousePurchase();
        $purchaseStore = $purchaseStoreClass->storePurchaseData($request);
        $getLastId = $purchaseStoreClass->getlastId();
        $stockUpdateClass = new WarehousePurDetail();
        $stockUpdate = $stockUpdateClass->updateSotckCount($getLastId);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchasedProductsClass = new WarehousePurDetail();
        $purchasedProducts = $purchasedProductsClass->getPurchaseDetail($id);

        $purchaseDetailClass = new WarehousePurchase();
        $purchaseDetail = $purchaseDetailClass->getPurchaseDetail($id);

        return view('Pos.warehousePurchaseDetails', [
            'purchaseDetail' => $purchasedProducts,
            'puchaseDetail' => $purchaseDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editPurchaseClass = new WarehousePurDetail();
        $editPurchase = $editPurchaseClass->getPurchaseDetail($id);
        $getProductClass = new WarehousePurchase();
        $getProduct = $getProductClass->getProduct();
        $grandtotal = $getProductClass->getPurchaseDetail($id);

        return view('Pos.editWarehousePurchase', [
            'products' => $getProduct,
            'PurchaseDetails' => $editPurchase,
            'lastId' => $id,
            'grand_total' => $grandtotal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatePurchasedDetailClass = new WarehousePurchase();
        $stockUpdateClass = new WarehousePurDetail();
        $updatePurchasedDetail = $updatePurchasedDetailClass->updatePurchaseDetail($request, $id);
        $getPurchaseData = $stockUpdateClass->getPurchaseData();

        $stockUpdate = $stockUpdateClass->updateSotckCount($id);
        $getPurchaseDataList = $updatePurchasedDetailClass->getPurchaseData();
        return view(
            'Pos.warehousePurchaseList',
            [
                'purchaseData' => $getPurchaseData,
                'purchaseList' => $getPurchaseDataList,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delWarehousePurchaseClass = new WarehousePurchase();
        $delWarehousePurchase = $delWarehousePurchaseClass->WarehousePurchaseDel($id);
        return back();
    }


    public function getProductDetails(Request $request, $id)
    {
        $price = DB::table('warehouse_product')->where('id', $id)->first(); // Use first() to get a single record

        if ($price) {
            return response()->json($price);
        } else {
            return response()->json(['error' => 'Not found'], 404); // Return a 404 response if the record is not found
        }
    }
}
