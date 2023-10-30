<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'customers';

    protected $fillable = ['cus_name', 'phone', 'address', 'del_flg'];

    public function customerList()
    {
        return Customer::orderBy('id', 'desc')
            ->where('del_flg', 0)
            ->paginate(15);
    }

    public function customerDetail($id)
    {
        return Customer::where('id', $id)->first();
    }

    public function customerUpdate($request, $id)
    {
        
        $customer = Customer::find($id);
        if ($customer) {
            $customer->update([
                'cus_name' => $request->cus_name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
    }

    public function customerDel($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->update([
                'del_flg' => 1,
            ]);
        }
    }

    public function customerAdd($request)
    {
        Customer::create([
            'cus_name' => $request->cus_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }
}
