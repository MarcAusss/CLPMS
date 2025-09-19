<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildLaborer extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'sex',
        'date_of_birth',
        'dob_actual',
        'age',
        'birth_certificate',
        'place_of_birth',
        'religion',
        'religion_other',
        'indigenous_group',
        'living_with',
        'dwelling_type',
        'contact_number',
        'address_region',
        'address_province',
        'address_city',
        'address_barangay',
        'address_sitio',
        'birth_region',
        'birth_province',
        'birth_city',
        'birth_barangay'];

    public function education()
    {
        return $this->hasOne(ChildEducation::class);
    }

    public function health()
    {
        return $this->hasOne(ChildHealth::class);
    }

    public function work()
    {
        return $this->hasOne(ChildWork::class);
    }

    public function barangay()
    {
        return $this->belongsTo(PhilippineBarangay::class, 'address_barangay', 'psgc_code');
    }

    public function Bbarangay()
    {
        return $this->belongsTo(PhilippineBarangay::class, 'birth_barangay', 'psgc_code');
    }

    public function family_members()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function requested_services()
    {
        return $this->hasMany(RequestedService::class);
    }

    public function availed_services()
    {
        return $this->hasMany(AssistanceRecord::class);
    }
}
