<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Creditsale extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'credit_sale';

    protected $fillable = ['customers_id', 'discount','deposit_paid','credit_paid', 'grand_total', 'paid', 'remark', 'del_flg'];

    public function lastId()
    {
        return Creditsale::max('id');
    }

    public function addCreditSale(Request $request)
    {
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);
        $serial = $request->input('serial', []);

        $takeout = new Creditsale();
        $takeout->customers_id = $request->customer;
        $takeout->discount = $request->discount;
        $takeout->grand_total = $request->grandtotal;
        $takeout->remark = $request->remark;
        $takeout->save();

        $lastId = Creditsale::max('id');


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $creditDetails = new CreditsaleDetails();
                $creditDetails->credit_sale_id = $lastId;
                $creditDetails->products_id  = $products[$product];
                $creditDetails->serial_no  = $serial[$product];
                $creditDetails->quantity = $quantity[$product];
                $creditDetails->price = $price[$product];
                $creditDetails->save();
            }
        }
    }

    public function getCreditData()
    {
        return $retailsSale = Creditsale::join('customers', 'customers.id', 'credit_sale.customers_id')
            ->select('customers.cus_name','discount', 'grand_total','paid', 'credit_sale.id',DB::raw('DATE(credit_sale.created_at) as date_only'))
            ->where('credit_sale.del_flg', 0)
            ->orderBy('credit_sale.id', 'desc')->paginate(15);
    }

    public function getCreditDetails($id)
    {
        return $cashSaleDetails = Creditsale::join('customers', 'credit_sale.customers_id', 'customers.id')
            ->where('credit_sale.id', $id)
            ->select( 'discount', 'grand_total', 'remark', 'customers.*',DB::raw('DATE(credit_sale.created_at) as date_only'))
            ->first();
    }

    public function creditData($id)
    {
        return Creditsale::where('id', $id)->first();
    }

    public function creditDel($id)
    {
        $updateCashsale = Creditsale::find($id);

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total -= $updateCashsale->deposit_paid;
            $cashInHandBal->save();
        }

        $updateProductStockclass = new CreditsaleDetails();
        $updateProductStock = $updateProductStockclass->delUpdateSotck($id);

        $deleteCashSale = Creditsale::find($id);
        $deleteCashSale->delete();

        $delCashsaleDetail = CreditsaleDetails::where('credit_sale_id', $id);
        $delCashsaleDetail->delete();
    }
}
