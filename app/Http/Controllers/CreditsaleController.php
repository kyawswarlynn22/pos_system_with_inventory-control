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
use Illuminate\Support\Facades\DB;

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
        
        // for ($product = 0; $product < count($products); $product++) {
        //     if ($products[$product] != '') {
        //         $takeoutDetails = new TakeoutDetails();
        //         $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
        //         if ($checkstock->count() !== 0) {
        //             return back()->with('fail', 'Stock not enough');
        //         }
        //     }
        // }

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
       
        $creditsale = new Creditsale();
        $updateCashsaleDetailsClass = new CreditsaleDetails();
        $updateProductStockclass = new CreditsaleDetails();
        $cashsaleDetailsClass = new CreditsaleDetails();
        $getsendornot = $creditsale->getsendornot($id);
        if ($getsendornot->sent == 1 && $request->status == 0) {
            $updateProductStock = $updateProductStockclass->delUpdateSotck($id);
        }
        $updateCashsaleDetails = $updateCashsaleDetailsClass->updateCreditDetail($request, $id);

        if ($getsendornot->sent == 1 && $request->status == 1) {
           
        } else {
            $cashsaleDetails = $cashsaleDetailsClass->updateSotckCount($id);
        }
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

    public function todaypaid()
    {
        $timezone = 'Asia/Yangon';
        $currentDate = \Carbon\Carbon::now($timezone);
        $currentDateFormatted = $currentDate->format('Y-m-d');

        $startTime = $currentDateFormatted . ' 00:00:00';
        $endTime = $currentDateFormatted . ' 23:59:59';

        $totalUnpaidamt = Creditsale::where('paid', 1)->where('credit_sale.updated_at', '>=', $startTime)
            ->where('credit_sale.updated_at', '<=', $endTime)
            ->join('customers', 'customers.id', 'credit_sale.customers_id')
            ->select('customers.cus_name', 'discount', 'deposit_paid', 'credit_paid', 'grand_total', 'paid', 'credit_sale.id', DB::raw('DATE(credit_sale.created_at) as date_only'))
            ->where('credit_sale.del_flg', 0)
            ->orderBy('credit_sale.id', 'desc')->paginate(15);

        return view('Pos.todayPaidList', [
            'CashSaleData' => $totalUnpaidamt,
        ]);
    }
}
