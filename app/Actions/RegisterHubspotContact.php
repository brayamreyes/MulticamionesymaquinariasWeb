<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use Rossjcooper\LaravelHubSpot\Facades\HubSpot;

class RegisterHubspotContact {
    use AsAction;

    public function handle($data) {
        try {
            $contactInput = new \HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInputForCreate();
            $contactInput->setProperties([
                'firstname' => $data['first_name'],
                'lastname' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company' => $data['business_name']
            ]);

            $contact = HubSpot::crm()->contacts()->basicApi()->create($contactInput);
            return $contact['id'] ?? null;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
