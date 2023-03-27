<?php

namespace App\Providers;

use App\Models\Skp;
use App\Observers\SkpObserver;
use App\Providers\Traits\SqlMacro;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('pushonce', function ($expression) {
            $var = '$__env->{"__pushonce_" . md5(__FILE__ . ":" . __LINE__)}';
        
            return "<?php if(!isset({$var})): {$var} = true; \$__env->startPush({$expression}); ?>";
        });
        
        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });
        //
        
        Skp::observe(SkpObserver::class);
    }
}
