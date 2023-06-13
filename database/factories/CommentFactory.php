<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $users =  User::where('email','!=','admin@admin.ru')->get();
       $books = Book::all();

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text,
            'rating' => $this->faker->numberBetween(1,5),
            'user_id' => $users->random(),
            'book_id' => $books->random(),
        ];
    }
}
