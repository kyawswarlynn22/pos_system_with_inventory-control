<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Models\ActivityLog;
use App\Models\LogoandName;
use App\Models\RetailSaleDetails;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditsClass = new ActivityLog();
        $AccountingClass = new Accounting();
        $topProductsClass = new RetailSaleDetails();
        $audits = $auditsClass->getMetadata();
        $totalExpense = $AccountingClass->expense();
        $totalIncome = $AccountingClass->income();
        $totalCash = $AccountingClass->cash();
        $totalDeposit = $AccountingClass->deposit();
        $totalSaleReturn = $AccountingClass->saleReturn();
        $totalPurchase = $AccountingClass->purchase();
        $topProducts = $topProductsClass->gettopProducts();


        return view(
            'dashboard',
            [
                'audits' => $audits,
                'expense' => $totalExpense,
                'income' => $totalIncome,
                'cash' => $totalCash,
                'purchase' => $totalPurchase,
                'deposit' => $totalDeposit,
                'salereturn' => $totalSaleReturn,
                'topProducts' => $topProducts,
            ]
        );
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
