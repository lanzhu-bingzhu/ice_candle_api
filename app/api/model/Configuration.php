<?php

namespace app\api\model;

use app\api\BaseModel;

class Configuration extends BaseModel
{
    public function getList()
    {
        $data = $this->column('value', 'name');
        if ($data['recommendations_image']) {
            $data['recommendations_image'] = json_decode($data['recommendations_image'], true);
        }
        return $data;
    }
}