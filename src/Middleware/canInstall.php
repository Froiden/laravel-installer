<?php

namespace Froiden\LaravelInstaller\Middleware;

use Closure;
use DB;

/**
 * Class canInstall
 * @package Froiden\LaravelInstaller\Middleware
 */

class canInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($this->alreadyInstalled()) {
            abort(404);
        }

        $this->changePhpConfigs();

        return $next($request);
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    private function changePhpConfigs()
    {
        try {
            ini_set('max_execution_time', 0); // Set unlimited execution time
            ini_set('memory_limit', -1);      // Set unlimited memory limit
        } catch (\Exception $e) {
            // Log or report the exception message
            logger()->error('Error changing PHP configurations: ' . $e->getMessage());
        }
    }

}
