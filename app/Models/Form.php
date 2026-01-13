<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model {

    use SoftDeletes;

    protected $fillable = [
        'name',
        'text_button',
        'thanks_message'
    ];

    protected $casts = [
        'thanks_message' => 'json'
    ];

    public function fields(): HasMany {
        return $this->hasMany(FormField::class, 'form_id', 'id');
    }
}
