<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
