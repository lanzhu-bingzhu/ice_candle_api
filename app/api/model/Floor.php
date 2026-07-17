<?php

namespace app\api\model;

use app\api\BaseModel;

class Floor extends BaseModel
{
    public function category()
    {
        return $this->hasOne('Category', 'category_id', 'category_id');
    }

    public function getFloor() {
        return $this->with(['category.children'])->where('is_show', 1)->order('sort', 'desc')->select();
    }
}