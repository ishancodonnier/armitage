<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\MainCategory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'status',
        'is_delete'
    ];

    public function main_category()
    {
        return $this->belongsToMany(MainCategory::class, 'category_main_categories', 'category_id', 'main_category_id');
    }

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item_subcategories', 'category_id', 'item_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_item_subcategories', 'category_id', 'sub_category_id');
    }
}
