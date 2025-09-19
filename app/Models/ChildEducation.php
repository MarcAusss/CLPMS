<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_laborer_id',
        'has_gone_to_school',
        'currently_attending',
        'learner_reference_no',
        'highest_grade_completed',
        'mode_of_education',
        'age_stopped_schooling',
        'reason_for_stopping'
    ];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
