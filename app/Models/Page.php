<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model {

    use SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'type',
        'category_id'
    ];

    protected $casts = [
        'content' => 'json'
    ];

    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function meta(): MorphOne {
        return $this->morphOne(Meta::class, 'metable');
    }
}
