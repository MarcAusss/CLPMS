<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringRecord extends Model
{
    use HasFactory;
    protected $fillable = ['child_laborer_id', 'date_of_profiling', 'last_monitoring_date', 'new_address', 'currently_living_with', 'education_status', 'reason_for_not_attending', 'received_education_assistance', 'health_status', 'family_medical_status', 'family_income_affected', 'received_medical_assistance', 'work_status', 'reason_for_continuing_work', 'current_work', 'family_livelihood_status', 'received_livelihood_assistance', 'additional_remarks', 'monitored_by', 'monitored_date'];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
