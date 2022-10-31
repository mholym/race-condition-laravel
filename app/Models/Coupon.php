<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'expired_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
