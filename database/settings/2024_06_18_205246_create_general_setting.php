<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void {
        $this->migrator->add('general.logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.quotation_logo', null);
        $this->migrator->add('general.address', "Av. Defensores del Morro N° 4263 – Chorrillos – LIMA");
        $this->migrator->add('general.ruc', "20603370717");
        $this->migrator->add('general.business_name', "Multi Camiones y Maquinarias SAC");
        $this->migrator->add('general.exchange', 3.75);
        $this->migrator->add('general.whats_app_url', 'https://crear.wa.link/');
    }
};
