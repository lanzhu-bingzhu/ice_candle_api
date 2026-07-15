<?php

namespace app\api\model;

use app\api\BaseModel;

class Task extends BaseModel
{
    public function taskNodes()
    {
        return $this->hasMany('TaskNode', 'task_id', 'task_id');
    }

    public function getList() {
        $data = $this->where('is_show', 1)->select();
        foreach ($data as $key => $value) {
            $data[$key]['deadline'] = $value['deadline'] ? date('Y-m-d H:i:s', $value['deadline']) : null;
        }
        return $data;
    }

    public function getDetali($name) {
        $data = $this->alias('t')
            ->with(['task_nodes'])
            ->where('is_show', 1)
            ->where('t.name', $name)
            ->find();
        if (!$data) {
            return [];
        }
        $data['deadline'] = $data['deadline'] ? date('Y-m-d H:i:s', $data['deadline']) : null;
        foreach ($data['task_nodes'] as $key => $value) {
            $data['task_nodes'][$key]['completed_at'] = $value['completed_at'] ? date('Y-m-d H:i:s', $value['completed_at']) : null;
            $data['task_nodes'][$key]['status'] = TaskStatus::where('task_status_id', $value['status_id'])->value('name');
            $data['task_nodes'][$key]['result'] = json_decode($value['result']);
        }
        return $data;
    }
}