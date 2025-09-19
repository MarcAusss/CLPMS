<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedService extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_laborer_id',
        'type_of_assistance',
        'source',
        'start_date',
        'end_date',
        'family_member_requested',
        'remarks',
    ];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
