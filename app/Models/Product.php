<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'category_id',
        'sku'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // دالة بسيطة للحصول على رابط الصورة
    public function getImageUrl()
    {
        if ($this->image) {
            return asset('storage/products/' . $this->image);
        }
        return null;
    }
}