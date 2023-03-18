<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'admin saya',
            'username' => 'admin',
            'level' => 'administrator',
            'password' => bcrypt('password'),
            'email' => 'admin154@gmail.com',
            'no_telp' => '08782730666',
        ]);
    }
}
