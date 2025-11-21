<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHealth extends Model
{
    use HasFactory;
    
    protected $table = 'child_healths'; // Explicitly set table name
    
    protected $fillable = [
        'child_laborer_id',
        'height_cm',
        'weight_kg',
        'has_disability',
        'specific_disability',
        'specific_disability_other',
        'child_ailments',
        'skin_disease_specify',
        'allergies_specify',
        'other_ailments_specify',
        'medical_assessment',
        'family_medical_history',
        'family_other_specify',
    ];
    
    protected $casts = [
        'has_disability' => 'boolean',
        'medical_assessment' => 'boolean',
        'specific_disability' => 'array',
        'child_ailments' => 'array',
        'family_medical_history' => 'array',
    ];
    
    public function childLaborer()
    {
        return $this->belongsTo(ChildLaborer::class, 'child_laborer_id');
    }
}