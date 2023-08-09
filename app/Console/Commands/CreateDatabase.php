<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {database?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $databaseName = $this->argument('database') ?: config('database.connections.' . config('database.default') . '.database');

        $validator = Validator::make(['database' => $databaseName], [
            'database' => 'required|string|max:64',
        ]);

        if ($validator->fails()) {
            $this->error('Invalid database name provided.');
            return;
        }

        config(['database.connections.' . config('database.default') . '.database' => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $databaseName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
        DB::statement($query);

        $this->info("Database $databaseName created successfully.");
    }
}
