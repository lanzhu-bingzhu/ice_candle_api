<?php

namespace app\admin\controller;

use app\admin\BaseController;

class Upload extends BaseController
{
    public function save()
    {
        $file = request()->file('file');
        if (null === $file) {
            return $this->failResponse(400, '请上传图片文件');
        }
        try {
            validate([
                'file' => 'image|fileSize:5242880|fileExt:jpg,jpeg,png,gif,webp'
            ])->check(['file' => $file]);
        } catch (\think\exception\ValidateException $e) {
            return $this->failResponse(400, $e->getMessage());
        }
        $fileName = \think\facade\Filesystem::putFile('images', $file, 'uniqid');
        $url = request()->domain() . '/upload/' . $fileName;
        return $this->successResponse(['url' => $url, 'filename' => basename($fileName),]);
    }
}