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
        $data = $this->where($this->pk, $id)->find();
        $data['images'] = PostMedia::where('post_id', $id)->column('src');
        return $data;
    }

    public function addData($data)
    {
        try {
            $images = $data['images'] ?? [];
            $data['created_at'] = time();
            unset($data['images']);

            $model = self::create($data);
            if ($images) {
                $post_media_model = new PostMedia();
                $post_media = [];
                foreach ($images as $key => $value) {
                    $post_media[] = [
                        'post_id' => $model->post_id,
                        'src' => $value,
                        'created_at' => time()
                    ];
                }
                $post_media_model->saveAll($post_media);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function editData($id, $data)
    {
        try {
            $images = $data['images'] ?? [];
            $data['updated_at'] = time();
            unset($data['images']);

            $res = $this->where($this->pk, $id)->save($data);
            if (!$res) {
                return false;
            }

            PostMedia::where('post_id', $id)->delete();
            if ($images) {
                $post_media_model = new PostMedia();
                $post_media = [];
                foreach ($images as $key => $value) {
                    $post_media[] = [
                        'post_id' => $id,
                        'src' => $value,
                        'created_at' => time()
                    ];
                }
                $post_media_model->saveAll($post_media);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}