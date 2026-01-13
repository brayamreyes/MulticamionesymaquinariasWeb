<?php

namespace App\Livewire\Common;

use App\Concerns\Enums\Positions;
use App\Models\Widget;
use App\Settings\GeneralSetting;
use Livewire\Component;

class Footer extends Component {

    public $widgets;
    public $logo = "https://fakeimg.pl/55x65/?text=logo";
    public $whats_app_link = null;
    public function mount() {
        $general_settings = new GeneralSetting();
        if($general_settings->logo){
            $this->logo = url('storage/web/' . $general_settings->logo);
        }

        if ($general_settings->whats_app_url) {
            $this->whats_app_link = $general_settings->whats_app_url;
        }
    }

    public function render() {
        $this->widgets = Widget::where('parent_position', Positions::FOOTER->value)->get();
        return view('livewire.common.footer');
    }
}
