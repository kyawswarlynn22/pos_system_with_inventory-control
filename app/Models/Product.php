<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'products';

    protected $fillable = [
        'product_name', 'p_code', 'categories_id', 'sub_categories_id ', 'p_one',
        'p_two', 'p_three', 'p_four', 'price', 'quantity', 'description', 'del_flg'
    ];

    

    public function productAllData()
    {
        return $product = Product::select(
            'products.id',
            'categories.c_name',
            'sub_categories.sub_c_name',
            'product_name',
            'p_code',
            'p_one',
            'p_two',
            'p_three',
            'p_four',
            'price',
            'quantity',
            'products.description'
        )
            ->join('categories', 'categories_id', '=', 'categories.id')
            ->join('sub_categories', 'sub_categories_id', '=', 'sub_categories.id')
            ->orderBy('products.id', 'desc')
            ->where('products.del_flg', 0)
            ->where('categories_id', '<>', 6)
            ->get();
        
    }

    public function chargesAndServices()
    {
        return $product = Product::select(
            'products.id',
            'categories.c_name',
            'sub_categories.sub_c_name',
            'product_name',
            'p_code',
            'p_one',
            'p_two',
            'p_three',
            'p_four',
            'price',
            'quantity',
            'products.description'
        )
            ->join('categories', 'categories_id', '=', 'categories.id')
            ->join('sub_categories', 'sub_categories_id', '=', 'sub_categories.id')
            ->orderBy('products.id', 'desc')
            ->where('products.del_flg', 0)
            ->where('categories_id', 6)
            ->paginate(15);
        
    }

    public function productData()
    {
        return $product = Product::select(
            'products.id',
            'categories.c_name',
            'sub_categories.sub_c_name',
            'product_name',
            'p_code',
            'p_one',
            'p_two',
            'p_three',
            'p_four',
            'price',
            'quantity',
            'products.description'
        )
            ->join('categories', 'categories_id', 'categories.id')
            ->join('sub_categories', 'sub_categories_id', 'sub_categories.id')
            ->orderBy('products.id', 'desc')
            ->where('products.del_flg', 0)
            ->get();
    }

    public function productDetails($id)
    {
        return Product::select(
            'products.id',
            'sub_categories.id',
            'categories.id',
            'categories.c_name',
            'sub_categories.sub_c_name',
            'product_name',
            'p_code',
            'p_one',
            'p_two',
            'p_three',
            'p_four',
            'price',
            'quantity',
            'products.description'
        )
            ->join('categories', 'categories_id', 'categories.id')
            ->join('sub_categories', 'sub_categories_id', 'sub_categories.id')
            ->where('products.id', $id)
            ->first();
    }

    public function productEdit($id)
    {
        return Product::where('id', $id)->first();
    }

    public function updateStock($id)
    {
        $productDetail = Product::find($id);
        if ($productDetail) {
            $productDetail->update([
                $productDetail->stock_confrim = 1,
            ]);
        }
        return back();
    }

    public function updateStockCount($request, $id)
    {
        $adjust = Product::find($id);
        $newStockCount = $adjust->quantity + $request->stock;

        if ($adjust) {
            $adjust->update([
                'quantity' => $newStockCount,
            ]);
        }

        $adjustnone = StockAdjust::find($request->p_id);
        if ($adjustnone) {
            $adjustnone->update([
                'adjusted' => 1,
            ]);
        }
    }
}
