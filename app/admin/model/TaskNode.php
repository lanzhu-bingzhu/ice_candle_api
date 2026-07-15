<?php

namespace app\admin\model;

use app\admin\BaseModel;

class TaskNode extends BaseModel
{
    public function taskStatus()
    {
        return $this->hasOne('TaskStatus', 'task_status_id', 'status_id');
    }

    public function getCompletedAtAttr($value) {
        return $value ? date('Y-m-d H:i:s', $value) : null;
    }

    public function getResultAttr($value) {
        return $value ? json_decode($value, true) : [];
    }
}