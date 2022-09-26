<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ResetThisMonthCanceld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetThisMonthCanceld:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ResetThisMonthCanceld for User';

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
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user){
            $user->this_month_canceled = 0;
            $user->save();
        }
    }
}
