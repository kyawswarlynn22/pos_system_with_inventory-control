<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getCustomer()
     {
     $data = Customer::where('cus_name','like','%'.request('q').'%')->where('del_flg',0)->paginate(15);
        return response()->json($data);
     }
    public function index()
    {   
        $customerListClass = new Customer();
        $customerList = $customerListClass->customerList();
        return view('Pos.customerList',[
            'customerList' => $customerList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pos.addCustomer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'cus_name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $customerAddClass = new Customer();
        $customerAdd = $customerAddClass->customerAdd($request);
        return redirect('/customer');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customerDetailClass = new Customer();
        $customerDetail = $customerDetailClass->customerDetail($id);
        return view('Pos.editCustomer',[
            'customerDetail' => $customerDetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $customerUpdateClass = new Customer();
        $customerUpdate = $customerUpdateClass->customerUpdate($request,$id);
        return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customerDelClass = new Customer();
        $customerDel = $customerDelClass->customerDel($id);
        return redirect('/customer');
    }

    function search_customer(Request $request)
    {
        $data = $request->input('search_customer');
        $searchData = Customer::where('cus_name','like', '%'.$data .'%')
        ->orwhere('address','like', '%'.$data .'%')
        ->paginate(15);
        return view('Pos.customerList',[
            'customerList' => $searchData
        ]);
    }
}
