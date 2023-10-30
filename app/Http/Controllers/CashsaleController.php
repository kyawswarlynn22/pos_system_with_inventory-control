<?php

namespace App\Http\Controllers;

use App\Models\DepositSaleDetails;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\RetailSale;
use App\Models\RetailSaleDetails;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class CashsaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getCashSaleDataClass = new RetailSale();
        $getCashSaleData = $getCashSaleDataClass->getCashSaleData();
        return view('Pos.cashsaleList', [
            'CashSaleData' => $getCashSaleData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastidClass = new RetailSale();
        $lastid = $lastidClass->lastId();
        $customerList = $lastidClass->getCustomer();
        $getProductClass = new Purchase();
        $getProduct = $lastidClass->getProduct();
        return view('Pos.addCashSale', [
            'lastId' => $lastid,
            'customerList' => $customerList,
            'products' => $getProduct,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $serial = $request->input('serial', []);
        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new RetailSaleDetails();
                if ($serial[$product] === null) {
                    return back()->with('fail', 'Add Serial Number');
                }

                $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
                if ($checkstock->count() !== 0) {
                    return back()->with('fail', 'Stock not enough');
                }
            }
        }

        $serials = $request->input('serial', []);
        $cashsaleStoreClass = new RetailSale();

        $existsInCash = RetailSaleDetails::whereIn('serial_no', $serials)->exists();
        $existsInDeposit = DepositSaleDetails::whereIn('serial_no', $serials)->exists();

        if ($existsInCash || $existsInDeposit) {
            return back()->with('fail', 'Serial No already exists');
        } else {
            $cashsaleStore = $cashsaleStoreClass->storeCashsaleData($request);
            $getlastId = $cashsaleStoreClass->lastId();
            $cashsaleDetailsClass = new RetailSaleDetails();
            $cashsaleDetails = $cashsaleDetailsClass->updateSotckCount($getlastId);
        }
        if ($request->has('preorder_id')) {
            return redirect('/preordersale');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getDetailsClass = new RetailSaleDetails();
        $getDetails = $getDetailsClass->getCashsaleDetail($id);

        $getCashDetailsClass = new RetailSale();
        $getCashDetails = $getCashDetailsClass->getCashSaleDetails($id);

        return view('Pos.cashsaleDetails', [
            'CashDetails' => $getDetails,
            'ProductDetails' => $getCashDetails,
            'InvoiceNo' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cashsaleDataClass = new RetailSale();
        $cashsaleDetailsDataClass = new RetailSaleDetails();
        $getProductClass = new Purchase();
        $cashsaleData = $cashsaleDataClass->cashsaleData($id);
        $cashsaleDetailsData = $cashsaleDetailsDataClass->getCashsaleDetail($id);

        $getProduct = $cashsaleDataClass->getProduct();
        $customerList = $cashsaleDataClass->getCustomer();

        return view('Pos.editCashsale', [
            'CashsaleData' => $cashsaleData,
            'CashsaleDetailData' => $cashsaleDetailsData,
            'customerList' => $customerList,
            'products' => $getProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $updateCashsaleDetailsClass = new RetailSale();
        $updateCashsaleDetails = $updateCashsaleDetailsClass->updateCashsaleDetail($request, $id);
        $cashsaleDetailsClass = new RetailSaleDetails();
        $cashsaleDetails = $cashsaleDetailsClass->updateSotckCount($id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteCashClass = new RetailSale();
        $deleteCash = $deleteCashClass->cashSaleDel($id);
        return back();
    }
}
