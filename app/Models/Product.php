<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements Sortable {

    use HasFactory, HasSlug, SortableTrait;

    protected $fillable = [
        'category_id',
        'brand_id',
        'type',
        'plate',
        'bin',
        'name',
        'model',
        'year_model',
        'slug',
        'year_manufacture',
        'mileage',
        'hours',
        'power',

        'dollar_price',
        'pen_price',
        'dollar_igv',
        'pen_igv',
        'dollar_final_price',
        'pen_final_price',

        'image_1',
        'image_2',
        'content',
        'data_sheet',
        'is_featured',
        'is_published',
        'order'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected $casts = [
        'content' => 'json',
        'is_featured' => 'boolean'
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function meta(): MorphOne {
        return $this->morphOne(Meta::class, 'metable');
    }

    public function scopePublished(Builder $builder):void {
        $builder->where('is_published', true);
    }
}
