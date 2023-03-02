<?php

use App\Dish;
use App\User;
use App\Order;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;



class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $dishes = config('deliveboo.dishes_images');

        $usersId = User::all('id')->all();

        for ($i = 0; $i < count($dishes); $i++) {
            $ingredients = config('deliveboo.ingredients');

            $userPerDish = $faker->randomElements($usersId, 30);

            foreach ($userPerDish as $dishOwner) {
                $dish = $dishes[$i];
                $dish = Dish::create([
                    'user_id'   => $dishOwner->id,
                    'slug' => Dish::getSlug($dish['name']),
                    'dish_name' => $dish['name'],
                    'image' => $dish['img'],
                    'ingredients' => implode(',', Arr::random($ingredients, rand(4, 10))),
                    'description' => $faker->text(100),
                    'price' => rand(1000, 10000)/ 100,
                    'visibility' => true,
                ]);
            }



    }
}
}
