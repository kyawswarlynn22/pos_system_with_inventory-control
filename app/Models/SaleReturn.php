<?php

namespace App\Models;

use App\Http\Controllers\salereturnController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class SaleReturn extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'sale_returns';

    protected $fillable = ['return_date','customers_id','discount', 'grand_total','remark', 'del_flg'];

    public function getlastId()
    {
        return $lastId = SaleReturn::max('id');
    }

    public function getSaleReturnList()
    {
        return $retailsSale = SaleReturn::join('customers', 'customers.id', 'sale_returns.customers_id')
            ->select('customers.cus_name', 'return_date', 'grand_total','sale_returns.id',DB::raw('DATE(sale_returns.return_date) as date_only'))
            ->where('sale_returns.del_flg', 0)
            ->orderBy('sale_returns.id', 'desc')->paginate(15);
    }

    // public function getSaleReturn($id)
    // {
    //     return SaleReturn::where('id', $id)->first();
    // }

    public function getSaleReturn($id)
    {
        return $cashSaleDetails = SaleReturn::join('customers', 'sale_returns.customers_id', 'customers.id')
            ->where('sale_returns.id', $id)
            ->select('return_date', 'discount', 'grand_total','sale_returns.id as return_id', 'remark', 'customers.*')
            ->first();
    }

    public function storeSaleReturnData($request)
    {
        $cashsale = new SaleReturn();
        $cashsale->customers_id  = $request->customer;
        $cashsale->discount = $request->discount;
        $cashsale->grand_total = $request->grandtotal;
        $cashsale->remark = $request->remark;
        $cashsale->save();

        $lastId = SaleReturn::max('id');

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new SaleReturnDetails();
                $cashsaleDetails->sale_returns_id  = $lastId;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->quantity = $quantity[$product];
                $cashsaleDetails->price = $price[$product];
                $cashsaleDetails->save();
            }
        }
    }

    public function updateSalereturn($request,$id)
    {
        $updateSalereturn = SaleReturn::find($id);
        if ($updateSalereturn) {
            $updateSalereturn->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'grand_total' => $request->grandtotal,
                'remark' => $request->remark,
            ]);
        }
    }

    public function delSaleReturn($id)
    {
        $delSalereturn = SaleReturn::find($id);
        $delSalereturn->delete();
    }
}
