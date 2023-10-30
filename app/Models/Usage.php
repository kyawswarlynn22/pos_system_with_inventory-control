<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class Usage extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'usage_adjust';

    protected $fillable = ['w_product_id', 'stock', 'adjusted', '	created_at'];

    public function storependingList($request)
    {

        $getProducts = new Usage();
        $getProducts->w_product_id = $request->product_id;
        $getProducts->stock = $request->stock;
        $getProducts->save();
    }

    public function pendinglist()
    {
      
        return Usage::select('stock', 'products.product_name', 'usage_adjust.id', 'w_product_id',DB::raw('DATE(usage_adjust.created_at) as date_only'))
        ->join('products', 'products.id', 'w_product_id')
        ->where('adjusted', 0)
        ->paginate(15);
        
    }

    public function usageList()
    {
        return Usage::join('products', 'products.id', 'w_product_id')
        ->select('usage_adjust.*','products.product_name',DB::raw('DATE(usage_adjust.created_at) as date_only'))
        ->where('adjusted',1)->paginate(15);
    }

    public function updateStockCount($request, $id)
    {

        $adjust = Product::find($id);
        $newStockCount = $adjust->quantity - $request->stock;

        if ($adjust) {
            $adjust->update([
                'quantity' => $newStockCount,
            ]);
        }

        $adjustnone = Usage::find($request->p_id);
        if ($adjustnone) {
            $adjustnone->update([
                'adjusted' => 1,
            ]);
        }
    }
}
