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

    protected $primaryKey = 'service_id'; // ✅ Add this line

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
    return $this->hasMany(Order::class, 'service_id', 'service_id');
    }

    public function ordersWithReview()
{
    return $this->hasMany(Order::class, 'service_id')->whereNotNull('rating');
}



}

