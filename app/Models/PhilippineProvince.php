<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineProvince extends Model
{
    protected $table = 'philippine_provinces';
    protected $primaryKey = 'province_code';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['province_code', 'region_code', 'name'];
    
    public function region()
    {
        return $this->belongsTo(PhilippineRegion::class, 'region_code', 'region_code');
    }
    
    public function cities()
    {
        return $this->hasMany(PhilippineCity::class, 'province_code', 'province_code');
    }
    
    public function childLaborers()
    {
        return $this->hasMany(ChildLaborer::class, 'address_province', 'province_code');
    }
}

