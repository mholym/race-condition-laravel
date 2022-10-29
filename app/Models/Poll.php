<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class)->withCount('votes');
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Answer::class);
    }
}
