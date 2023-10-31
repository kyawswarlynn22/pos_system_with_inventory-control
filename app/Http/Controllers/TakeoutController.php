<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\RetailSale;
use App\Models\RetailSaleDetails;
use App\Models\Takeout;
use App\Models\TakeoutDetails;
use Illuminate\Http\Request;

class TakeoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getCashSaleDataClass = new Takeout();
        $getCashSaleData = $getCashSaleDataClass->getTakeoutData();
        return view('Pos.stockTakeoutList', [
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
        return view('Pos.addStockTakeout', [
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
        // dd($request);
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
        $takeoutStoreClass = new Takeout();
        $takeoutStore = $takeoutStoreClass->storetakeoutData($request);
        $getlastId = $takeoutStoreClass->lastId();
        $takeoutDetailsClass = new TakeoutDetails();
        $takeoutDetails = $takeoutDetailsClass->updateSotckCount($getlastId);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $getDetailsClass = new TakeoutDetails();
        $getDetails = $getDetailsClass->getTakeoutDetail($id);

        $getCashDetailsClass = new Takeout();
        $getCashDetails = $getCashDetailsClass->getTakeoutDetails($id);

        return view('Pos.stockoutDetails', [
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
        $takeoutDataClass = new Takeout();
        $cashsaleDetailsDataClass = new TakeoutDetails();
       
        $cashsaleData = $takeoutDataClass->takeoutData($id);
        $cashsaleDetailsData = $cashsaleDetailsDataClass->getTakeoutDetail($id);

        $getProduct = $cashsaleDataClass->getProduct();
        $customerList = $cashsaleDataClass->getCustomer();

        return view('Pos.editTakeout', [
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
        $updateCashsaleDetailsClass = new Takeout();
        $updateCashsaleDetails = $updateCashsaleDetailsClass->updateCashsaleDetail($request, $id);
        $cashsaleDetailsClass = new TakeoutDetails();
        $cashsaleDetails = $cashsaleDetailsClass->updateSotckCount($id);
        return redirect('/stocktakeout');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteCashClass = new Takeout();
        $deleteCash = $deleteCashClass->takeoutDel($id);
        return back();
    }
}
