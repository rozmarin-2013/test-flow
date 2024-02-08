<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::factory()->count(10)
            ->create()
            ->each(function(Film $film) {
                $randomCategories= Category::all()->random( rand(0, 3) )->pluck('id');
                $film->categories()->attach($randomCategories);
            });
    }
}

