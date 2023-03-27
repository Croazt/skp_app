<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\LoginRateLimiter;

class CheckRoleAuth
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
        if(count(auth()->user()->roles->where('nama',$request->role)) > 0){
            return $next($request);
        }
        
        auth()->logout();
        throw ValidationException::withMessages([
            'role' => 'Akun anda tidak memiliki akses sebagai '."'$request->role'!",
        ]);
    }
}
