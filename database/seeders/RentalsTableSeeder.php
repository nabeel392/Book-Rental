<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rentals')->insert([
            [
                'user_id' => 1,
                'book_id' => 1,
                'rent_date' => '2023-01-01',
                'return_date' => '2023-01-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'book_id' => 2,
                'rent_date' => '2023-02-01',
                'return_date' => '2023-02-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
