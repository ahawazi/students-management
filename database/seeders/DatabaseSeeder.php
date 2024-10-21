<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ClassesSeeder::class,
        ]);

        User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => '123456789',
        ]);
    }
}
