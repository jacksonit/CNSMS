<?php

namespace Jacksonit\CNSMS;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

/**
 * ServiceProvider
 *
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author Cao Son <son.caoxuan92@gmail.com>
 * @package Jacksonit\CNSMS
 */
class CNSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/config/cnsms.php' => config_path('cnsms.php'),
        ]);
    }

    public function register()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('CNSMS', 'Jacksonit\CNSMS\Facades\CNSMSCharge');
        });

        $this->app->bind('CNSMSCharge', CNSMSCharge::class);
    }
}