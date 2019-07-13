<?php

use App\User;
use App\AccessControls;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seeded Users
     * @var
     */
    public $createdUsers;
    /**
     * Run the database seeds.
     *
     * @return self
     */
    public function run()
    {
        $this->createdUsers = factory(App\User::class, 5)->create();
        $adminUser = factory(App\User::class, 1)->create()->first();
        $adminUser->email = 'admin@user.com';
        $adminUser->accessControls()->saveMany(AccessControls::all());
        $adminUser->save();
        $this->createdUsers->push($adminUser);
        return $this;
    }
}
