<?php

namespace app\api\controller;

class Floor
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Floor();
    }

    public function index() {
        $data = $this->model->getFloor();
        return json(['code' => 200, 'message' => 'Success', 'data' => $data]);
    }
}