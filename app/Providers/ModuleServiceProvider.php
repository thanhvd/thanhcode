<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider {

    protected $files;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

        if(is_dir(app_path().'/Modules/')) {
            $modules = config("modules.enable") ?: array_map('class_basename', $this->files->directories(app_path().'/Modules/'));

            foreach($modules as $module)  {
                // Allow routes to be cached
                if (!$this->app->routesAreCached()) {
                    $routes = app_path() . '/Modules/' . $module . '/routes.php';
                    if($this->files->exists($routes)) include $routes;
                }
                $helper = app_path().'/Modules/'.$module.'/helper.php';
                $views  = app_path().'/Modules/'.$module.'/Views';
                $trans  = app_path().'/Modules/'.$module.'/Translations';

                if($this->files->exists($helper)) include $helper;
                if($this->files->isDirectory($views)) $this->loadViewsFrom($views, $module);
                if($this->files->isDirectory($trans)) $this->loadTranslationsFrom($trans, $module);
            }
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

        $this->files = new Filesystem;
    }
}
