<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model {

    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni',
        'ruc',
        'business_name',
        'phone',
        'email',
        'hubspot_id',
        'admin_id'
    ];

    public function admin(): HasOne {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

}
