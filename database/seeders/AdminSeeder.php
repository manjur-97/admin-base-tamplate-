<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'first_name' => 'Manjur',
                'last_name' => 'Rahman',
                'email' => 'admin@gmail.com',
                'phone' => '016000000',
                'password' => "12345678",
                'role_id' => 1,
                'photo' => 'users/1730177302.png',
                'address' => 'Dhaka Cantonment',
                'sorting' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ishrat',
                'last_name' => 'Zahan',
                'email' => 'admin@gmail.com',
                'phone' => '01600000000',
                'password' => "asdasd",
                'role_id' => 1,
                'photo' => 'users/1730177302.png',
                'address' => 'Dhaka',
                'sorting' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Arifuzzaman',
                'last_name' => 'Arif',
                'email' => 'arif@gmail.com',
                'phone' => '01600000001',
                'password' => "12345678",
                'role_id' => 2,
                'photo' => 'users/1730175303.png',
                'address' => 'Dhaka',
                'sorting' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Md. Shofiul',
                'last_name' => 'Azam',
                'email' => 'azam_hr@gmail.com',
                'phone' => '01600000002',
                'password' => "12345678",
                'role_id' => 2,
                'photo' => 'users/1730176753.png',
                'address' => 'Dhaka',
                'sorting' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($admins as $adminData) {
            Admin::create($adminData);
        }
    }
}
