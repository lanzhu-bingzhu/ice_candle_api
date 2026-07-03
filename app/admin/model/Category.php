<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Category extends BaseModel
{
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
        $data = $this->where('category_id', $id)->find();
        $data['type'] = CategoryType::where('category_type_id', $data['type_id'])->value('name');
        return $data;
    }
}