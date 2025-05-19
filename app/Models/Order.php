<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'total',
        'status',
        'shipping_address',
        'shipping_city',
        'shipping_zip',
        'shipping_phone',
        'notes'
    ];

    /**
     * Narudžbina pripada jednom korisniku
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Narudžbina može imati više stavki
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Narudžbina može imati više proizvoda kroz stavke narudžbine
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot(['quantity', 'price', 'subtotal']);
    }
}
