<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class DailyCih extends Model implements Auditable
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'daily_cash_in_hand';

    use \OwenIt\Auditing\Auditable;


    protected $fillable = [
        'grand_total'
    ];

    public function saveCashinHand($request)
    {
        $saveCIH = new DailyCih();
        $saveCIH->grand_total = $request->grand_total;
        $saveCIH->save();
    }

    public function checkCloseOrnot()
    {
        $maxid = DailyCih::max('id');

        return $colseornot = DailyCih::select(DB::raw('DATE(created_at) as crdate_only'))->where('id', $maxid)->first();
    }

    public function updateBal($request)
    {
        $maxid = DailyCih::max('id');

        $updateBal = DailyCih::find($maxid);
        if ($updateBal) {
            $updateBal->update([
                $updateBal->grand_total = $request->grand_total,
            ]);
        }
    }

    public function lasCIHamt()
    {
        return  $getlastAmt = DailyCih::sum('grand_total');
    }
}
