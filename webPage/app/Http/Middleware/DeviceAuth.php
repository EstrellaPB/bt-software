<?php

namespace publicity\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;


class DeviceAuth
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
        Log::debug("Test middleware HEADERS", $request->header());
        $auth = $request->header('Authorization');
        if($auth == "12345")
            return $next($request);
        $response = ["message" => "Unauthorized!"];
        $contentLength = strlen(implode($response));
        return response()->json($response, 401)->header('Content-Length', $contentLength);

    }
}
