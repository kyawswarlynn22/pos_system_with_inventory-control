<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function getProduct()
     {
     $data = Product::where('product_name','like','%'.request('q').'%')->where('del_flg',0)->paginate(15);
        return response()->json($data);
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productAllDataClass = new Product();
        $productAllData = $productAllDataClass->productAllData();
        $chargeandfees = $productAllDataClass->chargesAndServices();
        return view('Pos.productList', [
            'productData' => $productAllData,
            'chargesandfees' => $chargeandfees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryListClass = new Category();
        $categoryList = $categoryListClass->categoryallList();

        $subcategoryListClass = new SubCategory();
        $subcategoryList = $subcategoryListClass->subCategoryAllList();

        return view('Pos.addProduct', [
            'categorylist' => $categoryList,
            'subcategorylist' => $subcategoryList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {

        $validateData = $request->validate([
            'p_code' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'photo1' => 'required',
        ]);

        $exists = Product::where('p_code', $request->p_code)->exists();
        $existsProduct = Product::where('product_name', $request->product_name)->exists();
        
        if ($exists) {
            // return redirect('/product/create')->withSuccess('Serial No already exists');
            return redirect()->back()->with('fail', 'Item Code already exists');
        }

        if ($existsProduct) {
            // return redirect('/product/create')->withSuccess('Product name already exists');
            return redirect()->back()->with('fail', 'Product Name already exists');
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->p_code = $request->p_code;
        $product->categories_id = $request->category;
        $product->sub_categories_id = $request->subcategory;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;

        if ($request->hasFile('photo1')) {
            $extension = $request->file('photo1')->extension();
            $filename = time() . '.' . $request->file('photo1')->getClientOriginalName() . $extension;
            $path3 = 'sksproducts/' . $filename;
            $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo1')->getRealPath()), 'public');
            $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
            $pathOne = $linkpath . $filename;
            $product->p_one = $pathOne;
        }
        if ($request->hasFile('photo2')) {
            $extension = $request->file('photo2')->extension();
            $filename = time() . '.' . $request->file('photo2')->getClientOriginalName() . $extension;
            $path3 = 'sksproducts/' . $filename;
            $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo2')->getRealPath()), 'public');
            $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
            $pathTwo = $linkpath . $filename;
            $product->p_two = $pathTwo;
        }
        if ($request->hasFile('photo3')) {
            $extension = $request->file('photo3')->extension();
            $filename = time() . '.' . $request->file('photo3')->getClientOriginalName() . $extension;
            $path3 = 'sksproducts/' . $filename;
            $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo3')->getRealPath()), 'public');
            $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
            $pathThree = $linkpath . $filename;
            $product->p_three = $pathThree;
        }
        if ($request->hasFile('photo4')) {
            $extension = $request->file('photo4')->extension();
            $filename = time() . '.' . $request->file('photo4')->getClientOriginalName() . $extension;
            $path3 = 'sksproducts/' . $filename;
            $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo4')->getRealPath()), 'public');
            $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
            $pathFour = $linkpath . $filename;
            $product->p_four = $pathFour;
        }
        $product->save();

        return redirect('/product/create')->withSuccess('Added Product Succefully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productDetailClass = new Product();
        $productDetail = $productDetailClass->productDetails($id);
        return view('Pos.productDetails', [
            'productDetail' => $productDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productDetailClass = new Product();
        $productDetail = $productDetailClass->productEdit($id);

        $categoryListClass = new Category();
        $categoryList = $categoryListClass->categoryallList();

        $subcategoryListClass = new SubCategory();
        $subcategoryList = $subcategoryListClass->subCategoryAllList();
        return view('Pos.editProduct', [
            'productDetail' => $productDetail,
            'categorylist' => $categoryList,
            'subcategorylist' => $subcategoryList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'p_code' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);
        $productdetail = Product::find($id);
        if ($productdetail) {
            $updateData = [
                'product_name' => $request->product_name,
                'p_code' => $request->p_code,
                'categories_id' => $request->category,
                'sub_categories_id' => $request->subcategory,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
            ];

            if ($request->hasFile('photo1')) {
                $extension = $request->file('photo1')->extension();
                $filename = time() . '.' . $request->file('photo1')->getClientOriginalName() . $extension;
                $path3 = 'sksproducts/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo1')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
                $pathOne = $linkpath . $filename;
                $updateData['p_one'] = $pathOne;
            }
            if ($request->hasFile('photo2')) {
                $extension = $request->file('photo2')->extension();
                $filename = time() . '.' . $request->file('photo2')->getClientOriginalName() . $extension;
                $path3 = 'sksproducts/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo2')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
                $pathTwo = $linkpath . $filename;
                $updateData['p_two'] = $pathTwo;
            }
            if ($request->hasFile('photo3')) {
                $extension = $request->file('photo3')->extension();
                $filename = time() . '.' . $request->file('photo3')->getClientOriginalName() . $extension;
                $path3 = 'sksproducts/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo3')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
                $pathThree = $linkpath . $filename;
                $updateData['p_three'] = $pathThree;
            }
            if ($request->hasFile('photo4')) {
                $extension = $request->file('photo4')->extension();
                $filename = time() . '.' . $request->file('photo4')->getClientOriginalName() . $extension;
                $path3 = 'sksproducts/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('photo4')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/sksproducts/";
                $pathFour = $linkpath . $filename;
                $updateData['p_four'] = $pathFour;
            }
            $productdetail->update($updateData);
        }
        return redirect('/product')->withSuccess('Edited Product Succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productdetail = Product::find($id);
        if ($productdetail) {
            $productdetail->update([
                'del_flg' => 1,
            ]);
        }
        return redirect('/product')->withSuccess('Product Delete  Succefully');
    }
}
