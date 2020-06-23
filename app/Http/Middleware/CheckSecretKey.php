<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiprException;
use Closure;

class CheckSecretKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $request->get('api-key', false);

        throw_unless($key == config('endpoints.api-key'), new ApiprException('Chave secreta da api incorreta.', 401));

        return $next($request);
    }
}
