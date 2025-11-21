<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineCity extends Model
{
    protected $table = 'philippine_cities';
    protected $primaryKey = 'city_code';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['city_code', 'province_code', 'name'];
    
    public function province()
    {
        return $this->belongsTo(PhilippineProvince::class, 'province_code', 'province_code');
    }
    
    public function barangays()
    {
        return $this->hasMany(PhilippineBarangay::class, 'city_code', 'city_code');
    }
    
    public function childLaborers()
    {
        return $this->hasMany(ChildLaborer::class, 'address_city', 'city_code');
    }
}
