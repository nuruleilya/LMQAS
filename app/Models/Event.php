<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $fillable = [
        'publisher_id',
        'title',
        'description',
        'category',
        'price',
        'age',
        'weight',
        'quantity',
        'image',
    ];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id', 'id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
