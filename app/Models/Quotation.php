<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model {

    use SoftDeletes;

    protected $fillable = [
        'number',
        'code',
        'status',

        'customer_id',
        'first_name',
        'last_name',
        'dni',
        'ruc',
        'business_name',
        'phone',
        'email',
        'accept_privacy_policy',

        'terms_conditions',
        'way_to_pay',
        'delivery_term',

        'admin_id',

        'product_id',
        'exchange',
        'dollar_price',
        'pen_price',
        'dollar_igv',
        'pen_igv',
        'dollar_final_price',
        'pen_final_price',
        'product_name'
    ];


    public function product(): HasOne {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function customer(): HasOne {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function admin(): HasOne {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

}
