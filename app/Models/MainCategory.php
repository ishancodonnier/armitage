<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'status',
        'is_delete'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_main_categories', 'main_category_id', 'category_id');
    }
}
