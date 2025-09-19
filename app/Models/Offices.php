<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_name',
        'category',
        'shortname'
    ];
    
    public function auditExecutions()
    {
        return $this->hasMany(AuditExecution::class, 'aex_office', 'id');
    }
}
