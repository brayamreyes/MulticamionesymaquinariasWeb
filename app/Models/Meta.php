<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'title',
        'description',
        'focus_keywords',
        'canonical_url',
        'image_url',
    ];

    protected $casts = [
        'focus_keywords' => 'json',
        'robots' => 'json'
    ];

    public function metable()
    {
        return $this->morphTo();
    }
}
