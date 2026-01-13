<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FormField extends Model implements Sortable {

    use SoftDeletes, SortableTrait, HasSlug;

    protected $fillable = [
        'form_id',
        'name',
        'slug',
        'type',
        'size',
        'link',
        'options',
        'order',
        'show',
        'required'
    ];

    protected $casts = [
        'options' => 'json',
        'link' => 'json',
        'required' => 'boolean',
        'show' => 'boolean',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    public function form(): HasOne {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    public  function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->usingSeparator('_');
    }

}
