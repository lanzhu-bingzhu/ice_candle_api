<?php

namespace app\api\model;

use app\api\BaseModel;

class Category extends BaseModel
{
    public function getList($parent_id = 0) {
        $data = $this->where('parent_id', $parent_id)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = CategoryType::where('category_type_id', $value['type_id'])->value('name');
        }
        return $data;
    }

    public function getDetali($id) {
        $data = $this->where('category_id', $id)->find();
        $data['type'] = CategoryType::where('category_type_id', $data['type_id'])->value('name');
        return $data;
    }
}