<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildWork extends Model
{
    use HasFactory;
    protected $fillable = ['child_laborer_id', 'nature_of_work', 'specific_tasks', 'employer_name', 'employer_contact', 'employer_address', 'work_arrangement', 'working_hours_per_day', 'working_days_per_week', 'work_start_time', 'work_end_time', 'age_started_working', 'exposure_risks', 'payment_basis', 'average_monthly_income', 'earnings_usage', 'has_adult_supervisor', 'supervisor_name', 'supervisor_relationship'];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
