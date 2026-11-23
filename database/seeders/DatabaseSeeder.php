<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutItem;
use App\Models\User;
use App\Models\Works;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::transaction(function () {
            User::firstOrCreate(
                ['email' => 'test@example.com'],
                User::factory()->raw(['name' => 'Test User']),
            );

            if (! About::exists()) {
                About::factory()
                    ->has(AboutItem::factory()->count(3), 'items')
                    ->create([
                        'name' => 'Chris Brilianto Chandra',
                        'personal_description' => 'I enjoy turning ideas into useful applications and telling stories through photography and video.',
                    ]);
            }

            if (! Works::exists()) {
                Works::factory(3)->create(['is_published' => true, 'is_featured' => true]);
                Works::factory(7)->create(['is_featured' => false]);
            }

            $this->call(ContactLinkSeeder::class);
        });
    }
}
