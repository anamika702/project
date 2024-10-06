<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PracownikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'imie' => 'Admin',
            'nazwisko' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('haslo'),
            'stanowisko' => 'Menadżer',
            'numer_telefonu' => '123456789',
            'inne_informacje' => 'Admin account',
        ]);
    }
}
