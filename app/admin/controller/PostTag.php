<?php

namespace app\admin\controller;

use app\admin\BaseController;
use think\App;

class PostTag extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        $this->model = new \app\admin\model\PostTag();
        parent::__construct($app);
    }

    public function getAllPostTag()
    {
        $data = $this->model->select();
        return $this->successResponse(['items' => $data, 'count' => count($data)]);
    }
}