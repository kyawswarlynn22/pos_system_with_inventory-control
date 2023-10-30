<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PreorderSale extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'preorder_sales';

    protected $fillable = ['customers_id', 'disscount', 'grand_total', 'remark', 'del_flg'];

    public function lastId()
    {
        return PreorderSale::max('id');
    }

    public function getPreorderSaleList()
    {
        return $retailsSale = PreorderSale::join('customers', 'customers.id', 'preorder_sales.customers_id')
            ->select('customers.cus_name', 'pur_date', 'grand_total', 'preorder_sales.id')
            ->where('preorder_sales.del_flg', 0)
            ->orderBy('preorder_sales.id', 'desc')->paginate(15);
    }

    public function getPreorderSaleDetail($id)
    {
        return $cashSaleDetails = PreorderSale::join('customers', 'preorder_sales.customers_id', 'customers.id')
            ->where('preorder_sales.id', $id)
            ->select('pur_date', 'discount', 'grand_total', 'remark','preorder_sales.id as preorder_id', 'customers.*')
            ->first();
    }

    public function storePreorderSale($request)
    {
        $preorderSale = new PreorderSale();
        $preorderSale->customers_id  = $request->customer;
        $preorderSale->discount = $request->discount;
        $preorderSale->grand_total = $request->grandtotal;
        $preorderSale->remark = $request->remark;
        $preorderSale->save();

        $lastId = PreorderSale::max('id');

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new PreorderDetails();
                $cashsaleDetails->preorder_sales_id  = $lastId;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->quantity = $quantity[$product];
                $cashsaleDetails->price = $price[$product];
                $cashsaleDetails->save();
            }
        }
    }

    public function preorderData($id)
    {
        return PreorderSale::where('id', $id)->first();
    }

    public function updatePreorderSale($request, $id)
    {
        $updatePreordersale = PreorderSale::find($id);
        if ($updatePreordersale) {
            $updatePreordersale->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'grand_total' => $request->grandtotal,
                'remark' => $request->remark,
            ]);
        }

        $delPreorderDetails = PreorderDetails::where('preorder_sales_id', $id);
        $delPreorderDetails->delete();

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $preorderSale = new PreorderDetails();
                $preorderSale->preorder_sales_id  = $id;
                $preorderSale->products_id   = $products[$product];
                $preorderSale->quantity = $quantity[$product];
                $preorderSale->price = $price[$product];
                $preorderSale->save();
            }
        }
    }
}
