<?php

namespace app\admin\controller;

use app\admin\BaseController;
use app\admin\model\CategoryType;
use think\App;

class Category extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\Category();
        parent::__construct($app);
    }

    public function index()
    {
        $limit = input('limit', 10);
        $page = input('page', 1);
        $data = $this->model->getList([], $limit, $page);
        $count = $this->model->getListCount([]);
        return $this->successResponse(['items' => $data, 'count' => $count]);
    }

    public function read($id)
    {
        $data = $this->model->getDetail($id);
        return $this->successResponse($data);
    }

    public function save()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }

    public function getAllCategory()
    {
        $data = $this->model->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = CategoryType::where('category_type_id', $value['type_id'])->value('name');
        }
        return $this->successResponse(['items' => $data, 'count' => count($data)]);
    }
}