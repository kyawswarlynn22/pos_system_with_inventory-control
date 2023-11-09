<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class DepositSale extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'deposit_sales';

    protected $fillable = ['customers_id ', 'pur_date', 'discount', 'grand_total', 'deposit', 'credit', 'paid', 'remark', 'del_flg'];

    public function getDepositsaleData()
    {
        return $depositSale = DepositSale::join('customers', 'customers.id', 'deposit_sales.customers_id')
            ->join('deposit_sale_details', 'deposit_sales_id', 'deposit_sales.id')
            ->select('customers.cus_name', 'pur_date', 'paid', 'deposit', 'credit', 'grand_total', 'deposit_sales.id',DB::raw('DATE(deposit_sales.pur_date) as date_only'))
            ->where('deposit_sales.del_flg', 0)
            ->groupBy('customers.cus_name', 'pur_date', 'paid', 'deposit', 'credit', 'grand_total', 'deposit_sales.id')
            ->orderBy('deposit_sales.id', 'desc')
            ->paginate(15);
    }

    public function getDepositDetail($id)
    {
        return $cashSaleDetails = DepositSale::join('customers', 'deposit_sales.customers_id', 'customers.id')
            ->join('deposit_sale_details', 'deposit_sales_id', 'deposit_sales.id')
            ->where('deposit_sales.id', $id)
            ->select('pur_date', 'discount', 'paid', 'credit', 'deposit', 'grand_total', 'remark', 'customers.*',DB::raw('DATE(deposit_sales.pur_date) as date_only'))
            ->first();
    }

    public function getlastId()
    {
        return DepositSale::max('id');
    }

    public function storeDepositSale($request)
    {
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $serial = $request->input('serial', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new RetailSaleDetails();

              
            }
        }

        $existsInCash = RetailSaleDetails::whereIn('serial_no', $serial)->exists();
        $existsInDeposit = DepositSaleDetails::where('serial_no', $serial)->exists();

        if ($existsInCash) {
            return redirect()->back()->with('fail', 'Serial No already exists');
        }

        if ($existsInDeposit) {
            return redirect()->back()->with('fail', 'Serial No already exists');
        }


        $depositsale = new DepositSale();
        $depositsale->customers_id  = $request->customer;
        $depositsale->discount = $request->discount;
        $depositsale->grand_total = $request->grandtotal;
        $depositsale->deposit = $request->deposit;
        $depositsale->pre_deposit = $request->deposit;
        $depositsale->credit = $request->credit;
        $depositsale->paid = $request->status;
        $depositsale->remark = $request->remark;
        $depositsale->save();

        $lastId = DepositSale::max('id');

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $depositsaleDetails = new DepositSaleDetails();
                $depositsaleDetails->deposit_sales_id  = $lastId;
                $depositsaleDetails->products_id   = $products[$product];
                $depositsaleDetails->serial_no = $serial[$product];
                $depositsaleDetails->quantity = $quantity[$product];
                $depositsaleDetails->price = $price[$product];
                $depositsaleDetails->save();
            }
        }
    }

    public function getDepositSale($id)
    {
        return DepositSale::where('id', $id)->first();
    }

    public function getsendornot($id)
    {
        return DepositSale::select('paid')->where('id', $id)->first();
    }

    public function updateDepositSaleDetail($request, $id)
    {
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $serial = $request->input('serial', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new RetailSaleDetails();
                if ($serial[$product] === null) {
                    return back()->with('fail', 'Add Serial Number');
                }

               
            }
        }

        $updateProductStockclass = new DepositSaleDetails();
        $getsend = DepositSale::select('paid')->where('id', $id)->first();
        if ($getsend->paid == 0) {
            $updateProductStock = $updateProductStockclass->delUpdateSotck($id);
        }
        $updateDepositSale = DepositSale::find($id);
        if ($updateDepositSale) {
            $updateDepositSale->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'grand_total' => $request->grandtotal,
                'deposit' => $request->deposit,
                'credit' => $request->credit,
                'paid' => $request->status,
                'remark' => $request->remark,
            ]);
        }



        $delCashsaleDetail = DepositSaleDetails::where('deposit_sales_id', $id);
        $delCashsaleDetail->delete();



        $existsInCash = RetailSaleDetails::whereIn('serial_no', $serial)->exists();
        $existsInDeposit = DepositSaleDetails::whereIn('serial_no', $serial)->exists();

        if ($existsInCash) {
            return back()->with('fail', 'Serial No already exists');
        }

        if ($existsInDeposit) {
            return back()->with('fail', 'Serial No already exists');
        }





        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $depositSaleDetails = new DepositSaleDetails();
                $depositSaleDetails->deposit_sales_id  = $id;
                $depositSaleDetails->products_id   = $products[$product];
                $depositSaleDetails->serial_no = $serial[$product];
                $depositSaleDetails->quantity = $quantity[$product];
                $depositSaleDetails->price = $price[$product];
                $depositSaleDetails->save();
            }
        }
    }

    public function  forserialdep()
    {
        return  $results = DB::table('deposit_sale_details')
            ->join('deposit_sales', 'deposit_sale_details.deposit_sales_id', '=', 'deposit_sales.id')
            ->join('products', 'deposit_sale_details.products_id', '=', 'products.id')
            ->join('customers', 'deposit_sales.customers_id', '=', 'customers.id')
            ->select('deposit_sales.pur_date', 'customers.cus_name', 'deposit_sale_details.serial_no', 'customers.phone')
            ->groupBy('deposit_sales.pur_date', 'customers.cus_name', 'deposit_sale_details.serial_no', 'customers.phone')
            ->paginate(15);
    }

    public function depositDel($id)
    {
        $updateProductStockclass = new DepositSaleDetails();
        $getsend = DepositSale::select('paid')->where('id', $id)->first();
        if ($getsend->paid == 1) {
            // dd("plus mal");
            $updateProductStock = $updateProductStockclass->delUpdateSotck($id);
        }

        $deleteDeposit = DepositSale::find($id);
        $deleteDeposit->delete();

        $delCashsaleDetail = DepositSaleDetails::where('deposit_sales_id', $id);
        $delCashsaleDetail->delete();
    }
}
