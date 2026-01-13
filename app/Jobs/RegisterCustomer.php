<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RegisterCustomer implements ShouldQueue {
    use Queueable;

    public function __construct(public $data) {

    }

    public function handle(): void {
        $customer = Customer::where('dni', $this->data['dni'])->first();
        if (!$customer) {
            $customer = new Customer();
            $customer['first_name'] = $this->data['nombre'];
            $customer['last_name'] = $this->data['apellidos'];
            $customer['dni'] = $this->data['dni'];
            $customer['ruc'] = $this->data['ruc'];
            $customer['business_name'] = $this->data['razon_social'];
            $customer['phone'] = $this->data['celular'];
            $customer['email'] = $this->data['email'];
            $customer->save();
        }
    }
}
