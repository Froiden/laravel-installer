<?php

    namespace Froiden\LaravelInstaller\Middleware;

    use Closure;
    use Froiden\LaravelInstaller\Helpers\MigrationsHelper;
    use Froiden\LaravelInstaller\Middleware\canInstall;

    class canUpdate
    {
        use MigrationsHelper;


        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            $canInstall = new canInstall;

            // if the application has not been installed,
            // redirect to the installer
            if (!$canInstall->alreadyInstalled()) {
                return redirect()->route('LaravelInstaller::welcome');
            }

            if($this->alreadyUpdated()) {
                abort(404);
            }

            return $next($request);
        }

        /**
         * If application is already updated.
         *
         * @return bool
         */
        public function alreadyUpdated()
        {
            $migrations = $this->getMigrations();
            $dbMigrations = $this->getExecutedMigrations();

            // If the count of migrations and dbMigrations is equal,
            // then the update as already been updated.
            if (count($migrations) == count($dbMigrations)) {
                return true;
            }

            // Continue, the app needs an update
            return false;
        }


    }
