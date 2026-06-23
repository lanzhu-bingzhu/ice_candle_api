<?php

namespace app\api\model;

use think\Model;

class Floor extends Model
{
    public function getFloor() {
        $data = $this->order('sort', 'desc')->select();
        foreach ($data as $key => $value) {
            $category = Category::where('category_id', $value['category_id'])->find();
            $data[$key]['category_id'] = $category['category_id'];
            $data[$key]['parent_id'] = $category['parent_id'];
            $data[$key]['type_id'] = $category['type_id'];
            $data[$key]['title'] = $category['name'];
            $data[$key]['description'] = $category['description'];
            $data[$key]['items'] = Category::where('parent_id', $value['category_id'])->select();
        }
        return $data;
    }
}