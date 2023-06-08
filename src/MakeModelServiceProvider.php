<?php

namespace Sagni\Model;

use Illuminate\Support\ServiceProvider;
use Sagni\Model\MakeModelCommand;

class MakeModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    protected function registerCommands(): void
    {
        $this->commands([
            MakeModelCommand::class,
        ]);
    }
}
