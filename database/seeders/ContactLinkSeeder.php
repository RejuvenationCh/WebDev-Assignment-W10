<?php

namespace Database\Seeders;

use App\Models\ContactLink;
use Illuminate\Database\Seeder;

class ContactLinkSeeder extends Seeder
{
    public function run(): void
    {
        if (ContactLink::exists()) {
            return;
        }

        ContactLink::query()->fillAndInsertOrIgnore([
            [
                'type' => 'email',
                'label' => 'Mail',
                'destination' => 'chrisbrilianto88@gmail.com',
                'icon' => null,
            ],
            [
                'type' => 'social',
                'label' => '@chris.brilianto',
                'destination' => 'https://www.instagram.com/chris.brilianto/',
                'icon' => 'fa-instagram',
            ],
            [
                'type' => 'social',
                'label' => 'RejuvenationCh',
                'destination' => 'https://github.com/RejuvenationCh',
                'icon' => 'fa-github',
            ],
            [
                'type' => 'social',
                'label' => 'Chris Brilianto Chandra',
                'destination' => 'https://www.linkedin.com/in/chrisbrilianto/',
                'icon' => 'fa-linkedin-in',
            ],
        ]);
    }
}
