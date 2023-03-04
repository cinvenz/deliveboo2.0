<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(Faker $faker)
    {
        $restaurants = config('deliveboo.restaurants');
        $categories = Category::all()->pluck('id');
        $categoryCount = count($categories);

        for ($i = 0; $i < count($restaurants); $i++) {
            $restaurant = $restaurants[$i];
            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('qwer'),
                'slug' => User::getSlug($restaurant['name']),
                'name' => $faker->name(),
                'restaurant_name' => $restaurant['name'],
                'image' => $restaurant['img'],
                'p_iva' => $faker->unique()->numberBetween(10000000000, 99999999999),
                'address' => $faker->streetAddress,
                'phone' => '347' . $faker->numberBetween(1000000, 9999999),
                'delivery_cost' => rand(1,5),
                'opening_hours' => '08:00',
                'closing_hours' => '23:00',
            ]);


            $user->categories()->attach($faker->randomElements($categories, rand(0, ($categoryCount > 10) ? 10 : $categoryCount)));
        }
    }
}


