<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'supper_admin', 'guest'];

        foreach (DB::table('users')->get() as $value) {
            DB::table('roles')->insert([
                'title' => $roles[array_rand($roles)],
                'user_id' => $value->id,
            ]);
        }
    }
}
