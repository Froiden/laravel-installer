# Laravel Web Installer

[![Packagist License](https://poser.pugx.org/froiden/laravel-installer/license.png)]()
[![Total Downloads](https://poser.pugx.org/froiden/laravel-installer/d/total.png)](https://packagist.org/packages/froiden/laravel-installer)

Laravel Web installer checks for the following things and install the application in one go.

 - 1.Check For Server Requirements.
 - 2.Check For Folders Permissions.
 - 3.Ability to set database information.
 - 4.Migrate The Database.
 - 5.Seed The Tables.

## Note:
You need to have `.env` to the root

## Installation
Require this package with composer:
```
composer require froiden/laravel-installer
```


After updating composer, add the ServiceProvider to the providers array in `config/app.php`.

```
'providers' => [
    Froiden\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,
];
```

## Usage

Before using this package you need to run :
```bash
php artisan vendor:publish --provider="Froiden\LaravelInstaller\Providers\LaravelInstallerServiceProvider"
```

You will notice additional files and folders appear in your project :
 
 - `config/installer.php` : In here you can set the requirements along with the folders permissions for your application to run, by default the array cotaines the default requirements for a basic Laravel app.
 - `public/installer/assets` : This folder contains a css folder and inside of it you will find a `main.css` file, this file is responsible for the styling of your installer, you can overide the default styling and add your own.
 - `resources/views/vendor/installer` : This folder contains the HTML code for your installer, it is 100% customizable, give it a look and see how nice/clean it is.
 - `resources/lang/en/installer_messages.php` : This file holds all the messages/text, currently only English is available, if your application is in another language, you can copy/past it in your language folder and modify it the way you want.

## Screenshots
 
![Laravel web installer](http://froid.works/codecanyon/knap.jpg)

## Credits
[RachidLaasri Installer](https://github.com/RachidLaasri/LaravelInstaller)
