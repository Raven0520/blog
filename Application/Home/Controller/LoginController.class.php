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
        $info = ['info'=>'欢迎回来','status'=>1,'url'=>'/'];
        $this->ajaxReturn($info);
    }
}