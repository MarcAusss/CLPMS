<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineRegion extends Model
{
    protected $table = 'philippine_regions';
    protected $primaryKey = 'region_code';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['region_code', 'name'];
    
    public function provinces()
    {
        return $this->hasMany(PhilippineProvince::class, 'region_code', 'region_code');
    }
}
