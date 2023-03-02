<?php

use App\Dish;
use App\User;
use App\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $dishes = Dish::all()->pluck('id');
        $dishCount = count($dishes);


        $user_ids = User::pluck('id')->toArray();
        for ($i = 0; $i < 60; $i++) {
            $dt = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');
            $newOrder = new Order();
            $newOrder->user_id = $faker->randomElement($user_ids);
            $newOrder->prezzo = $faker->randomFloat(2, 10, 200);
            $newOrder->indirizzo = $faker->address();
            $newOrder->data_e_ora = $dt->format('Y-m-d') . " " . $faker->time('H:i:s');
            $newOrder->nome = $faker->firstName();
            $newOrder->cognome = $faker->lastName();
            $newOrder->telefono = $faker->phoneNumber();
            $newOrder->email = $faker->email();
            $newOrder->save();
        }

            $newOrder->dishes()->attach($faker->randomElements($dishes, rand(0, ($dishCount > 30) ? 30 : $dishCount)));
    }
}


