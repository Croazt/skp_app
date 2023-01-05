<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('All', function(){
            return true;
        });
        Gate::define('Guru', function(){
            return Cookie::get('role') === 'Guru';
        });
        Gate::define('Operator', function(){
            return Cookie::get('role') === 'Operator';
        });
        Gate::define('Tim Angka Kredit', function(){
            return Cookie::get('role') === 'Tim Angka Kredit';
        });
        Gate::define('Pengelola Kinerja', function(){
            return Cookie::get('role') === 'Pengelola Kinerja';
        });
        Gate::define('Kepala Sekolah', function(){
            return Cookie::get('role') === 'Kepala Sekolah';
        });
        Gate::define('tugas_tambahan', function(){
            return Auth::user()->tugas_tambahan != null;
        });
        //
    }
}
