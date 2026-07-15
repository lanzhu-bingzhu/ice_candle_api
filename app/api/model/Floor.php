<?php

namespace app\api\model;

use app\api\BaseModel;

class Floor extends BaseModel
{
    public function getFloor() {
        $data = $this->where('is_show', 1)->order('sort', 'desc')->select();
        foreach ($data as $key => $value) {
            $category = Category::where('category_id', $value['category_id'])->find();
            $data[$key]['category_id'] = $category['category_id'];
            $data[$key]['parent_id'] = $category['parent_id'];
            $data[$key]['type'] = FloorType::where('floor_type_id', $value['type_id'])->value('name');
            $data[$key]['type_id'] = $category['type_id'];
            $data[$key]['title'] = $category['name'];
            $data[$key]['description'] = $category['description'];
            $data[$key]['items'] = Category::where('parent_id', $value['category_id'])->select();
        }
        return $data;
    }
}