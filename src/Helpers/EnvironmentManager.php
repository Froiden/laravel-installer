<?php

namespace Froiden\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Save the edited content to the file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFile(Request $input)
    {

        $message = trans('messages.environment.success');

        $env = $this->getEnvContent();
        $dbName = $input->get('database');
        $dbHost = $input->get('hostname');
        $dbUsername = $input->get('username');
        $dbPassword = $input->get('password');

        $databaseSetting = 'DB_HOST=' . $dbHost . '
DB_DATABASE=' . $dbName . '
DB_USERNAME=' . $dbUsername . '
DB_PASSWORD=' . $dbPassword . '
';

        // @ignoreCodingStandard
        $rows       = explode("\n", $env);
        $unwanted   = "DB_HOST|DB_DATABASE|DB_USERNAME|DB_PASSWORD";
        $cleanArray = preg_grep("/$unwanted/i", $rows, PREG_GREP_INVERT);

        $cleanString = implode("\n", $cleanArray);


        $env = $cleanString.$databaseSetting;
        try {
            $dbh = new \PDO('mysql:host='.$dbHost, $dbUsername, $dbPassword);

            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // First check if database exists
            $stmt = $dbh->query('CREATE DATABASE IF NOT EXISTS '.$dbName.' CHARACTER SET utf8 COLLATE utf8_general_ci;');
            // Save settings in session
            $_SESSION['db_username'] = $dbUsername;
            $_SESSION['db_password'] = $dbPassword;
            $_SESSION['db_name']     = $dbName;
            $_SESSION['db_host']     = $dbHost;
            $_SESSION['db_success']  = true;
            $message = 'Database settings correct';

            try {
                file_put_contents($this->envPath, $env);
            } catch (Exception $e) {
                $message = trans('messages.environment.errors');
            }

        return Reply::redirect(route('LaravelInstaller::requirements'), $message);


        } catch (\PDOException $e) {
            return Reply::error('DB Error: ' . $e->getMessage());


        } catch (\Exception $e) {

            return Reply::error('DB Error: ' . $e->getMessage());

        }
    }
}