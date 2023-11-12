<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class CashThb extends Model implements Auditable
{
    use HasFactory;

    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'daily_cih_bat';

    protected $fillable = [
        'grand_total'
    ];

  


    public function updateBal($request)
    {
        $updateBal = CashThb::find(1);
        if ($updateBal) {
            $updateBal->update([
                $updateBal->grand_total = $request->amount,
            ]);
        }
    }

    public function lasCIHamt()
    {
        return  $getlastAmt = CashThb::sum('grand_total');
    }
}
