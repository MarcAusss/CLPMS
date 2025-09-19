<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineBarangay extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(PhilippineCity::class, 'city_code', 'city_code');
    }

    public function province()
    {
        return $this->belongsTo(PhilippineProvince::class, 'province_code', 'province_code');
    }

    public function region()
    {
        return $this->belongsTo(PhilippineProvince::class, 'region_code', 'region_code');
    }

    public function Bcity()
    {
        return $this->belongsTo(PhilippineCity::class, 'city_code', 'city_code');
    }

    public function Bprovince()
    {
        return $this->belongsTo(PhilippineProvince::class, 'province_code', 'province_code');
    }

    public function Bregion()
    {
        return $this->belongsTo(PhilippineProvince::class, 'region_code', 'region_code');
    }
}


