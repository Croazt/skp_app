<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\LoginRateLimiter;

class ChangeFortifyConfig
{
    /**
     * The login rate limiter instance.
     *
     * @var \Laravel\Fortify\LoginRateLimiter
     */
    protected $limiter;

    /**
     * Create a new class instance.
     *
     * @param  \Laravel\Fortify\LoginRateLimiter  $limiter
     * @return void
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if(filter_var($request->nip, FILTER_VALIDATE_EMAIL)){
            Config::set('fortify.username', 'email');
        }
        throw ValidationException::withMessages([
            'role' => 'Akun anda tidak memiliki akses sebagai '."'$request->role'!",
        ]);
    }
}
