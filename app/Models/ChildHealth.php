<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHealth extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_laborer_id',
        'has_disability',
        'disability_types',
        'requires_disability_assessment',
        'height_cm',
        'weight_kg',
        'recent_ailments',
        'requires_medical_assessment',
        'family_medical_history'
    ];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
