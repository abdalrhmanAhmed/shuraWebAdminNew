<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@evasoft.sd',
            'password' => Hash::make('secret'),
            'type' => 0,
            'gendor' => 1,
            'phone' => 0000000000,
            'country' => 'sudan',
            'isActive' => 1,
        ]);
    }
}
