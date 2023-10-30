<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Takeout extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected  $table = 'stock_takeout';

    protected $fillable = ['customers_id', 'pur_date','discount','grand_total', 'remark', 'del_flg'];

    public function lastId()
    {
        return Takeout::max('id');
    }

    public function storetakeoutData($request)
    {
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        $takeout = new Takeout();
        $takeout->customers_id = $request->customer;
        $takeout->discount = $request->discount;
        $takeout->grand_total = $request->grandtotal;
        $takeout->remark = $request->remark;
        $takeout->save();

        $lastId = Takeout::max('id');


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $takeoutDetails = new TakeoutDetails();
                $takeoutDetails->takeout_id = $lastId;
                $takeoutDetails->products_id  = $products[$product];
                $takeoutDetails->product_quantity = $quantity[$product];
                $takeoutDetails->p_price = $price[$product];
                $takeoutDetails->save();
            }
        }
    }

    public function getTakeoutData()
    {
        return $retailsSale = Takeout::join('customers', 'customers.id', 'stock_takeout.customers_id')
            ->select('customers.cus_name','discount', 'grand_total', 'stock_takeout.id',DB::raw('DATE(stock_takeout.pur_date) as date_only'))
            ->where('stock_takeout.del_flg', 0)
            ->orderBy('stock_takeout.id', 'desc')->paginate(15);
    }

    public function getTakeoutDetails($id)
    {
        return $cashSaleDetails = Takeout::join('customers', 'stock_takeout.customers_id', 'customers.id')
            ->where('stock_takeout.id', $id)
            ->select( 'discount', 'grand_total', 'remark', 'customers.*',DB::raw('DATE(stock_takeout.pur_date) as date_only'))
            ->first();
    }

    public function takeoutData($id)
    {
        return Takeout::where('id', $id)->first();
    }

    public function updateCashsaleDetail($request, $id)
    {

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new TakeoutDetails();
                $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
                if ($checkstock->count() !== 0) {
                    return back()->with('fail', 'Stock not enough');
                }
            }
        };


        $updateCashsale = Takeout::find($id);
        if ($updateCashsale) {
            $updateCashsale->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'grand_total' => $request->grandtotal,
                'remark' => $request->remark,
            ]);
        }

        $updateProductStockclass = new TakeoutDetails();
        $updateProductStock = $updateProductStockclass->delUpdateSotck($id);

        $delCashsaleDetail = TakeoutDetails::where('takeout_id', $id);
        $delCashsaleDetail->delete();


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new TakeoutDetails();
                $cashsaleDetails->takeout_id = $id;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->product_quantity = $quantity[$product];
                $cashsaleDetails->p_price = $price[$product];
                $cashsaleDetails->save();
            }
        }
    }

    
    public function takeoutDel($id)
    {
        $updateProductStockclass = new TakeoutDetails();
        $updateProductStock = $updateProductStockclass->delUpdateSotck($id);

        $deleteCashSale = Takeout::find($id);
        $deleteCashSale->delete();

        $delCashsaleDetail = TakeoutDetails::where('takeout_id', $id);
        $delCashsaleDetail->delete();
    }
}
