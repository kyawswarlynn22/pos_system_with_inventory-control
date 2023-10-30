<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'audits';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('User::class');
    }

    public function getMetadata()
    {
       return $audits = ActivityLog::select('users.name','auditable_type','event','old_values','new_values','audits.created_at')
       ->join('users','audits.user_id','users.id')
       ->orderBy('audits.id', 'desc')
       ->paginate(15);
    }
}
