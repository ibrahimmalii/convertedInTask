<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StartApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting the application...');

        exec('docker-compose up -d');
        $this->call('key:generate');
        $this->call('config:cache');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('cache:clear');

        DB::connection(config('database.default'));

        if (!Schema::hasTable('migrations')) {
            $this->call('migrate');
            $this->call('db:seed');
        }

        $this->info('Application started.');
    }
}
