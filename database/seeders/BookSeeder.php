<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(10)->create();

        Book::factory(10)->create()->each(function ($book) use($categories) {
            $book->categories()->attach($categories->random());
        });
    }
}
