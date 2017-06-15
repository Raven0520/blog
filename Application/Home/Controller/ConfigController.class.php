<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/5/29
 * Time: 上午1:38
 */

namespace Home\Controller;


class ConfigController extends EmptyController
{
    protected $model = CONTROLLER_NAME;

    public function getToken()
    {
        1 == I('expired') && $this->where['expired_time'] = ['lt', time()];
        $name = I('name'); $action = I('action'); $token = [];
        1 == $action && $token = $this->info($name, 'id,name,value,expired_time,status', CONTROLLER_NAME, [], 'name');
        if (!$token || $action != 1) {
            $data = [
                'name'  => $name,
                'value' => md5($name . time()),
            ];
            1 == I('expired') && $data['expired_time'] = time() + 86400;
            1 != $action && $data['id'] = $_POST['id'];
            $res = D($this->model)->_update($data);
            if ($res) {
                $token = $this->info($name, 'id,name,value,expired_time,status', CONTROLLER_NAME, [], 'name');
            } else {
                $this->ajaxReturn(['status' => 0, 'info' => '写入数据失败']);
            }
        }
        $this->ajaxReturn($token);
    }
}