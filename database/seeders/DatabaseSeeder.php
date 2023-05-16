<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('permission:create-role admin');

        \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('admin');

        $categories = Category::factory(10)->create();

        Book::factory(10)->create()->each(function ($book) use($categories) {
            $book->categories()->attach($categories->random());
        });

        Comment::factory(10)->create()->each(function ($comment) {
            $comment->book->updateRating();
        });
    }
}
