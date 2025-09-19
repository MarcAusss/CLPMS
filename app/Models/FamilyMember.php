<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'child_laborer_id',
        'relationship',
        'sex',
        'age',
        'civil_status',
        'education',
        'solo_parent',
        'occupation',
        'income',
        'disability',
        'skills',
        'whereabouts',
    ];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
