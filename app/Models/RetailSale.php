<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class RetailSale extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected  $table = 'retail_sales';

    protected $fillable = ['customers_id', 'pur_date', 'discount', 'grand_total', 'remark', 'del_flg'];

    public function getCashSaleData()
    {
        return $retailsSale = RetailSale::join('customers', 'customers.id', 'retail_sales.customers_id')
            ->select('customers.cus_name', 'pur_date', 'grand_total', 'retail_sales.id', DB::raw('DATE(retail_sales.pur_date) as date_only'))
            ->where('retail_sales.del_flg', 0)
            ->orderBy('retail_sales.id', 'desc')->paginate(15);
    }

    public function getCashSaleDetails($id)
    {
        return $cashSaleDetails = RetailSale::join('customers', 'retail_sales.customers_id', 'customers.id')
            ->where('retail_sales.id', $id)
            ->select('pur_date', 'discount', 'grand_total', 'remark', 'customers.*', DB::raw('DATE(retail_sales.pur_date) as date_only'))
            ->first();
    }

    public function lastId()
    {
        return RetailSale::max('id');
    }

    public function getCustomer()
    {
        return Customer::where('del_flg', 0)->get();
    }

    public function storeCashsaleData($request)
    {
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);
        $serial = $request->input('serial', []);

        $existsInCash = RetailSaleDetails::whereIn('serial_no', $serial)->exists();
        $existsInDeposit = DepositSaleDetails::whereIn('serial_no', $serial)->exists();

        if ($existsInCash || $existsInDeposit) {
            return back()->with('fail', 'Serial No already exists');
        }
        if ($request->has('preorder_id')) {
            $preorder =   PreorderSale::find($request->preorder_id);
            if ($preorder) {
                $preorder->update([
                    'del_flg' => 1,
                ]);
            }
        }
        $cashsale = new RetailSale();
        $cashsale->customers_id = $request->customer;
        $cashsale->discount = $request->discount;
        $cashsale->grand_total = $request->grandtotal;
        $cashsale->remark = $request->remark;
        $cashsale->save();

        $lastId = RetailSale::max('id');


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new RetailSaleDetails();
                $cashsaleDetails->retail_sales_id = $lastId;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->serial_no = $serial[$product];
                $cashsaleDetails->p_quantity = $quantity[$product];
                $cashsaleDetails->p_price = $price[$product];
                $cashsaleDetails->save();
            }
        }
        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total += $request->grandtotal;
            $cashInHandBal->save();
        }
    }

    public function cashsaleData($id)
    {
        return RetailSale::where('id', $id)->first();
    }

    public function updateCashsaleDetail($request, $id)
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

                $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
                if ($checkstock->count() !== 0) {
                    return back()->with('fail', 'Stock not enough');
                }
            }
        };


        $updateCashsale = RetailSale::find($id);

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total -= $updateCashsale->grand_total;
            $cashInHandBal->save();
        }

        if ($updateCashsale) {
            $updateCashsale->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'grand_total' => $request->grandtotal,
                'remark' => $request->remark,
            ]);
        }

        $updateProductStockclass = new RetailSaleDetails();
        $updateProductStock = $updateProductStockclass->delUpdateSotck($id);

        $delCashsaleDetail = RetailSaleDetails::where('retail_sales_id', $id);
        $delCashsaleDetail->delete();


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new RetailSaleDetails();
                $cashsaleDetails->retail_sales_id = $id;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->p_quantity = $quantity[$product];
                $cashsaleDetails->serial_no = $serial[$product];
                $cashsaleDetails->p_price = $price[$product];
                $cashsaleDetails->save();
            }
        }

        if ($cashInHandBal) {
            $cashInHandBal->grand_total += $request->grandtotal;
            $cashInHandBal->save();
        }
    }

    public function  forserial()
    {
        return  $results = DB::table('retail_sale_details')
            ->join('retail_sales', 'retail_sale_details.retail_sales_id', '=', 'retail_sales.id')
            ->join('products', 'retail_sale_details.products_id', '=', 'products.id')
            ->join('customers', 'retail_sales.customers_id', '=', 'customers.id')
            ->select('retail_sales.pur_date', 'customers.cus_name', 'retail_sale_details.serial_no', 'customers.phone')
            ->groupBy('retail_sales.pur_date', 'customers.cus_name', 'retail_sale_details.serial_no', 'customers.phone')
            ->paginate(15);
    }

    public function getProduct()
    {
        return Product::where('quantity', '>', 0)->where('del_flg', '0')->get();
    }

    public function cashSaleDel($id)
    {
        $Cashsale = RetailSale::find($id);

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total -= $Cashsale->grand_total;
            $cashInHandBal->save();
        }

        $updateProductStockclass = new RetailSaleDetails();
        $updateProductStock = $updateProductStockclass->delUpdateSotck($id);

        $deleteCashSale = RetailSale::find($id);
        $deleteCashSale->delete();

        $delCashsaleDetail = RetailSaleDetails::where('retail_sales_id', $id);
        $delCashsaleDetail->delete();
    }
}
