<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name','Admin')->first();
        User::factory()->create([
            'username' => 'Onepiece',
            'email' => 'lufy@gmail.com',
            'fname' => 'Luffy',
            'lname' => 'Pirate',
            'password' => '123'
        ])->assignRole($role);
    }
}
