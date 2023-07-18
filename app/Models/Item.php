<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemImage;
use App\Models\Category;
use App\Models\SubCategory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'website',
        'status',
        'is_delete'
    ];

    public function item_image()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item_subcategories', 'item_id', 'category_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_item_subcategories', 'item_id', 'sub_category_id');
    }
}
