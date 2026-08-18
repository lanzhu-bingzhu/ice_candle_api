<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Configuration extends BaseModel
{
    public $pk = 'config_id';

    public function getList($where = [])
    {
        $data = $this->where($where)->select();
        foreach ($data as $key => $value) {
            if ('recommendations_image' == $value['name']) {
                $data[$key]['value'] = json_decode($value['value'], true);
            }
        }
        return $data;
    }

    public function getListCount($where = [])
    {
        $data = $this->where($where)->count();
        return $data;
    }

    public function addData($data)
    {
        foreach ($data as $key => $val) {
            if ('recommendations_image' == $key) {
                $_temp = [
                    'name' => $key,
                    'value' => json_encode($val),
                ];
            } else {
                $_temp = [
                    'name' => $key,
                    'value' => $val
                ];
            }
            $config = $this->where('name', $key)->find();
            if ($config) {
                $this->where('name', $key)->update($_temp);
            } else {
                self::create($_temp);
            }
        }
        return true;
    }
}