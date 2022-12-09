<?php

namespace App\Providers;

use App\Providers\Traits\SqlMacro;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use SqlMacro;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLikeMacro();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
