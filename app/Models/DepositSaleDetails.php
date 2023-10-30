<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class DepositSaleDetails extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'deposit_sale_details';

    protected $fillable = ['deposit_sales_id', 'products_id', 'price', 'quantity', 'del_flg'];

    public function getDepositsaleDetail($id)
    {
        return  $cashSaleDetils = DepositSaleDetails::join('products', 'products.id', 'deposit_sale_details.products_id')
            ->where('deposit_sales_id', $id)
            ->select('products.product_name', 'deposit_sale_details.quantity', 'deposit_sale_details.price','serial_no')
            ->get();
    }

    public function updateSotckCount($id)
    {
        $cashSaleDetils = DepositSaleDetails::join('deposit_sales', 'deposit_sales_id', '=', 'deposit_sales.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('deposit_sales_id', $id)
            ->where('paid', 1)
            ->select('products.id', DB::raw('SUM(deposit_sale_details.quantity) as total_product_quantity'))
            ->groupBy('products.id')
            ->get();

        foreach ($cashSaleDetils as $cashsaleDetails) {
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

    public function getDepositSlaeDetail($id)
    {
        return  $cashSaleDetils = DepositSaleDetails::join('products', 'products.id', 'deposit_sale_details.products_id')
            ->where('deposit_sale_details.deposit_sales_id', $id)
            ->select('products.id','products.product_name', 'deposit_sale_details.quantity', 'deposit_sale_details.price','serial_no')
            ->get();
    }

    public function delUpdateSotck($id)
    {
        $cashSaleDetils = DepositSaleDetails::join('deposit_sales', 'deposit_sales_id', '=', 'deposit_sales.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('deposit_sales_id', $id)
            ->where('paid', 1)
            ->select('products.id', DB::raw('SUM(deposit_sale_details.quantity) as total_product_quantity'))
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
