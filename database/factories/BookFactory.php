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
       /* $filename = $this->faker->uuid . '.jpg';

        // Copy a placeholder image to the desired location
        $sourcePath = storage_path('app/public/covers/placeholder.jpg');
        $destinationPath = storage_path('app/public/covers/') . $filename;
        copy($sourcePath, $destinationPath);

        // Upload the image to the storage location
        $uploadedImagePath = 'public/covers/' . $filename;
        Storage::disk('public')->putFileAs('covers', new File($destinationPath), $filename);*/

       $fake_image = $this->faker->image(storage_path('app/public/covers'), 640, 480);
        $name = basename($fake_image);

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text,
            'cover' => $name,
            'author' => $this->faker->name,
            'slug' => $this->faker->text(5)
        ];
    }
}
