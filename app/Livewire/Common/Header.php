<?php

namespace App\Livewire\Common;

use App\Concerns\Enums\Types;
use App\Models\Menu;
use App\Settings\GeneralSetting;
use Livewire\Component;

class Header extends Component {

    public $logo = "https://fakeimg.pl/55x65/?text=logo";

    public function mount() {
        $general_settings = new GeneralSetting();
        if($general_settings->logo){
            $this->logo = url('storage/web/' . $general_settings->logo);
        }
    }

    public function render() {
        $menu = Menu::where('location', Types::CABECERA->value)->first();
        return view('livewire.common.header', compact('menu'));
    }
}
