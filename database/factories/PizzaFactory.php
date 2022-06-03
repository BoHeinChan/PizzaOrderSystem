<?php

namespace Database\Factories;

use App\Models\Pizza;
use Bluemmb\Faker\PicsumPhotosProvider;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pizza>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pizza::class;
    public function definition()
    {
        $this->faker->addProvider(new Restaurant($this->faker));
        $this->faker->addProvider(new PicsumPhotosProvider($this->faker));
        return [
            'pizza_name' => $this->faker->meatName() . " pizza",
            'price' => rand(1, 3) . "0000",
            'publish_status' => rand(0, 1),
            'category_id' => rand(1, 10),
            'buy_one_get_one_status' => rand(0, 1),
            'waiting_time' => rand(40, 45),
            'description' => $this->faker->paragraph(),
        ];
    }
}
