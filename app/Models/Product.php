<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image_path',
        'is_featured',
        'stock'
    ];

    /**
     * Proizvod pripada jednoj kategoriji
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Proizvod može biti u više narudžbina
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
