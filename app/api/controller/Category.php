<?php

namespace app\api\controller;

class Category
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Category();
    }

    public function index() {
        $category_id = input('category_id', '');
        $parent_id = input('parent_id', false);
        $data = $this->model->getList($category_id, $parent_id);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }

    public function read($id) {
        $data = $this->model->getDetail($id);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }
}