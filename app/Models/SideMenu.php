<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Item;

class SideMenu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'side_menu';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'item_id',
        'category_type',
        'main_category_id',
        'sidemenu_type',
        'sidemenu_name',
        'sidemenu_images',
        'is_active',
        'is_delete',
        'created_date',
        'updated_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
