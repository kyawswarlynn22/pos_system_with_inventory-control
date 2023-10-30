<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class WarehousePurDetail extends Model  implements Auditable
{
  use HasFactory;

  use \OwenIt\Auditing\Auditable;

  public $timestamps = false;

  protected $table = 'warehouser_purchase_details';

  protected $fillable = ['product_id', 'product_quantity', 'price_per_unit', 'del_flg'];

  public function getPurchaseData()
    {
        // return $purchases = WarehousePurchase::select('warehouser_purchase.*',DB::raw('DATE(warehouser_purchase.p_date) as date_only'))->orderBy('id', 'desc')->paginate(15);
        return $purchase = WarehousePurDetail::join('warehouser_purchase','warehouser_purchase.id','=','warehouser_purchase_details.purchase_id')
        ->join('warehouse_product','warehouse_product.id','=','warehouser_purchase_details.product_id')
        ->select('warehouse_product.*','warehouser_purchase_details.*','warehouser_purchase.*',DB::raw('DATE(warehouser_purchase.p_date) as date_only'))
        ->orderBy('warehouser_purchase_details.id', 'desc')->paginate(15);
    }

  public function getPurchaseDetail($id)
  {
    return  $purchasedProducts = WarehousePurDetail::join('warehouse_product', 'warehouse_product.id', 'warehouser_purchase_details.product_id')
      ->where('purchase_id', $id)
      ->select('warehouse_product.*', 'warehouser_purchase_details.*')
      ->get();
  }

  public function updateSotckCount($id)
  {
    $purchaseDetails = WarehousePurDetail::join('warehouser_purchase', 'purchase_id', '=', 'warehouser_purchase.id')
      ->join('warehouse_product', 'product_id', '=', 'warehouse_product.id')
      ->where('purchase_id', $id)
      ->where('ship_status', 1)
      ->select('warehouse_product.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
      ->groupBy('warehouse_product.id')
      ->get();

    foreach ($purchaseDetails as $purchaseDetail) {
      $productId = $purchaseDetail->id;
      $totalProductQuantity = $purchaseDetail->total_product_quantity;
      // Find the corresponding product
      $product = Warehouse::find($productId);
      // Update the 'products.quantity' column
      if ($product) {
        $product->quantity += $totalProductQuantity;
        $product->save();
      }
    }
  }

  public function deleteupdateSotckCount($id)
  {
    $purchaseDetails = WarehousePurDetail::join('warehouser_purchase', 'purchase_id', '=', 'warehouser_purchase.id')
      ->join('warehouse_product', 'product_id', '=', 'warehouse_product.id')
      ->where('purchase_id', $id)
      ->where('ship_status', 1)
      ->select('warehouse_product.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
      ->groupBy('warehouse_product.id')
      ->get();

    foreach ($purchaseDetails as $purchaseDetail) {
      $productId = $purchaseDetail->id;

      $totalProductQuantity = $purchaseDetail->total_product_quantity;

      // Find the corresponding product
      $product = Warehouse::find($productId);
      // Update the 'products.quantity' column
      if ($product) {
        $product->quantity -= $totalProductQuantity;
        $product->save();
      }
    }
  }


 
}
