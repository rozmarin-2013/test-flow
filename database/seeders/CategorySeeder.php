<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'title' => 'Action'
        ]);

        DB::table('categories')->insert([
            'title' => 'Drama'
        ]);

        DB::table('categories')->insert([
            'title' => 'Documentary'
        ]);

        DB::table('categories')->insert([
            'title' => 'Romance'
        ]);

        DB::table('categories')->insert([
            'title' => 'Thriller'
        ]);

        DB::table('categories')->insert([
            'title' => 'Fantasy'
        ]);
    }
}
