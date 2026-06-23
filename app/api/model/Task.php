<?php

namespace app\api\model;

use think\Model;

class Task extends Model
{
    public function taskNodes()
    {
        return $this->hasMany('TaskNode', 'task_id', 'task_id');
    }

    public function getList() {
        $data = $this->select();
        foreach ($data as $key => $value) {
            $data[$key]['deadline'] = $value['deadline'] ? date('Y-m-d H:i:s', $value['deadline']) : null;
            $data[$key]['created_at'] = $value['created_at'] ? date('Y-m-d H:i:s', $value['created_at']) : null;
            $data[$key]['updated_at'] = $value['updated_at'] ? date('Y-m-d H:i:s', $value['updated_at']) : null;
        }
        return $data;
    }

    public function getDetali($name) {
        $data = $this->alias('t')
            ->with(['task_nodes'])
            ->where('name', $name)
            ->find();
        $data['deadline'] = $data['deadline'] ? date('Y-m-d H:i:s', $data['deadline']) : null;
        $data['created_at'] = $data['created_at'] ? date('Y-m-d H:i:s', $data['created_at']) : null;
        $data['updated_at'] = $data['updated_at'] ? date('Y-m-d H:i:s', $data['updated_at']) : null;
        foreach ($data['task_nodes'] as $key => $value) {
            $data['task_nodes'][$key]['completed_at'] = $value['completed_at'] ? date('Y-m-d H:i:s', $value['completed_at']) : null;
            $data['task_nodes'][$key]['created_at'] = $value['created_at'] ? date('Y-m-d H:i:s', $value['created_at']) : null;
            $data['task_nodes'][$key]['updated_at'] = $value['updated_at'] ? date('Y-m-d H:i:s', $value['updated_at']) : null;
            $data['task_nodes'][$key]['status'] = TaskStatus::where('task_status_id', $value['status_id'])->value('name');
            $data['task_nodes'][$key]['result'] = json_decode($value['result']);
        }
        return $data;
    }
}