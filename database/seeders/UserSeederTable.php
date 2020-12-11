<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make(12345678)
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make(12345678)
        ]);
    }
}
