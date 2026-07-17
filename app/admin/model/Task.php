<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Task extends BaseModel
{
    protected $pk = 'task_id';

    public function taskNodes()
    {
        return $this->hasMany('TaskNode', 'task_id', 'task_id');
    }

    public function getList($where = [], $limit = 10, $page = 1)
    {
        $data = $this->where($where)->page($page, $limit)->select();
        return $data;
    }

    public function getListCount()
    {
        $data = $this->count();
        return $data;
    }

    public function getDetail($id)
    {
        $data = $this->with(['task_nodes'])->where($this->pk, $id)->find();
        return $data;
    }

    public function addData($data)
    {
        try {
            $task_nodes = $data['task_nodes'];
            $data['deadline'] = $data['deadline'] ? strtotime($data['deadline']) : null;
            $data['created_at'] = time();
            unset($data['task_id']);
            unset($data['task_nodes']);

            $model = self::create($data);
            if ($task_nodes) {
                $task_node_model = new TaskNode();
                $nodes = [];
                foreach ($task_nodes as $node) {
                    $nodes[] = [
                        'task_id' => $model->task_id,
                        'title' => $node['title'],
                        'description' => $node['description'],
                        'details' => $node['details'],
                        'status_id' => $node['status_id'],
                        'completed_at' => $node['completed_at'] ? strtotime($node['completed_at']) : null,
                        'result' => json_encode($node['result']),
                        'created_at' => time()
                    ];
                }
                $task_node_model->saveAll($nodes);
            }
            return $model->task_id;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function editData($id, $data)
    {
        try {
            $task_nodes = $data['task_nodes'];
            $data['deadline'] = $data['deadline'] ? strtotime($data['deadline']) : null;
            $data['updated_at'] = time();
            unset($data['task_id']);
            unset($data['task_nodes']);

            $res = $this->where($this->pk, $id)->save($data);
            if (!$res) {
                return false;
            }

            TaskNode::where('task_id', $id)->delete();
            if ($task_nodes) {
                $task_node_model = new TaskNode();
                $nodes = [];
                foreach ($task_nodes as $node) {
                    $nodes[] = [
                        'task_id' => $id,
                        'title' => $node['title'],
                        'description' => $node['description'],
                        'details' => $node['details'],
                        'status_id' => $node['status_id'],
                        'completed_at' => $node['completed_at'] ? strtotime($node['completed_at']) : null,
                        'result' => json_encode($node['result']),
                        'updated_at' => time()
                    ];
                }
                $task_node_model->saveAll($nodes);
            }
            return $id;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getDeadlineAttr($value) {
        return $value ? date('Y-m-d H:i:s', $value) : null;
    }
}