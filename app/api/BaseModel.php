<?php

namespace app\api;

use think\Model;

class BaseModel extends Model
{
    public function getCreatedAtAttr($value) {
        return $value ? date('Y-m-d H:i:s', $value) : null;
    }

    public function getUpdatedAtAttr($value) {
        return $value ? date('Y-m-d H:i:s', $value) : null;
    }
}