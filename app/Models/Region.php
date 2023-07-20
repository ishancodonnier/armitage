<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'region';
    public $timestamps = false;

    protected $fillable = [
        'region_name',
        'created_date',
        'updated_date'
    ];
}
