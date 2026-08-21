<?php

namespace app\admin\controller;

use app\admin\BaseController;
use think\App;

class Configuration extends BaseController
{
    protected $model;

    public function __construct(App $app) {
        $this->model = new \app\admin\model\Configuration();
        parent::__construct($app);
    }

    public function index() {
        $data = $this->model->getList();
        $count = $this->model->getListCount();
        return $this->successResponse(['items' => $data, 'count' => $count]);
    }

    public function save()
    {
        $parameter = $this->getParameter();
        $data = $this->model->addData($parameter);
        return $this->successResponse($data);
    }

    public function getParameter()
    {
        return [
            'header_image' => input('header_image', ''),
            'navigation_image' => input('navigation_image'),
            'recommendations_image' => input('recommendations_image', []),
            'recommendations_content' => input('recommendations_content', []),
            'introduction_image' => input('introduction_image', ''),
            'introduction_text' => input('introduction_text', ''),
        ];
    }
}