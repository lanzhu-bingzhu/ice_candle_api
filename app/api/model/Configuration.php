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
        if ($data['recommendations_content']) {
            $data['recommendations_content'] = json_decode($data['recommendations_content'], true);
        }
        return $data;
    }
}