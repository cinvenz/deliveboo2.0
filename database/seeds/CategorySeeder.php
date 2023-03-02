<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'pizza', 'messicano', 'americano', 'cinese', 'pesce', 'carne', 'italiano', 'internazionale', 'dolce', 'kebab', 'fritti', 'poke', 'vegano'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'  => $category,
            ]);
        }

    }
}
