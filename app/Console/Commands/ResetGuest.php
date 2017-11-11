<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ResetGuest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset_guest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Guest account to default credentials and data';

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
        $u = User::where('email', '=', 'guest@guest.x');
        try {
            if ($u->avatar != '/images/avatar/default_avatar.png')
                unlink(public_path($u->avatar));
        } catch (\Exception $e) {
        }
    }
}
