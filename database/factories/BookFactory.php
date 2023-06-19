<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $fake_image = $this->faker->image(storage_path('app/public/covers'), 640, 480);
        $name = basename($fake_image);

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text,
            'cover' => $name,
            'author' => $this->faker->name,
            'slug' => $this->faker->text(5),
            'price' => $this->faker->numberBetween(1000,1000000)
        ];
    }
}
