<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->membership == false) {
            return redirect('/pricing');
        }
        Log::info('Before Request: ', ['url' => $request->url(), 'parameters' => $request->all()]);

        sleep(1); // Simulate processing time

        $response = $next($request);
        Log::info('After Request: ', ['status' => $response->getStatusCode(), 'content' => $response->getContent()]);
        return $response;
    }
}
