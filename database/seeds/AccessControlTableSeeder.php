<?php

use App\AccessControls;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AccessControlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acls = config('access-controls');
        foreach ($acls as $acl) {
            AccessControls::create([
                'slug' => Str::slug($acl),
                'name' => $acl
            ]);
        }

    }
}
