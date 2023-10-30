<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PreorderDetails extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;
    
    protected $table = 'preorder_details';

    protected $fillable = ['preorder_sales_id', 'products_id', 'quantity', 'price', 'del_flg'];

    public function getProductDetails($id)
    {
        return  $cashSaleDetils = PreorderDetails::join('products', 'products.id', 'preorder_details.products_id')
            ->where('preorder_details.preorder_sales_id', $id)
            ->select('products.product_name', 'products.id', 'preorder_details.quantity', 'preorder_details.price')
            ->get();
    }
}
