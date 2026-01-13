<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class SlideItem extends Model implements Sortable
{
    use HasFactory, SortableTrait;
    protected $fillable = [
        'content',
        'order',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }
}
