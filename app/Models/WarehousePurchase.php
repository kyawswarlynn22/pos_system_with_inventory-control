<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class WarehousePurchase extends Model  implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'warehouser_purchase';

    protected $fillable = ['sup_country', 'p_date', 'grand_total', 'ship_status', 'del_flg'];

    public function getPurchaseData()
    {
        return $purchases = WarehousePurchase::select('warehouser_purchase.*',DB::raw('DATE(warehouser_purchase.p_date) as date_only'))->orderBy('id', 'desc')->paginate(15);
       
    }

    public function getPurchaseDetail($id)
    {
        return WarehousePurchase::where('id', $id)->first();
    }

    public function getProduct()
    {
        return Warehouse::get();
    }

    public function getlastId()
    {
        return $lastId = WarehousePurchase::max('id');
    }

    public function storePurchaseData($request)
    {
        //create Purchase

        $purchase = new WarehousePurchase();
        $purchase->sup_country = $request->country;
        $purchase->grand_total = $request->grandtotal;
        $purchase->ship_status = $request->status;
        $purchase->save();

        $lastId = WarehousePurchase::max('id');

        //Create Purchase Details
        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);
        
        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $purchaseDetails = new WarehousePurDetail();
                $purchaseDetails->purchase_id = $lastId;
                $purchaseDetails->product_id = $products[$product];
                $purchaseDetails->product_quantity = $quantity[$product];
                $purchaseDetails->price_per_unit = $price[$product];
                $purchaseDetails->save();
            }else {
                dd("Product_id is null");
            }
        }
    }

    public function updatePurchaseDetail($request, $id)
    {

        $updateProductSockCountClass = new WarehousePurDetail();
        $recornot = WarehousePurchase::select('ship_status')->where('id', $id)->first();
        if ($recornot->ship_status == 1) {
            $updateProductSockCount = $updateProductSockCountClass->deleteupdateSotckCount($id);
        }
        $updatePurchase = WarehousePurchase::find($id);
        if ($updatePurchase) {
            $updatePurchase->update([
                'sup_country' => $request->country,
                'ship_status' => $request->status,
                'grand_total' => $request->grandtotal,
                'del_flg' => 0,
            ]);
        }

        $delPurchaseDeatail = WarehousePurDetail::where('purchase_id', $id);
        $delPurchaseDeatail->delete();

        $products = $request->input('productsid', []);
        $quantity = $request->input('quantities', []);
        $price = $request->input('price', []);

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $purchaseDetails = new WarehousePurDetail();
                $purchaseDetails->purchase_id = $id;
                $purchaseDetails->product_id = $products[$product];
                $purchaseDetails->product_quantity = $quantity[$product];
                $purchaseDetails->price_per_unit = $price[$product];
                $purchaseDetails->save();
            }
        }
    }

    public function WarehousePurchaseDel($id)
    {
        $updateProductStockclass = new WarehousePurDetail();
        $updateProductStock = $updateProductStockclass->deleteupdateSotckCount($id);
  
        $deleteWarehousePurchase = WarehousePurchase::find($id);
        $deleteWarehousePurchase->delete();
  
        $delWarehousePurchase = WarehousePurDetail::where('purchase_id', $id);
        $delWarehousePurchase->delete();

    }
}
