<?php

namespace App\Http\Middleware;

use App\Manager\ScopeManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckScopeClient
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $manager = new ScopeManager();
        $scopeClient = $manager->isScopeClient();

        if(!$scopeClient){
            abort(404);
        }

        return $next($request);
    }
}
