<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::insert([
            [
            'firstname' => 'priyank',
            'lastname' => 'shiroya',
            'email' => 'priyank@gmail.com',
            'password'=>Hash::make('priyank123')
            ],
            [
            'firstname' => 'shivam',
            'lastname' => 'shiroya',
            'email' => 'shivam@gmail.com ',
            'password'=>Hash::make('shivam123')
            
            ]
            
         ]);
        // User::factory()->count(10)->create();
    }
}