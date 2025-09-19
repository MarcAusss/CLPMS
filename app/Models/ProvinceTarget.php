<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceTarget extends Model
{
    use HasFactory;
    protected $fillable = ['province', 'year', 'target_number'];
}
