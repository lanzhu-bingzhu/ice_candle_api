<?php

namespace app\api\controller;

class Category
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Category();
    }

    public function index() {
        $parent_id = input('param.parent_id', 0);
        $data = $this->model->getList($parent_id);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }
}