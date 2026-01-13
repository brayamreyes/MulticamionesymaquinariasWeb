<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings {

    public $logo;
    public $favicon;
    public $quotation_logo;
    public string $address;
    public string $ruc;
    public string $business_name;
    public float $exchange;
    public float $igv;
    public string $whats_app_url;
    public string $facebook_url;
    public string $instagram_url;
    public string $linkedin_url;
    public string $youtube_url;
    public string $tiktok_url;


    public static function group(): string {
        return 'general';
    }
}
