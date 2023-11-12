<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class CreditsaleDetails extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'credit_sale_details';

    protected $fillable = ['credit_sale_id', 'products_id','serial_no', 'price', 'quantity', 'del_flg'];

    public function updateSotckCount($id)
    {
        $takeoutDetails = CreditsaleDetails::join('credit_sale', 'credit_sale_id', '=', 'credit_sale.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('credit_sale_id', $id)
            ->select('products.id', DB::raw('SUM(credit_sale_details.quantity) as total_product_quantity'))
            ->groupBy('products.id')
            ->get();

        foreach ($takeoutDetails as $cashsaleDetails) {
            $productId = $cashsaleDetails->id;

            $totalProductQuantity = $cashsaleDetails->total_product_quantity;

            // Find the corresponding product
            $product = Product::find($productId);
            // Update the 'products.quantity' column
            if ($product) {
                $product->quantity -= $totalProductQuantity;
                $product->save();
            }
        }
    }

    public function getCreditDetail($id)
    {
        return  $cashSaleDetils = CreditsaleDetails::join('products', 'products.id', 'credit_sale_details.products_id')
            ->where('credit_sale_details.credit_sale_id', $id)
            ->select('products.product_name', 'credit_sale_details.quantity', 'credit_sale_details.price','serial_no','products_id')
            ->get();
    }

    public function updateCreditDetail($request, $id)
    {
     
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);
        $serial = $request->input('serial', []);


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new CreditsaleDetails();
                $checkstock = Product::where('id', $products[$product])->where('quantity', '<', $quantity[$product])->get();
                if ($checkstock->count() !== 0) {
                    return back()->with('fail', 'Stock not enough');
                }
            }
        };

        $updateCashsale = Creditsale::find($id);

        $cashInHand = DailyCih::max('id');
        $cashInHandBal = DailyCih::find($cashInHand);
        if ($cashInHandBal) {
            $cashInHandBal->grand_total -= $updateCashsale->deposit_paid;
            $cashInHandBal->save();
        }

        if ($updateCashsale) {
            $updateCashsale->update([
                'customers_id' => $request->customer,
                'discount' => $request->discount,
                'deposit_paid' => $request->deposit,
                'credit_paid' => $request->credit,
                'grand_total' => $request->grandtotal,
                'remark' => $request->remark,
                'paid' => $request->paid,
            ]);
        }


        $delCashsaleDetail = CreditsaleDetails::where('credit_sale_id', $id);
        $delCashsaleDetail->delete();


        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $cashsaleDetails = new CreditsaleDetails();
                $cashsaleDetails->credit_sale_id = $id;
                $cashsaleDetails->products_id  = $products[$product];
                $cashsaleDetails->serial_no  = $serial[$product];
                $cashsaleDetails->quantity = $quantity[$product];
                $cashsaleDetails->price = $price[$product];
                $cashsaleDetails->save();
            }
        }

        if ($cashInHandBal) {
            $cashInHandBal->grand_total += $request->deposit;
            $cashInHandBal->save();
        }
    }

    
    public function delUpdateSotck($id)
    {
        
        $cashSaleDetils = CreditsaleDetails::join('credit_sale', 'credit_sale_id', '=', 'credit_sale.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('credit_sale_id', $id)
            ->select('products.id', DB::raw('SUM(credit_sale_details.quantity) as total_product_quantity'))
            ->groupBy('products.id')
            ->get();

        foreach ($cashSaleDetils as $cashsaleDetails) {
            $productId = $cashsaleDetails->id;

            $totalProductQuantity = $cashsaleDetails->total_product_quantity;

            // Find the corresponding product
            $product = Product::find($productId);
            // Update the 'products.quantity' column
            if ($product) {
                $product->quantity += $totalProductQuantity;
                $product->save();
            }
        }
    }

  
}
