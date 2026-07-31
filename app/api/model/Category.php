<?php

namespace app\api\model;

use app\api\BaseModel;

class Category extends BaseModel
{
    public function children()
    {
        return $this->hasMany('Category', 'parent_id', 'category_id');
    }

    public function getList($category_id, $parent_id = 0) {
        $map = $this->getMap($category_id, $parent_id);
        $data = $this->where($map)->where('is_show', 1)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = CategoryType::where('category_type_id', $value['type_id'])->value('name');
        }
        return $data;
    }

    public function getMap($category_id, $parent_id = 0) {
        $map = [];
        if ($category_id) {
            $map[] = ['category_id', '=', $category_id];
        }
        if ($parent_id) {
            $map[] = ['parent_id', '=', $parent_id];
        }
        return $map;
    }

    public function getDetail($id) {
        $data = $this->where('category_id', $id)->where('is_show', 1)->find();
        $data['type'] = CategoryType::where('category_type_id', $data['type_id'])->value('name');
        return $data;
    }
}