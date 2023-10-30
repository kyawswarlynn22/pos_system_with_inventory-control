<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StockAdjust extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'stock_adjustment';

    protected $fillable = ['product_id', 'stock','adjusted'];

    public function addAdjustment($request)
    {
        $adjustment = new StockAdjust();
        $adjustment->product_id = $request->product_id;
        $adjustment->stock = $request->stock;
        $adjustment->save();
    }

    public function pendingList()
    {
        return StockAdjust::select('stock', 'products.product_name', 'stock_adjustment.id', 'product_id')
            ->join('products', 'product_id', 'products.id')
            ->where('adjusted', 0)
            ->paginate(15);
    }

    public function editAdjust($id)
    {
        return StockAdjust::where('id', $id)->first();
    }

    public function updateAdjust($request, $id)
    {
        $product = StockAdjust::find($id);
        if ($product) {
            $product->update([
                $product->product_id = $request->product_id,
                $product->stock = $request->stock,
            ]);
        }
    }
}
