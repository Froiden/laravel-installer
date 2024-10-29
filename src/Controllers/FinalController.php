<?php

namespace Froiden\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Froiden\LaravelInstaller\Helpers\InstalledFileManager;
use Froiden\LaravelInstaller\Helpers\StorageLinker;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param StorageLinker $storageLinker
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, StorageLinker $storageLinker)
    {
        $fileManager->update();
        $storageLinker->link();

        return view('vendor.installer.finished');
    }
}
