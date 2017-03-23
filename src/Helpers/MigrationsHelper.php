<?php

namespace Froiden\LaravelInstaller\Helpers;
use Illuminate\Support\Facades\DB;

/**
 * Class MigrationsHelper
 * @package Froiden\LaravelInstaller\Helpers
 */

trait MigrationsHelper
{

    /**
     * Get the migrations in /database/migrations
     *
     * @return array Array of migrations name, empty if no migrations are existing
     */
    public function getMigrations()
    {
        $migrations = glob(database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'*.php');
        return str_replace('.php', '', $migrations);
    }

    /**
     * Get the migrations that have already been ran.
     *
     */
    public function getExecutedMigrations()
    {
        // migrations table should exist, if not, user will receive an error.
        return DB::table('migrations')->get()->pluck('migration');
    }

}
