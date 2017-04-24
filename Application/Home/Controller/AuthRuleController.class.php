<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/4/20
 * Time: 下午3:29
 */

namespace Home\Controller;


class AuthRuleController extends EmptyController
{
    //注册顶级菜单
    public function index(){

        $this->where['status'] = 1;
        $icon = $this->select(CONTROLLER_NAME,$this->where,'icon,title');
        $icon = json_encode($icon);
        $menu = $this->select(CONTROLLER_NAME,$this->where);
        $menu = json_encode($menu);
        $this->where['sort_id'] = 0;
        $sort = $this->select(CONTROLLER_NAME,$this->where);

        $this->assign('icon',$icon);
        $this->assign('menu',$menu);
        $this->assign('sort',$sort);
        $this->display();
    }
}