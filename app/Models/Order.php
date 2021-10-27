<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'product_id',
        'donator_id',
        'business_id',
        'qty',
        'is_confirm',
        'status',
    ];

    public function product()
    {
        # code...
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        # code...
        return $this->hasOne(User::class, 'id', 'business_id');
    }
}
