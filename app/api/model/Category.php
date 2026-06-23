<?php

namespace app\api\model;

use think\Model;

class Category extends Model
{
    public function getList($parent_id = 0) {
        return $this->where('parent_id', $parent_id)->select();
    }
}