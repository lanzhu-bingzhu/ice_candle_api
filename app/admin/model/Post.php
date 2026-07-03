<?php

namespace app\admin\model;

use app\admin\BaseModel;

class Post extends BaseModel
{
    protected $pk = 'post_id';

    public function tags() {
        return $this->belongsToMany('PostTag', 'PostTagAssociate', 'post_tag_id', 'post_id');
    }

    public function getList($limit = 10, $page = 1)
    {
        $data = $this->with(['tags'])->page($page, $limit)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = PostType::where('post_type_id', $value['type_id'])->value('name');
            $data[$key]['images'] = PostMedia::where('post_id', $value['post_id'])->column('src');
        }
        return $data;
    }

    public function getListCount()
    {
        $data = $this->count();
        return $data;
    }

    public function getDetail($id)
    {
        $data = $this->where('post_id', $id)->find();
        return $data;
    }
}