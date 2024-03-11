<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\News;
use Illuminate\Database\Seeder;

class AuthorNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()
            ->count(10)
            ->create()
            ->each(function(Author $author) {
                $author->news()->saveMany(News::factory(rand(1, 11))->create());
            });
    }
}
