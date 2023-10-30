<?php

namespace App\Http\Controllers;

use App\Models\Accounting;
use App\Models\CashThb;
use App\Models\DailyCih;
use App\Models\DepositSale;
use App\Models\ExpenseModel;
use App\Models\Income;
use App\Models\Purchase;
use App\Models\RetailSale;
use App\Models\SaleReturn;
use App\Models\WarehousePurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AccountingClass = new Accounting();
        $CashTHB = new CashThb();
        $totalExpense = $AccountingClass->expense();
        $totalIncome = $AccountingClass->income();
        $totalPurchase = $AccountingClass->purchase();
        $totalCash = $AccountingClass->cash();
        $totalDeposit = $AccountingClass->deposit();
        $totalSaleReturn = $AccountingClass->saleReturn();
        $closeornotClass = new DailyCih();
        $maxid = $closeornotClass::max('id');
        $closeornot = $closeornotClass->checkCloseOrnot($maxid);
        $lastCIHAmt = $closeornotClass->lasCIHamt();
        $lastCIHTHB = $CashTHB->lasCIHamt();


        // dd($totalExpense,$totalIncome,$totalPurchase,$totalCash,$totalDeposit,$totalSaleReturn);
        return view('Pos.accounting', [
            'expense' => $totalExpense,
            'income' => $totalIncome,
            'purchase' => $totalPurchase,
            'cash' => $totalCash,
            'deposit' => $totalDeposit,
            'salereturn' => $totalSaleReturn,
            'salecolse' => $closeornot,
            'cashinhand' => $lastCIHAmt,
            'cashinhandThb' => $lastCIHTHB,
           
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $income = Income::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->sum('amount');
        $expenses = ExpenseModel::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->sum('amount');
        $purchase = Purchase::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->sum('grand_total');
        
        $cash = RetailSale::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->sum('grand_total');
        $deposit = DepositSale::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->sum('pre_deposit');
        $salereturn = SaleReturn::whereBetween('created_at', [$startDate, $endDate])
            ->sum('grand_total');

        return view('Pos.accountdate', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expense' => $expenses,
            'income' => $income,
            'purchase' => $purchase,
            'cash' => $cash,
            'deposit' => $deposit,
            'salereturn' => $salereturn,
           
        ]);
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
