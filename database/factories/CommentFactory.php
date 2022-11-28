<?php

namespace Database\Factories;

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
      
        return [
         
            "body"=>$this->faker->paragraph(rand(200,500)),
            "user_id"=>$this->faker->randomDigit(1,10),
            "post_id"=>$this->faker->randomDigit(1,10),
        ];
       
    }
}
