<?php

namespace app\admin\controller;

use app\admin\BaseController;
use think\App;

class User extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\Admin();
        parent::__construct($app);
    }

    public function save()
    {
        $username = input('username');
        $password = input('password');
        if (!$username || !$password) {
            return $this->failResponse(500, '参数不足');
        }
        $admin = $this->model->where('username', $username)->find();
        if ($admin) {
            return $this->failResponse(500, '用户名存在');
        }
        $this->model->save(['username' => $username, 'password' => $this->generateHashPassword($password), 'created_at' => time()]);
        return $this->successResponse();
    }

    public function generateHashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}