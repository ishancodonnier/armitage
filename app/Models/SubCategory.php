<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'category_id',
        'status',
        'is_delete'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item_subcategories', 'sub_category_id', 'item_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item_subcategories', 'sub_category_id', 'category_id');
    }
}
