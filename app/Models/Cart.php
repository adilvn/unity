<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'mac',
        'status',
    ];

    public function product()
    {
        # code...
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
