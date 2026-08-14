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
        if (!$data) {
            return false;
        }
        $data['type'] = PostType::where('post_type_id', $data['type_id'])->value('name');
        $data['images'] = PostMedia::where('post_id', $data['post_id'])->column('src');
        return $data;
    }

    public function getCategoryAllChildrenId($category_id) {
        $category_list = Category::where('parent_id', $category_id)->select();

        $category_ids = [];
        if ($category_list) {
            $category_ids = array_values(array_column($category_list->toArray(), 'category_id'));
        }

        $_temp = [];
        foreach ($category_list as $key => $value) {
            $_temp = $this->getCategoryAllChildrenId($value['category_id']);
        }

        return array_merge($_temp, $category_ids);
    }
}