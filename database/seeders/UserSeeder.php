<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => "admin"
            ]
        );

        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'email' => 'superadmin@superadmin.com',
                'password' => Hash::make('password'),
                'role' => "super_admin"
            ]
        );
    }
}
