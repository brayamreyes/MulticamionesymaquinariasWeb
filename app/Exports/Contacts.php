<?php

namespace App\Exports;


use App\Models\Contact;
use App\Models\FormField;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Contacts implements FromView {

    protected $start_date;
    protected $end_date;
    protected $form_id;

    public function __construct($start_date, $end_date, $form_id) {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->form_id = $form_id;
    }

    public function view(): View {
        $fields = FormField::where('form_id', $this->form_id)->get()->toArray();

        $model = Contact::query();
        $model->with('fields.field');
        $model->where('form_id', $this->form_id);
        if ($this->start_date && $this->end_date) {
            $model->whereDate('created_at', '>=', $this->start_date)
                ->whereDate('created_at', '<=', $this->end_date);
        }
        $contacts = $model->get();
        return view('exports.contacts', [
            'contacts' => $contacts,
            'fields' => $fields
        ]);
    }
}
