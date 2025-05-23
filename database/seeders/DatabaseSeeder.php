<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed accounts
        DB::table('accounts')->insert([
            [
                'id' => 1,
                'name' => 'alo',
                'nit' => '900985000',
                'description' => 'AloGlobal',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Omar',
                'email' => 'ogalaviz@aloglobal.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Cambiar por la contraseña real
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'rol' => 1,
                'account_id' => 1,
                'created_by' => 1
            ]
        ]);
    }
}
