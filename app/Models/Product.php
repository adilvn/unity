<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'cat',
        'user_id',
        'price',
        'desc',
        'img',
        'qty',
        'available_qty',
        'status',
        'url',
    ];

    public function users()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
