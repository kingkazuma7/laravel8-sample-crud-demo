<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert(
            [
                [
                    'name' => '山田',
                    'telephone' => '123-4567',
                    'email' => 'yamada@example.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => '鈴木',
                    'telephone' => '234-5678',
                    'email' => 'suzuki@example.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
