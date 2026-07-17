<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Floor extends BaseModel
{
    protected $pk = 'floor_id';

    public function floorType()
    {
        return $this->hasOne('FloorType', 'floor_type_id', 'type_id');
    }

    public function category()
    {
        return $this->hasOne('Category', 'category_id', 'category_id');
    }

    public function getList($where = [], $limit = 10, $page = 1)
    {
        $data = $this->with(['floor_type', 'category'])->where($where)->page($page, $limit)->select();
        return $data;
    }

    public function getListCount($where = [])
    {
        $data = $this->where($where)->count();
        return $data;
    }

    public function getDetail($id)
    {
        $data = $this->where($this->pk, $id)->find();
        return $data;
    }

    public function addData($data)
    {
        $data['created_at'] = time();
        $model = self::create($data);
        if (!$model) {
            return false;
        }
        return $model->floor_id;
    }

    public function editData($id, $data)
    {
        $data['updated_at'] = time();
        $res = $this->where($this->pk, $id)->save($data);
        if (!$res) {
            return false;
        }
        return $id;
    }
}