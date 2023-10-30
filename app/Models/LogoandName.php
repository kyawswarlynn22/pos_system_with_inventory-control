<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LogoandName extends Model   implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;
    
    protected $table = 'logoand_names';

    protected $fillable = ['logo','business_name'];

    public function logoAndNameData()
    {
        return LogoandName::first();
    }
}
