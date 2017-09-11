<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/4/18
 * Time: 上午9:55
 */

namespace Home\Controller;

use Common\Controller\CommonController;
use Think\Auth;

class EmptyController extends CommonController
{
    // 主键
    protected $pk = '';
    // 分页参数
    protected $pages = array();
    protected $model = '';
    protected $order = '';
    protected $user = [];
    protected $auth = '';

    public function _initialize()
    {
        parent::_initialize();
        $this->user = session('User');
        $group = M('auth_group')->where(['id' => $this->user['group_id']])->getField('rules');
        $group = explode(',', $group);
        //获取菜单
        $where = ['sort_id' => 0, 'status' => 1, 'menu_type' => 0, 'id' => ['in', $group]];
        $menu = $this->select('AuthRule', $where, 'id,title,icon,name', 'list_order');
        foreach ($menu as $k => $v) {
            $second = $this->select('AuthRule', ['sort_id' => $v['id'], 'status' => 1], 'id,title,icon,name', 'list_order');
            $second_name = 'sec' . $v['id'];

            foreach ($second as $val) {
                $val['title'] == CONTROLLER_NAME && $menu[$k]['class'] = 'active';
            }
            CONTROLLER_NAME == $v['title'] && $menu[$k]['class'] = 'active';
            $menu[$k]['second'] = $second_name;
            $this->assign($second_name, $second);
        }
        $this->user['id'] && $this->user['head_img'] = M('user')->where(['id' => $this->user['id']])->getField('head_img');
        $this->checkAuth();
        '' != I('id') && $this->assign('id', I('id'));
        $this->assign('User', $this->user);
        $this->assign('nav_menu', $menu);
        '' != I('status') ? $this->where['status'] = I('status') : $this->where['status'] = ['neq', -1];
        '' != I('where') && $this->where = I('where');
    }

    /**
     * 权限验证的方法
     */
    public function checkAuth()
    {
        //判断用户是否有权限
        $auth = new Auth();
        $action = ACTION_NAME;
        $controller = CONTROLLER_NAME;
        if ($action == 'Status' || $action == 'ListOrder' || $action == 'edit_') {
            $action = 'edit';
        }
        if ($action == 'getData' || $action == 'getList' || $action == 'getRules') {
            $action = 'index';
        }
        $this->auth = $auth->check('/' . $controller . '/' . $action, $this->user['id']);
        'Index' == $controller && $action == 'index' && $this->auth = true;
        'Blog' == $controller && $action == 'index' && $this->auth = true;
//        1 == $this->user['id'] && $this->auth = true;

        if ($this->auth == false) {
            if (empty($this->user)) {
                redirect('/login');
            }
            $this->assign('auth_status', 9);
            IS_AJAX && $this->ajaxReturn(['status' => 9]);
        }
    }

    public function __empty()
    {
        $this->display();
    }

    /**
     * 列表数据
     */
    public function index()
    {
        $data = $this->select(CONTROLLER_NAME, $this->where);
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 获取数据列表 ajax
     */
    public function getData()
    {
        $this->ajaxReturn($this->select(CONTROLLER_NAME, $this->where));
    }


    /**
     * 信息新增或修改操作
     */
    public function add()
    {
        if (IS_POST) {
            $url = U('/' . CONTROLLER_NAME);
            if (I('skipping_link')) {
                $url = I('skipping_link');
            }
            $model = D(CONTROLLER_NAME);
            $model->startTrans();
            $id = $model->update();
            if (false != $id) {
                $info = 'Success';
                $model->commit();
                $this->success(['info' => $info, 'id' => $id], $url, $id);
            } else {
                $model->rollback();
                $this->error($model->getError());
            }
        } else {
            $this->display();
        }
    }

    /**
     * 编辑操作
     * @param int $id
     */
    public function edit($id = 0)
    {
        $this->ajaxReturn($this->info($id));
    }

//    public function edit_($id, $field = true, $model = CONTROLLER_NAME, $where = array(), $name = null)
//    {
//        $this->ajaxReturn(parent::info($id, $field, $model, $where, $name));
//    }
}