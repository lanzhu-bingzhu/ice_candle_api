<?php

namespace app\api\controller;

class Configuration
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Configuration();
    }

    public function index() {
        $data = $this->model->getList();
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }
}