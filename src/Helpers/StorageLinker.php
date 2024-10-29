<?php

namespace Froiden\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\Artisan;

class StorageLinker
{
    /**
     * Create storage link
     *
     * @return int
     */
    public static function link()
    {
        Artisan::call('storage:link');
    }
}
