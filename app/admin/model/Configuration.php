<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Configuration extends BaseModel
{
    public $pk = 'config_id';

    public function getList($where = [])
    {
        $data = $this->where($where)->column('value', 'name');
        foreach ($data as $key => $value) {
            if (in_array($key, ['recommendations_image', 'recommendations_content'])) {
                $data[$key] = json_decode($value, true);
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
            if (in_array($key, ['recommendations_image', 'recommendations_content'])) {
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