<?php

namespace app\admin\middleware;

use think\middleware\AllowCrossDomain;

class AllowCrossDomainMiddleware extends AllowCrossDomain
{
    protected $header = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age' => 1800,
        'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With, X-Token',
    ];

    public function handle($request, \Closure $next, ?array $header = []) {
        if ($request->method() === 'OPTIONS') {
            $response = response('', 200);
            $response->header($this->header);
            return $response;
        }

        $response = $next($request);
        $response->header($this->header);
        return $response;
    }
}