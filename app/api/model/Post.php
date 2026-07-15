<?php

namespace app\api\model;

use app\api\BaseModel;

class Post extends BaseModel
{
    protected $pk = 'post_id';

    public function tags() {
        return $this->belongsToMany('PostTag', 'PostTagAssociate', 'post_tag_id', 'post_id');
    }

    public function getList($where) {
        $data = $this->with(['tags'])->where($where)->where('is_show', 1)->select();
        foreach ($data as $key => $value) {
            $data[$key]['type'] = PostType::where('post_type_id', $value['type_id'])->value('name');
            $data[$key]['images'] = PostMedia::where('post_id', $value['post_id'])->column('src');
        }
        return $data;
    }

    public function getDetail($id) {
        $data = $this->with(['tags'])->where('post_id', $id)->where('is_show', 1)->find();
        $data['type'] = PostType::where('post_type_id', $data['type_id'])->value('name');
        $data['images'] = PostMedia::where('post_id', $data['post_id'])->column('src');
        return $data;
    }
}