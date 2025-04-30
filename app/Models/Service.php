<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'price', 'overview', 'description', 'category', 'photo'
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

}

