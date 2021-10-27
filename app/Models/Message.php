<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'donator_id',
        'user_id',
        'message',
        'status',
    ];

    public function user()
    {
        # code...
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
