<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Warehousedb extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'warehouse_adjust';

    protected $fillable = ['w_product_id', 'stock', 'adjusted', '	created_at'];

    public function storependingList($request)
    {

        $getProducts = new Warehousedb();
        $getProducts->w_product_id = $request->product_id;
        $getProducts->stock = $request->stock;
        $getProducts->save();
    }

    public function pendinglist()
    {
      
        return Warehousedb::select('stock', 'warehouse_product.product_name', 'warehouse_adjust.id', 'w_product_id',DB::raw('DATE(warehouse_adjust.created_at) as date_only'))
        ->join('warehouse_product', 'warehouse_product.id', 'w_product_id')
        ->where('adjusted', 0)
        ->paginate(15);
        
    }

    public function editAdjust($id)
    {
        return Warehousedb::where('id', $id)->first();
    }

    public function adjust($id)
    {
        return Warehousedb::select('stock', 'warehouse_product.product_name', 'warehouse_adjust.id')
        ->join('warehouse_product', 'warehouse_product.id', 'w_product_id')
        ->where('adjusted', 0)
        ->first();
        
    }

}
