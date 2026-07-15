<?php

namespace app\admin\controller;

use app\admin\BaseController;
use app\admin\model\TaskNode;
use think\App;

class Task extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\Task();
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
        if ($res) {
            TaskNode::where('task_id', $id)->delete();
        }
        return $this->successResponse($res);
    }

    public function getParameter()
    {
        return [
            'name' => input('name', ''),
            'title' => input('title', ''),
            'overall_description' => input('overall_description', ''),
            'header_image' => input('header_image', ''),
            'deadline' => input('deadline', ''),
            'task_nodes' => input('task_nodes', []),
        ];
    }
}