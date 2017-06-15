<?php
namespace Home\Controller;

class IndexController extends EmptyController
{
    public function index()
    {
        $head_img = scandir('Public/head_img');
        unset($head_img[0]);unset($head_img[1]);unset($head_img[2]);

        '' == $this->user && redirect('/Blog');

        $this->assign('head_img',$head_img);
        $this->display();
    }
}