<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class RetailSaleDetails extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'retail_sale_details';

    protected $fillable = ['retail_sales_id', 'products_id', 'p_quantity', 'p_price', 'del_flg'];

    public function gettopProducts()
    {
      return  $topProducts = RetailSaleDetails::select('products.product_name', DB::raw('SUM(retail_sale_details.p_quantity) as total_quantity'))
            ->join('products', 'retail_sale_details.products_id', '=', 'products.id')
            ->groupBy('products.product_name')
            ->orderBy('total_quantity', 'desc')
            ->limit(3)
            ->get();
           
    }

    public function getCashsaleDetail($id)
    {
        return  $cashSaleDetils = RetailSaleDetails::join('products', 'products.id', 'retail_sale_details.products_id')
            ->where('retail_sale_details.retail_sales_id', $id)
            ->select('products.product_name', 'p_quantity', 'p_price', 'serial_no')
            ->get();
    }

    public function updateSotckCount($id)
    {
        $cashSaleDetils = RetailSaleDetails::join('retail_sales', 'retail_sales_id', '=', 'retail_sales.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('retail_sales_id', $id)
            ->select('products.id', DB::raw('SUM(p_quantity) as total_product_quantity'))
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

    public function delUpdateSotck($id)
    {
        $cashSaleDetils = RetailSaleDetails::join('retail_sales', 'retail_sales_id', '=', 'retail_sales.id')
            ->join('products', 'products_id', '=', 'products.id')
            ->where('retail_sales_id', $id)
            ->select('products.id', DB::raw('SUM(p_quantity) as total_product_quantity'))
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
