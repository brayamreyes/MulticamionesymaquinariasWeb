<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration  {

    public function up(): void {
        $this->migrator->add('general.facebook_url', 'https://www.facebook.com/MulticamionesYMaquinariasSAC');
        $this->migrator->add('general.instagram_url', 'https://www.instagram.com/multicamionesymaquinariassac/');
        $this->migrator->add('general.linkedin_url', 'https://www.linkedin.com/company/multicamiones-y-maquinarias-sac');
        $this->migrator->add('general.youtube_url', 'https://www.youtube.com/channel/UCj4BJNlFkarEXhhkWhhDmbA');
        $this->migrator->add('general.tiktok_url', 'https://www.tiktok.com/@multicamiones');
    }
};
