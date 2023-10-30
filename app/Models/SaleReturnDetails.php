<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class SaleReturnDetails extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'sale_return_details';

    protected $fillable = ['sale_returns_id', 'products_id ', 'price', 'quantity', 'del_flg'];

    public function getSaleReturnDetails($id)
    {
        return  $cashSaleDetils = SaleReturnDetails::join('products', 'products.id', 'sale_return_details.products_id')
            ->where('sale_return_details.sale_returns_id', $id)
            ->select('products.product_name', 'sale_return_details.quantity', 'sale_return_details.price')
            ->get();
    }

    public function updateSotckCount($id)
    {
        $cashSaleDetils =  SaleReturnDetails::join('sale_returns', 'sale_return_details.sale_returns_id', '=', 'sale_returns.id')
            ->join('products', 'sale_return_details.products_id', '=', 'products.id')
            ->where('sale_return_details.sale_returns_id', $id)
            ->select('products.id', DB::raw('SUM(sale_return_details.quantity) as total_product_quantity'))
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

    public function delupdateStockCount($id)
    {
        $cashSaleDetils =  SaleReturnDetails::join('sale_returns', 'sale_return_details.sale_returns_id', '=', 'sale_returns.id')
            ->join('products', 'sale_return_details.products_id', '=', 'products.id')
            ->where('sale_return_details.sale_returns_id', $id)
            ->select('products.id', DB::raw('SUM(sale_return_details.quantity) as total_product_quantity'))
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
}
