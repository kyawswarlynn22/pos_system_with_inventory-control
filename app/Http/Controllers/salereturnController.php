<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\RetailSale;
use App\Models\RetailSaleDetails;
use App\Models\SaleReturn;
use App\Models\SaleReturnDetails;
use Illuminate\Http\Request;

class salereturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saleReturnListClass = new SaleReturn();
        $saleReturnList = $saleReturnListClass->getSaleReturnList();
        return view('Pos.salereturnList', [
            'SaleReturnList' => $saleReturnList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastIdClass = new SaleReturn();
        $lastId = $lastIdClass->getlastId();
        $getProductClass = new Purchase();
        $getProduct = $getProductClass->getProduct();
        $getCustomerClass = new RetailSale();
        $getCustomer = $getCustomerClass->getCustomer();
        return view('Pos.addSalereturn', [
            'lastId' => $lastId,
            'products' => $getProduct,
            'customerList' => $getCustomer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $storeSalereturnClass = new SaleReturn();
        $storeSalereturn = $storeSalereturnClass->storeSaleReturnData($request);

        $getLastId = $storeSalereturnClass->getlastId();

        $updateStockClass = new SaleReturnDetails();
        $updateStock = $updateStockClass->updateSotckCount($getLastId);

        return redirect('/salereturn');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $getSaleReturnClass = new SaleReturn();
        $getSaleReturn = $getSaleReturnClass->getSaleReturn($id);

        $getSaleReturnDetailsClass = new SaleReturnDetails();
        $getSaleReturnDetails = $getSaleReturnDetailsClass->getSaleReturnDetails($id);

        return view('Pos.salereturnDetail', [
            'SaleReturn' => $getSaleReturn,
            'SaleReturnDetail' => $getSaleReturnDetails,
            'InvoiceNo' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getSaleReturnClass = new SaleReturn();
        $getProductClass = new Purchase();
        $getCustomerClass = new RetailSale();
        $getSaleReturn = $getSaleReturnClass->getSaleReturn($id);

        $getSaleReturnDetailsClass = new SaleReturnDetails();
        $getSaleReturnDetails = $getSaleReturnDetailsClass->getSaleReturnDetails($id);

        $getProduct = $getProductClass->getProduct();
        $customerList = $getCustomerClass->getCustomer();

        return view('Pos.editSalereturn', [
            'SaleReturn' => $getSaleReturn,
            'SaleReturnDetail' => $getSaleReturnDetails,
            'customerList' => $customerList,
            'products' => $getProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $updateSalereturnClass = new SaleReturn();
        $updateSalereturn = $updateSalereturnClass->updateSalereturn($request, $id);
        return redirect('/salereturn');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $updateStockCountClass = new SaleReturnDetails();
        $updateSalereturn = $updateStockCountClass->delupdateStockCount($id);

        $delSalereturnClass = new SaleReturn();
        $delSalereturn = $delSalereturnClass->delSaleReturn($id);
        return back();
    }
}
