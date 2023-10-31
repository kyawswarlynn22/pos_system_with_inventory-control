<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class TakeoutDetails extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected  $table = 'stock_takeout_details';

    protected $fillable = ['takeout_id', 'products_id', 'product_quantity', 'p_price', 'del_flg'];

    public function updateSotckCount($id)
    {
        $takeoutDetails = TakeoutDetails::join('stock_takeout', 'takeout_id', '=', 'stock_takeout.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('takeout_id', $id)
            ->select('products.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
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

    public function getTakeoutDetail($id)
    {
        return  $cashSaleDetils = TakeoutDetails::join('products', 'products.id', 'stock_takeout_details.products_id')
            ->where('stock_takeout_details.takeout_id', $id)
            ->select('products.product_name', 'product_quantity', 'p_price')
            ->get();
    }

    public function delUpdateSotck($id)
    {
        $cashSaleDetils = TakeoutDetails::join('stock_takeout', 'takeout_id', '=', 'stock_takeout.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('takeout_id', $id)
            ->select('products.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
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
