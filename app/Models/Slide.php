<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function slideItems()
    {
        return $this->hasMany(SlideItem::class);
    }
}
