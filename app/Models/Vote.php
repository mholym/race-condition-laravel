<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
