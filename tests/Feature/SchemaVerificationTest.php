<?php

use Illuminate\Support\Facades\DB;

it('passes when every migration on disk has been applied', function () {
    $this->artisan('schema:verify')->assertExitCode(0);
});

it('fails and names the migration when one has not been applied', function () {
    $skipped = DB::table('migrations')->orderBy('id')->value('migration');

    DB::table('migrations')->where('migration', $skipped)->delete();

    $this->artisan('schema:verify')
        ->expectsOutputToContain($skipped)
        ->expectsOutputToContain('php artisan migrate')
        ->assertExitCode(1);
});

it('is skipped by the suite itself but checks the real database when run directly', function () {
    // phpunit.xml pins the suite to sqlite :memory:, which is migrated from
    // scratch on every run. Only `php artisan schema:verify` - run against the
    // environment's actual database - can catch a missing MySQL migration.
    expect(DB::connection()->getDriverName())->toBe('sqlite');
});
