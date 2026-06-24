<?php

namespace app\api\model;

use app\api\BaseModel;

class PostTag extends BaseModel
{
    protected $pk = 'post_tag_id';

    public function posts()
    {
        return $this->belongsToMany('Post', 'PostTagAssociate', 'post_id', 'post_tag_id');
    }
}