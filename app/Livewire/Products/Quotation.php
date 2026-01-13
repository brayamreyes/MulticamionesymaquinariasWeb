<?php

namespace App\Livewire\Products;

use App\Actions\RegisterHubspotContact;
use App\Concerns\Enums\TEXTS;
use App\Models\Customer;
use App\Models\Product;
use App\Settings\GeneralSetting;
use Livewire\Component;

class Quotation extends Component {

    public $product;
    public $data = [
        'first_name' => null,
        'last_name' => null,
        'dni' => null,
        'ruc' => null,
        'business_name' => null,
        'phone' => null,
        'email' => null,
        'accept_privacy_policy' => false,
        'product_id' => null,
        'dollar_price' => null,
        'pen_price' => null,
        'product_name' => null,
    ];

    protected $rules = [
        'data.first_name' => 'required',
        'data.last_name' => 'required',
        'data.dni' => 'required|numeric|digits:8',
        'data.ruc' => 'required|numeric|digits:11',
        'data.business_name' => 'required',
        'data.phone' => 'required|numeric|digits:9|starts_with:9',
        'data.email' => 'required|email',
        'data.accept_privacy_policy' => 'accepted'
    ];

    protected $messages = [
        '*.*.required' => 'Campo es obligatorio',
        '*.*.email' => 'Correo electrónico incorrecto',
        '*.*.accepted' => 'Debes marcar este campo',
        '*.*.digits' => 'Campo incorrecto',
        '*.*.numeric' => 'Formato incorrecto',
        '*.*.starts_with' => 'Formato incorrecto',
    ];

    public function mount($slug) {
        $product = Product::where('slug', $slug)->get()->first();
        if ($product) {
            $this->product = $product;
            $this->data['product_id'] = $product['id'];
            $this->data['dollar_price'] = $product['dollar_price'];
            $this->data['dollar_igv'] = $product['dollar_igv'];
            $this->data['dollar_final_price'] = $product['dollar_final_price'];
            $this->data['pen_price'] = $product['pen_price'];
            $this->data['pen_igv'] = $product['pen_igv'];
            $this->data['pen_final_price'] = $product['pen_final_price'];
            $this->data['product_name'] = $product['name'];
        } else {
            $this->redirectRoute('products.index');
        }
    }

    public function process() {
        $this->validate();

        $settings = new GeneralSetting();

        $customer = Customer::where('email', $this->data['email'])->get()->first();
        if (!$customer) {
            $hubspot = RegisterHubspotContact::run($this->data);
            $customer = Customer::create([
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
                'dni' => $this->data['dni'],
                'ruc' => $this->data['ruc'],
                'business_name' => $this->data['business_name'],
                'phone' => $this->data['phone'],
                'email' => $this->data['email'],
                'hubspot_id' => $hubspot,
            ]);
        }

        $to_save = $this->data;
        $to_save['terms_conditions'] = TEXTS::TERMS_CONDITIONS->value;
        $to_save['way_to_pay'] = TEXTS::WAY_TO_PAY->value;
        $to_save['delivery_term'] = TEXTS::DELIVERY_TERM->value;
        $to_save['exchange'] = $settings->exchange;
        $to_save['customer_id'] = $customer->id;

        \App\Models\Quotation::create($to_save);
        $this->data = [
            'first_name' => null,
            'last_name' => null,
            'dni' => null,
            'ruc' => null,
            'business_name' => null,
            'phone' => null,
            'email' => null,
            'accept_privacy_policy' => false
        ];
        $this->dispatch('open-modal', name: 'confirm-status');
    }

    public function render() {
        return view('livewire.products.quotation');
    }
}
