<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GardenCenterImage;

class GardenCenter extends Model
{
    use HasFactory;

    protected $primaryKey = 'garden_center_id';
    protected $table = 'garden_center';
    public $timestamps = false;

    protected $fillable = [
        'garden_name',
        'description',
        'address',
        'mobile_number',
        'city',
        'state',
        'contrary',
        'zipcode',
        'email',
        'webside',
        'region',
        'longitude',
        'latitude',
        'created_date',
        'updated_date',
        'status',
        'is_delete'
    ];

    public function garden_center_image()
    {
        return $this->hasMany(GardenCenterImage::class, 'garden_center_id', 'garden_center_id');
    }
}
