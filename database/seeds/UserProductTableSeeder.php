<?php

use Illuminate\Database\Seeder;

class UserProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = resolve(App\Product::class)->all();
        $users = resolve(App\User::class)->all();
        foreach ($users as $user) {
            $user->products()->saveMany($products->random(2));
        }
    }
}
