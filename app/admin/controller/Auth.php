<?php

namespace app\admin\controller;

use app\admin\BaseController;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    protected $secret = 'your-secret-key';

    public function login()
    {
        $username = input('username');
        $password = input('password');

        // 验证用户（查询 users 表，验证密码）
        $admin = \app\admin\model\Admin::where('username', $username)->find();
        if (!$admin || !password_verify($password, $admin->password)) {
            return $this->failResponse(401, '账号或密码错误');
        }

        $payload = [
            'uid' => $admin->id,
            'iat' => time(),
            'exp' => time() + 86400 * 7,
        ];
        $token = JWT::encode($payload, $this->secret, 'HS256');

        return $this->successResponse(['token' => $token, 'user' => ['id' => $admin->admin_id, 'name' => $admin->username]]);
    }
}