<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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

        DB::table('companies')->insert([
            'id' => 1,
            'type' => 'empresa',
            'name' => 'Alo Global Services S.A.S.',
            'trade_name' => 'AloGlobal',
            'identification_type' => 'NIT',
            'identification' => '9005956078',
            'email' => 'info@aloglobal.co',
            'website' => 'https://www.aloglobal.co',
            'address' => 'Carrera 30 #8B-25 Oficina 1705',
            'country' => 'Colombia',
            'city' => 'Medellín',
            'phone' => '6043525211',
            'category' => 'cliente',
            'status' => 'activo',
            'employees' => '11-50',
            'revenue_range' => 'Entre 2.000.000.000 y 5.000.000.000 COP',
            'account_id' => 1,
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
