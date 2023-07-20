<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GardenCenterImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'garden_center_image_id';
    protected $table = 'garden_center_image';
    public $timestamps = false;

    protected $fillable = [
        'garden_center_id',
        'image',
        'caption',
        'favorite',
        'created_date',
        'updated_date'
    ];


    public function garden_center()
    {
        return $this->belongsTo(GardenCenter::class, 'garden_center_id', 'garden_center_id');
    }
}
