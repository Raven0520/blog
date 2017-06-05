<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/5/28
 * Time: 下午11:34
 */

namespace Home\Controller;


use Think\Controller;

class LoginController extends Controller
{
    public function index(){

        $this->display();
    }

    public function login(){
        $user = M('user')->where(['username|nickname'=>$_POST['username']])->find();
        if (!$user){
            $info = ['info'=>'用户不存在','status'=>2];
        }elseif ($user['status'] != 1){
            $info = ['info' => '用户被禁用','status' =>2];
        }elseif (getMD5($_POST['password']) != $user['password']){
            $info = ['info'=>'密码错误','status'=>2];
        }else{
            $this->updateUser($user['id']);
            $info = ['info'=>'欢迎回来','status'=>1,'url'=>'/'];
        }
        S('User',$user);
        $this->ajaxReturn($info);
    }

    public function register(){

        if ($_POST){
            $nickname = M('user')->where(['nickname'=>$_POST['nickname']])->find();
            if ($nickname){
                $this->ajaxReturn(['info'=>'昵称已存在','status'=>2]);
            }
            $token = M('config')->where(['name'=>'register','value'=>$_POST['token']])->find();
            if (!$token){
                $this->ajaxReturn(['info'=>'Token 错误','status'=>2]);
            }
            $_POST['password'] = getMD5($_POST['password']);
            $_POST['group_id'] = 2;

            $res = D('User')->_update($_POST);
            if ($res){
                $info = [
                    'info' => 'Register Success !',1
                    'status' => 1,
                    'url' => '/'
                ];
            }else{
                $info = [
                    'info' => D('User')->getError(),
                    'status' => 2
                ];
            }
            $this->ajaxReturn($info);
        }

        $this->display();
    }

    /**
     * 获取用户登录IP
     */
    public function getIp(){
        $ip = '';
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = 'UnKnow';
        }
        return $ip;
    }

    /**
     * @param $id
     */

    public function updateUser($id){
        //获取用户IP地址
        
    }
}