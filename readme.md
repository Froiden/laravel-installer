# Laravel Web Installer

[![Packagist License](https://poser.pugx.org/froiden/laravel-installer/license.png)]()
[![Total Downloads](https://poser.pugx.org/froiden/laravel-installer/d/total.png)](https://packagist.org/packages/froiden/laravel-rest-api)

Do you want your clients to be able to install a Laravel project just like they do with WordPress or any other CMS?
This Laravel package allows users who don't use Composer, SSH etc to install your application just by following the setup wizard.
The current features are : 

	- Check For Server Requirements.
	- Check For Folders Permissions.
	- Ability to set database information.
	- Migrate The Database.
	- Seed The Tables.


## Installation
Run in terminal
`composer require "froiden/laravel-installer:dev-master"`



After that, include the service provider within `config/app.php`.

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
 
![Laravel web installer](http://i.imgur.com/3vYBPLn.png)

## Credits
[RachidLaasri Installer](https://github.com/RachidLaasri/LaravelInstaller)
