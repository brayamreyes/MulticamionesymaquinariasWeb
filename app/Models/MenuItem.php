<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MenuItem extends Model implements Sortable
{
    use HasFactory, SortableTrait, HasSlug;
    protected $fillable = [
        'menu_id',
        'item_type',
        'item_id',
        'parent_id',
        'name',
        'slug',
        'url',
        'order'
    ];

    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function items(): HasMany {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id');
    }

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

}
