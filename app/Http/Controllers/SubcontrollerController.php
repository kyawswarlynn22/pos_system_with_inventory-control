<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Subcontroller;
use Illuminate\Http\Request;

class SubcontrollerController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $subCatgeoryAddClass = new SubCategory();
        $subCatgeoryAdd = $subCatgeoryAddClass->addSubcategory($request);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editSubcategoryClass = new SubCategory();
        $editSubcategory = $editSubcategoryClass->editsubCatgory($id);
        $categoryListClass = new Category();
        $categoryList = $categoryListClass->categoryallList();
        return view('Pos.editSubcategory', [
            'subCategory' => $editSubcategory,
            'categoryallList' => $categoryList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $updateSubCategoryClass = new SubCategory();
        $updateSubCategory  = $updateSubCategoryClass->updatesubCategory($request, $id);
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
