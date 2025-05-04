<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama'      => 'Moch.Ali>Rizki',
            'email'     => 'mar@gmail.com',
            'password'  => Hash::make('123456789'),
            'jabatan'   => 'Admin',
            'is_tugas'  => false,
        ]);

        User::create([
            'nama'      => 'Argus',
            'email'     => 'argus@gmail.com',
            'password'  => Hash::make('1234567890'),
            'jabatan'   => 'karyawan',
            'is_tugas'  => false,
        ]);

        User::create([
            'nama'      => 'Lukas',
            'email'     => 'lukas@gmail.com',
            'password'  => Hash::make('1234567890'),
            'jabatan'   => 'karyawan',
            'is_tugas'  => false,
        ]);
        
        User::create([
            'nama'      => 'Yin',
            'email'     => 'yin@gmail.com',
            'password'  => Hash::make('1234567890'),
            'jabatan'   => 'karyawan',
            'is_tugas'  => false,
        ]);

    }
}
