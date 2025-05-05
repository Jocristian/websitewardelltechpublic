<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',       // pembeli
        'seller_id',     // pemilik service
        'service_id',
        'status',        // 'on progress' | 'finished'
        'deadline',
        'requirements'
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id'); // Note the custom key
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}

