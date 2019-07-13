<?php

namespace App\Console\Commands;

use App\User;
use App\AccessControls;
use Illuminate\Console\Command;

class GiveUserAdminAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:admin {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give a user all ACLS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));
        $acls = AccessControls::whereNotIn('slug', $user->accessControls->pluck('slug')->toArray())->get();
        $user->accessControls()->saveMany($acls);
        $this->info($user->email . " now had all access controls");
    }
}
