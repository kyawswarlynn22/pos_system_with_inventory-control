<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\ExpenseModel;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $storeExpenseClass = new Income();
        $storeExpense = $storeExpenseClass->storeExpensedata($request);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getExpenseDetailClass = new Income();
        $getExpense = $getExpenseDetailClass->getIncome($id);
        return view('Pos.incomeDetail',[
            'incomeDetail' => $getExpense
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getAllExpenseCategoryClass  = new ExpenseCategory();
        $getAllExpenseCategory = $getAllExpenseCategoryClass->expenseCategoryallList();

        $getDetailsClass = new Income();
        $getDetails = $getDetailsClass->getIncomeDetail($id);

        return view('Pos.editIncome',[
            'income' => $getDetails,
            'incomeCategory' => $getAllExpenseCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateExpenseClass = new Income();
       $updateExpense = $updateExpenseClass->updateIncome($request,$id);
       return redirect('/expense');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delIncomeClass  = new Income();
        $delIncome = $delIncomeClass->delIncome($id);
        $delete = Income::find($id);

        if ($delete) {
            $delete->delete();
            return redirect('/expense');
        }
    }
}
