<?php

namespace app\admin\controller;

use app\admin\BaseController;
use think\App;

class Floor extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\Floor();
        parent::__construct($app);
    }

    public function index()
    {
        $data = $this->model->getList();
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
        $res = $this->model->where($this->model->getPk(), $id)->delete();
        return $this->successResponse($res);
    }

    public function getParameter()
    {
        return [
            'category_id' => input('category_id', 0),
            'type_id' => input('type_id'),
            'title' => input('title', ''),
            'description' => input('description', ''),
            'image' => input('image', ''),
            'link' => input('link', ''),
            'alt' => input('alt', ''),
            'sort' => input('sort', 0),
            'is_show' => input('is_show', 1),
        ];
    }
}