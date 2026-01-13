<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'position',
        'parent_position'
    ];
    protected $casts = [
        'content' => 'json',
    ];

}
