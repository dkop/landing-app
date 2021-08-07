<?php

namespace App\Http\Middleware;

use App\Services\JsonRpcClient;
use Closure;
use Illuminate\Http\Request;

class LogActivityMiddleware
{

    private JsonRpcClient $client;

    public function __construct(JsonRpcClient $client)
    {
        $this->client = $client;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->client->activityAdd($request->url(), date('Y-m-d H:i:s'));
        return $next($request);
    }
}
