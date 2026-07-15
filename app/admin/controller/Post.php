<?php

namespace app\admin\controller;

use app\admin\BaseController;
use app\admin\model\PostMedia;
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
            PostMedia::where($this->model->getPk(), $id)->delete();
        }
        return $this->successResponse($res);
    }

    public function getParameter()
    {
        return [
            'category_id' => input('category_id'),
            'title' => input('title'),
            'type_id' => input('type_id'),
            'summary' => input('summary', ''),
            'cover' => input('cover', ''),
            'author' => input('author', ''),
            'avatar' => input('avatar', ''),
            'content' => input('content', ''),
            'description' => input('description', ''),
            'images' => input('images', []),
            'tags' => input('tags', []),
        ];
    }
}