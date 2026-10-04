<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VerifySchemaIsCurrent extends Command
{
    protected $signature = 'schema:verify';

    protected $description = 'Check that every migration on disk has been applied to the current database';

    /**
     * The test suite runs against an in-memory SQLite database that is migrated
     * from scratch, so it can never notice a real MySQL database that is
     * missing a migration. This runs against whatever the environment is
     * actually configured to talk to.
     */
    public function handle(): int
    {
        $connection = DB::connection();
        $name = $connection->getDatabaseName();

        $onDisk = collect(File::files(database_path('migrations')))
            ->map(fn ($file) => $file->getFilenameWithoutExtension())
            ->sort()
            ->values();

        if (! $connection->getSchemaBuilder()->hasTable('migrations')) {
            $this->error("Connection [{$connection->getName()}] (database [{$name}]) has no migrations table. Run: php artisan migrate");

            return self::FAILURE;
        }

        $applied = collect(DB::table('migrations')->pluck('migration'))
            ->flip();

        $pending = $onDisk->reject(fn ($migration) => $applied->has($migration))->values();

        if ($pending->isEmpty()) {
            $this->info("Schema is current: {$onDisk->count()} migrations applied to [{$name}].");

            return self::SUCCESS;
        }

        $this->error("{$pending->count()} pending migration(s) on [{$name}]:");
        $pending->each(fn ($migration) => $this->line("  - {$migration}"));

        $this->comment('Run: php artisan migrate');

        return self::FAILURE;
    }
}
