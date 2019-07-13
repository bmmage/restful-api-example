<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessControlTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $userSeeder = resolve(UsersTableSeeder::class)->run();
        $this->call(UserProductTableSeeder::class);
        $this->command->getOutput()->writeln('USER LIST:' . PHP_EOL);
        $this->command->getOutput()->writeln($userSeeder->createdUsers->pluck('email'));

    }
}
