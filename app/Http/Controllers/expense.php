<?php

namespace App\Http\Controllers;

use App\Models\Expense as ModelsExpense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseModel;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class expense extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getExpenseAllListClass = new ExpenseModel();
        $getExpenseAllList = $getExpenseAllListClass->getExpenseList();

        $getIncomeAllListClass = new Income();
        $getIncomeAllList = $getIncomeAllListClass->getIncomeList();
        return view('Pos.expenseList', [
            'expenseList' => $getExpenseAllList,
            'incomeList' => $getIncomeAllList,
        ]);
    }

    public function datefilter($request)
    {
        
        $getExpenseAllListClass = new ExpenseModel();
        $getExpenseAllList = $getExpenseAllListClass->datefilter($request);

        // $getIncomeAllListClass = new Income();
        // $getIncomeAllList = $getIncomeAllListClass->getIncomeList();
        return view('Pos.expenseList', [
            'expenseList' => $getExpenseAllList,
            // 'incomeList' => $getIncomeAllList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getAllExpenseCategoryClass  = new ExpenseCategory();
        $getAllExpenseCategory = $getAllExpenseCategoryClass->expenseCategoryallList();
        return view('Pos.addExpense', [
            'expeseCategory' => $getAllExpenseCategory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeExpenseClass = new ExpenseModel();
        $storeExpense = $storeExpenseClass->storeExpensedata($request);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getExpenseDetailClass = new ExpenseModel();
        $getExpense = $getExpenseDetailClass->getExpense($id);
        return view('Pos.expenseDetail', [
            'expenseDetail' => $getExpense
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getAllExpenseCategoryClass  = new ExpenseCategory();
        $getAllExpenseCategory = $getAllExpenseCategoryClass->expenseCategoryallList();
        $getExpenseDetailClass = new ExpenseModel();
        $getExpenseDetail = $getExpenseDetailClass->getExpenseDetail($id);
        return view('Pos.editExpense', [
            'ExpenseDetail' => $getExpenseDetail,
            'expeseCategory' => $getAllExpenseCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateExpenseClass = new ExpenseModel();
        $updateExpense = $updateExpenseClass->updateExpense($request, $id);
        return redirect('/expense');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = ExpenseModel::find($id);
        $delExpenseClass = new ExpenseModel();
        $delExpense = $delExpenseClass->delExpense($id);
        if ($delete) {
            $delete->delete();
            return redirect('/expense');
        }
    }
}
