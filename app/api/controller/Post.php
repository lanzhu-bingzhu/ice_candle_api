<?php

namespace app\api\controller;

class Post
{
    private $model;

    public function __construct() {
        $this->model = new \app\api\model\Post();
    }

    public function index($category_id) {
        $where = [];
        if ($category_id) {
            $where[] = ['category_id', '=', $category_id];
        }
        $data = $this->model->getList($where);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }

    public function read($id) {
        $data = $this->model->getDetail($id);
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }
}