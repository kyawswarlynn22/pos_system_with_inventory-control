<?php

namespace App\Http\Controllers;

use App\Models\Creditsale;
use App\Models\CreditsaleDetails;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\RetailSale;
use App\Models\Takeout;
use App\Models\TakeoutDetails;
use Illuminate\Http\Request;

class CreditsaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getCashSaleDataClass = new Creditsale();
        $getCashSaleData = $getCashSaleDataClass->getCreditData();
        return view('Pos.creditSaleList', [
            'CashSaleData' => $getCashSaleData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastidClass = new RetailSale();
        $takeoutId = new Takeout();
        $lastid = $takeoutId->lastId();
        $customerList = $lastidClass->getCustomer();
        $getProductClass = new Purchase();
        $getProduct = $lastidClass->getProduct();
        return view('Pos.addCreditsale', [
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
                $takeoutDetails = new TakeoutDetails();
                $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
                if ($checkstock->count() !== 0) {
                    return back()->with('fail', 'Stock not enough');
                }
            }
        }
        $takeoutStoreClass = new Creditsale();
        $takeoutStore = $takeoutStoreClass->addCreditSale($request);
        $getlastId = $takeoutStoreClass->lastId();
        $takeoutDetailsClass = new CreditsaleDetails();
        $takeoutDetails = $takeoutDetailsClass->updateSotckCount($getlastId);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getDetailsClass = new CreditsaleDetails();
        $getDetails = $getDetailsClass->getCreditDetail($id);

        $getCashDetailsClass = new Creditsale();
        $getCashDetails = $getCashDetailsClass->getCreditDetails($id);

        return view('Pos.creditsaleDetails', [
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
        $takeoutDataClass = new Creditsale();
        $cashsaleDetailsDataClass = new CreditsaleDetails();
       
        $cashsaleData = $takeoutDataClass->creditData($id);
        $cashsaleDetailsData = $cashsaleDetailsDataClass->getCreditDetail($id);

        $getProduct = $cashsaleDataClass->getProduct();
        $customerList = $cashsaleDataClass->getCustomer();

        return view('Pos.editCreditSale', [
           
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
      
        $updateCashsaleDetailsClass = new CreditsaleDetails();
        $updateCashsaleDetails = $updateCashsaleDetailsClass->updateCreditDetail($request, $id);
        $cashsaleDetailsClass = new CreditsaleDetails();
        $cashsaleDetails = $cashsaleDetailsClass->updateSotckCount($id);
        return redirect('/creditsale');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteCashClass = new Creditsale();
        $deleteCash = $deleteCashClass->creditDel($id);
        return back();
    }
}