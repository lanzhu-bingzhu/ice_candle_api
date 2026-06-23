<?php

namespace app\api\controller;

class Task
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Task();
    }

    public function index() {
        $data = $this->model->getList();
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }

    public function read($name) {
        $data = $this->model->getDetali($name);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }
}