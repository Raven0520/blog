<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/4/18
 * Time: 上午9:55
 */

namespace Home\Controller;

use Common\Controller\CommonController;

class EmptyController extends CommonController
{
    // 主键
    protected $pk = '';
    // 分页参数
    protected $pages = array();
    protected $model = '';
    protected $order = '';

    public function _initialize()
    {
        parent::_initialize();
        //获取菜单
        $menu = $this->select('AuthRule',['sort_id'=>0,'status'=>1],'id,title,icon,name','list_order');
        foreach ($menu as $k => $v){
            $second = $this->select('AuthRule',['sort_id'=>$v['id'],'status'=>1],'id,title,icon,name','list_order');
            $second_name = 'sec'.$v['id'];

            foreach ($second as $val){
                $val['title'] == CONTROLLER_NAME && $menu[$k]['class'] = 'active';
            }
            CONTROLLER_NAME == $v['title'] && $menu[$k]['class'] = 'active';
            $menu[$k]['second'] = $second_name;
            $this->assign($second_name,$second);
        }
        $this->assign('nav_menu',$menu);
        $this->where['status'] = array('neq', -1);
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
     * 信息新增或修改操作
     */
    public function add()
    {
        if (IS_POST) {
            $model = D(CONTROLLER_NAME);
            $model->startTrans();
            if (false !== $model->update()) {
                $model->commit();
                $this->success('Success', U('/'.CONTROLLER_NAME));
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
     * @param null $id
     */
    public function edit($id = 0) {
        $this->ajaxReturn($this->info($id));
    }
}