<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactFormField extends Model {

    use SoftDeletes;
    protected $fillable = [
        'contact_id',
        'form_field_id',
        'value'
    ];

    public function contact(): HasOne {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }

    public function field(): HasOne {
        return $this->hasOne(FormField::class, 'id', 'form_field_id');
    }

}
