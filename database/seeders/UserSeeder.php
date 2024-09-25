<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin= User::create([
            'name' => 'Super Admin',
            'email' => 'Sadmin@gmail.com',
            'password' => bcrypt ('Superadmin9812')
        ]);

        $superAdmin->assignRole('superadmin');
    }
}
