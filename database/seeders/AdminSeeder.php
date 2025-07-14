<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // ✅ Superadmin
        User::create([
            'name' => 'Superadmin AB Flasher',
            'email' => 'superadmin@abflasher.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
            'status' => 'active'
        ]);

        // ✅ Admin biasa (langsung aktif)
        User::create([
            'name' => 'Admin AB Flasher',
            'email' => 'admin@abflasher.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active'
        ]);
    }
}
