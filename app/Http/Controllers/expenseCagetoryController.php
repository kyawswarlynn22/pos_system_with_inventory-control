<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class expenseCagetoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getExpenseCategoryListClass = new ExpenseCategory();
        $getExpenseCategoryList = $getExpenseCategoryListClass->getExpenseList();
        return view('Pos.addexpenseCategory', [
            'ExpenseCategoryList' => $getExpenseCategoryList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $addCategoryClass = new ExpenseCategory();
        $addCategory = $addCategoryClass->expenseCategoryAdd($request);
        return redirect('/expenseCategory/create');
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
        $getExpenseCategoryDetailsClass = new ExpenseCategory();
        $getExpenseCategoryDetails = $getExpenseCategoryDetailsClass->expenseCategoryDetail($id);
        return view('Pos.editExpenseCategory',[
            'CategoryDetails' => $getExpenseCategoryDetails,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateExpenseClass = new ExpenseCategory();
        $updateExpense = $updateExpenseClass->expenseCategoryUpdate($request,$id);
        return redirect('/expenseCategory/create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
