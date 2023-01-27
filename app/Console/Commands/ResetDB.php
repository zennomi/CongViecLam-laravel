<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database reset';

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
        // Switch to maintenance mode
        info('maintenance mode');
        Artisan::call('down');
        // setEnv('APP_MODE', 'maintenance');

        // Database resetting
        info('db resetting');
        $this->call('migrate:fresh');

        // Database seeding
        info('db seeding');
        $this->call('db:seed');

        // Switch to live mode
        info('back to normal mode');
        Artisan::call('up');
        // setEnv('APP_MODE', 'live');
    }
}
