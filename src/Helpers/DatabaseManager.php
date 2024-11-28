<?php

namespace Froiden\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public function migrateAndSeed()
    {
        $this->sqlite();

        return $this->migrate();
    }

    /**
     * Run the migration and call the seeder.
     *
     * @return array
     */
    private function migrate()
    {
        try {
            Artisan::call('migrate:fresh', ['--force' => true, '--schema-path' => 'do not run schema path']);
        } catch (Exception $e) {
            return $this->response($e->getMessage());
        }

        return $this->seed();
    }

    /**
     * Seed the database.
     *
     * @return array
     */
    private function seed()
    {
        try {
            Artisan::call('db:seed');
        } catch (Exception $e) {
            return $this->response($e->getMessage());
        }

        // Prepare a success message using translations
        $response_message = trans('installer_messages.final.finished');

        // Set the success message in the session for later use in the view
        session([
            'installer' => [
                'message' => $response_message,
                'status' => 'success',
            ],
        ]);

        return $this->response($response_message, 'success');
    }

    /**
     * Return a formatted error messages.
     *
     * @param  string  $status
     * @return array
     */
    private function response($message, $status = 'danger')
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

    /**
     * check database type. If SQLite, then create the database file.
     */
    private function sqlite()
    {
        if (DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if (! file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
        }
    }
}
