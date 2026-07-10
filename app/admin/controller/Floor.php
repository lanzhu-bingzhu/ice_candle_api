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
}