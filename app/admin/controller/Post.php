<?php

namespace app\admin\controller;

use app\admin\BaseController;
use think\App;

class Post extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\Post();
        parent::__construct($app);
    }

    public function index()
    {
        $limit = input('limit', 10);
        $page = input('page', 1);
        $data = $this->model->getList($limit, $page);
        $count = $this->model->getListCount();
        return $this->successResponse(['items' => $data, 'count' => $count]);
    }

    public function read($id)
    {
        $data = $this->model->getDetail($id);
        return $this->successResponse($data);
    }

    public function save()
    {
        return $this->successResponse();
    }

    public function update($id)
    {
        return $this->successResponse();
    }

    public function delete($id)
    {
        return $this->successResponse();
    }
}