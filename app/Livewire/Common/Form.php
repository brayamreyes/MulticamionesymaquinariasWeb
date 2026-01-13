<?php

namespace App\Livewire\Common;

use App\Concerns\Enums\Types;
use App\Models\Contact;
use App\Models\ContactFormField;
use App\Models\Product;
use App\Models\ProductLanguage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use PeterColes\Countries\CountriesFacade;

class Form extends Component {

    public $data;
    public \App\Models\Form $form;
    public array $fields = [];
    public Collection $products;
    public $form_data = [];
    public $form_rules = [];
    public $countries = [];

    protected $messages = [
        '*.*.required' => 'Campo es obligatorio',
        '*.*.email' => 'Correo electrónico incorrecto',
        '*.*.regex' => 'Correo electrónico incorrecto',
        '*.*.accepted' => 'Debes marcar este campo',
        '*.*.digits' => 'Campo incorrecto',
        '*.*.numeric' => 'Formato incorrecto',
        '*.*.starts_with' => 'Formato incorrecto',
    ];

    public function mount() {
        $model = \App\Models\Form::find($this->data['form_id']);
        $this->countries = CountriesFacade::lookup("es", true);
        $this->products = Product::all();

        $this->form = $model;
        $this->fields = $model->fields()->ordered()->get()->toArray();

        foreach ($this->fields as $field) {
            $this->form_data[$field['slug']] = '';
            if($field['required']){
                $this->form_rules['form_data.' . $field['slug']] = 'required';
            }
            if($field['type'] === Types::EMAIL->value){
                $this->form_rules['form_data.' . $field['slug']] .= '|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            }
            if($field['type'] === Types::CHECKBOX->value){
                $this->form_data[$field['slug']] = false;
                $this->form_rules['form_data.' . $field['slug']] .= '|accepted';
            }
            if($field['type'] === Types::DNI->value){
                $this->form_rules['form_data.' . $field['slug']] .= '|numeric|digits:8';
            }
            if($field['type'] === Types::RUC->value){
                $this->form_rules['form_data.' . $field['slug']] .= '|numeric|digits:11';
            }
            if($field['type'] === Types::CELLPHONE->value){
                $this->form_rules['form_data.' . $field['slug']] .= '|numeric|digits:9|starts_with:9';
            }
        }
    }

    public function process() {
        $this->validate($this->form_rules);
        $contact = Contact::create([
            'token' => Hash::make(time()),
            'form_id' => $this->form['id']
        ]);
        foreach($this->fields as $field) {
            foreach ($this->form_data as $i => $item) {
                $result = $item;
                if ($field['type'] === Types::FILE->value) {
                    $move_to_path = $this->form_data[$field['slug']]->store(path:'public/cvs');
                    $result = str_replace('public', 'storage', $move_to_path);
                }

                if ($field['type'] === Types::DATE->value) {
                    $explode_value = explode('/', $this->form_data[$field['slug']]);
                    $result = $explode_value[2] . '-' . $explode_value[1] . '-' . $explode_value[0];
                }

                if ($i === $field['slug']) {
                    ContactFormField::create([
                        'contact_id' => $contact->id,
                        'form_field_id' => $field['id'],
                        'value' => $result
                    ]);
                }
            }
        }
        $this->reset('form_data');
        $this->dispatch('open-modal', name: 'confirm-status');
    }

    public function render() {
        return view('livewire.common.form');
    }
}
