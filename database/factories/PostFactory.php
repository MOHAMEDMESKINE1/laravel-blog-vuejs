<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,10));
        return [
            "title"=>$title,
            "slug"=>Str::slug($title),
            "body"=>$this->faker->paragraph(rand(200,500)),
            "user_id"=>$this->faker->randomDigit(1,10),
            "category_id"=>$this->faker->randomDigit(1,10),
        ];
    }
}
