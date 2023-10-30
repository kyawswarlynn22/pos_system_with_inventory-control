<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class PurchaseDetails extends Model  implements Auditable
{
  use HasFactory;

  use \OwenIt\Auditing\Auditable;

  public $timestamps = false;

  protected $table = 'purchase_details';

  protected $fillable = ['product_id', 'product_quantity', 'price_per_unit', 'del_flg'];

  public function getPurchaseDetail($id)
  {
    return  $purchasedProducts = PurchaseDetails::join('products', 'products.id', 'purchase_details.product_id')
      ->where('purchase_id', $id)
      ->select('products.*', 'purchase_details.*')
      ->get();
  }

  public function updateSotckCount($id)
  {
    $purchaseDetails = PurchaseDetails::join('purchases', 'purchase_id', '=', 'purchases.id')
      ->join('products', 'product_id', '=', 'products.id')
      ->where('purchase_id', $id)
      ->where('ship_status', 1)
      ->select('products.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
      ->groupBy('products.id')
      ->get();

    foreach ($purchaseDetails as $purchaseDetail) {
      $productId = $purchaseDetail->id;

      $totalProductQuantity = $purchaseDetail->total_product_quantity;

      // Find the corresponding product
      $product = Product::find($productId);
      // Update the 'products.quantity' column
      if ($product) {
        $product->quantity += $totalProductQuantity;
        $product->save();
      }
    }
  }

  public function deleteupdateSotckCount($id)
  {
    $purchaseDetails = PurchaseDetails::join('purchases', 'purchase_id', '=', 'purchases.id')
      ->join('products', 'product_id', '=', 'products.id')
      ->where('purchase_id', $id)
      ->where('ship_status', 1)
      ->select('products.id', DB::raw('SUM(product_quantity) as total_product_quantity'))
      ->groupBy('products.id')
      ->get();

    foreach ($purchaseDetails as $purchaseDetail) {
      $productId = $purchaseDetail->id;

      $totalProductQuantity = $purchaseDetail->total_product_quantity;

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
