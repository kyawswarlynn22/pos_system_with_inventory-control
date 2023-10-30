<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Damage extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'damage_adjust';

    protected $fillable = ['w_product_id', 'stock', 'adjusted', '	created_at'];

    public function storependingList($request)
    {

        $getProducts = new Damage();
        $getProducts->w_product_id = $request->product_id;
        $getProducts->stock = $request->stock;
        $getProducts->save();
    }

    public function pendinglist()
    {
      
        return Damage::select('stock', 'warehouse_product.product_name', 'damage_adjust.id', 'w_product_id',DB::raw('DATE(damage_adjust.created_at) as date_only'))
        ->join('warehouse_product', 'warehouse_product.id', 'w_product_id')
        ->where('adjusted', 0)
        ->paginate(15);
        
    }

    public function usageList()
    {
        return Warehousedb::join('warehouse_product', 'warehouse_product.id', 'w_product_id')
        ->select('warehouse_adjust.*','warehouse_product.product_name',DB::raw('DATE(warehouse_adjust.created_at) as date_only'))
        ->where('adjusted',1)->paginate(15);
    }

    public function damageList()
    {
        return Damage::join('warehouse_product', 'warehouse_product.id', 'w_product_id')
        ->select('damage_adjust.*','warehouse_product.product_name',DB::raw('DATE(damage_adjust.created_at) as date_only'))
        ->where('adjusted',1)->paginate(15);
    }

    public function updateStockCount($request, $id)
    {

        $adjust = Warehouse::find($id);
        $newStockCount = $adjust->quantity - $request->stock;

        if ($adjust) {
            $adjust->update([
                'quantity' => $newStockCount,
            ]);
        }

        $adjustnone = Damage::find($request->p_id);
        if ($adjustnone) {
            $adjustnone->update([
                'adjusted' => 1,
            ]);
        }
    }
}
