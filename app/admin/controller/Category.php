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
        $parameter = $this->getParameter();
        $data = $this->model->addData($parameter);
        return $this->successResponse($data);
    }

    public function update($id)
    {
        if (!$id) {
            return $this->failResponse();
        }
        $parameter = $this->getParameter();
        $data = $this->model->editData($id, $parameter);
        return $this->successResponse($data);
    }

    public function delete($id)
    {

    }

    public function getAllCategory()
    {
        $data = $this->model->where('type_id', 1)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = CategoryType::where('category_type_id', $value['type_id'])->value('name');
        }
        return $this->successResponse(['items' => $data, 'count' => count($data)]);
    }

    public function getParameter()
    {
        return [
            'name' => input('name'),
            'parent_id' => input('parent_id'),
            'type_id' => input('type_id'),
            'description' => input('description'),
        ];
    }
}