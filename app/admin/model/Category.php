<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Category extends BaseModel
{
    protected $pk = 'category_id';

    public function getList($where = [], $limit = 10, $page = 1) {
        $data = $this->where($where)->page($page, $limit)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = CategoryType::where('category_type_id', $value['type_id'])->value('name');
        }
        return $data;
    }

    public function getListCount($where = []) {
        $data = $this->where($where)->count();
        return $data;
    }

    public function getDetail($id) {
        $data = $this->where($this->pk, $id)->find();
        if (!$data) {
            return [];
        }
        $data['type'] = CategoryType::where('category_type_id', $data['type_id'])->value('name');
        return $data;
    }

    public function addData($data)
    {
        $data['created_at'] = time();
        $model = self::create($data);
        if (!$model) {
            return false;
        }
        return $model->category_id;
    }

    public function editData($id, $data)
    {
        $data['updated_at'] = time();
        $res = $this->where($this->pk, $id)->save($data);
        if (!$res) {
            return false;
        }
        return $id;
    }
}