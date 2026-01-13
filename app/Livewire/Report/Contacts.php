<?php

namespace App\Livewire\Report;

use App\Models\Contact;
use App\Models\Form;
use App\Models\FormField;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Contacts extends Component {

    use WithPagination;

    public $forms = [];
    public $fields = [];

    public $form_id, $start_date, $end_date;

    protected $rules = [
        'form_id' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    public function process() {
        $this->validate();
    }

    public function export() {
        return Excel::download(new \App\Exports\Contacts($this->start_date, $this->end_date, $this->form_id), 'contacts.xlsx');
    }

    public function render() {
        $this->forms = Form::all();
        $this->fields = FormField::where('form_id', $this->form_id)->get()->toArray();

        $model = Contact::query();
        $model->with('fields.field');
        $model->where('form_id', $this->form_id);
        if ($this->start_date && $this->end_date) {
            $model->whereDate('created_at', '>=', $this->start_date)
            ->whereDate('created_at', '<=', $this->end_date);
        }
        $contacts = $model->paginate(10);

        return view('livewire.report.contacts', [
            'contacts' => $contacts
        ]);
    }
}
