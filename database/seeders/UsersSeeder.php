<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Load JSON data
        $jsonPath = base_path('database/data/ost_staff_202505021105.json');
        $jsonData = File::get($jsonPath);
        $staffData = json_decode($jsonData, true)['select * from ost_staff os '];

        // Iterate and insert into the users table
        foreach ($staffData as $user) {
            DB::table('users')->insert([
                'staff_id' => $user['staff_id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'name' => $user['firstname'],
                'email' => $user['email'],
                'password' =>  bcrypt('123456'), // Default password set to 123456
                'dni' => isset($user['dni']) ? intval($user['dni']) : null, // Handle null values for dni
                'direccion' => $user['direccion'],
                'phone' => $user['phone'],
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
