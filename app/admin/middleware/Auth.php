<?php

namespace app\admin\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    protected $secret = 'your-secret-key';

    public function handle($request, \Closure $next)
    {
        $url = parse_url($request->server('REQUEST_URI'));
        if (isset($url['path'])) {
            if ($url['path'] == '/admin/auth/login') {
                return $next($request);
            }
        }

        $token = $request->header('Authorization');
        if (!$token) {
            return json(['code' => 401, 'message' => '未授权']);
        }
        $token = str_replace('Bearer ', '', $token);
        try {
            $info = Jwt::decode($token, new Key($this->secret, 'HS256'));
            $request->token = $info;
            return $next($request);
        } catch (\Exception $e) {
            return json(['code' => 401, 'message' => '权限错误']);
        }
    }
}