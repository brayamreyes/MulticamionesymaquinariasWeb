<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model {

    use SoftDeletes;

    protected $fillable = [
        'token',
        'form_id'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function fields(): HasMany {
        return $this->hasMany(ContactFormField::class, 'contact_id', 'id');
    }

    public function form(): HasOne {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

}
