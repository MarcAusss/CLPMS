<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceRecord extends Model
{
    use HasFactory;
    protected $fillable = ['child_laborer_id', 'type_of_assistance', 'source', 'family_member_recieved', 'date_provided', 'remarks'];
    
    public function child()
    {
        return $this->belongsTo(ChildLaborer::class);
    }
}
