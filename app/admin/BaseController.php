<?php

namespace app\admin;

class BaseController extends \app\BaseController
{
    public function successResponse($data = []): \think\response\Json
    {
        return json(['code' => 200, 'message' => 'success', 'data' => $data]);
    }

    public function failResponse($code = 500, $message = 'fail', $data = []): \think\response\Json
    {
        return json(['code' => $code, 'message' => $message, 'data' => $data]);
    }
}