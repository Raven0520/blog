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
    protected $where = array();

    public function _initialize()
    {
        parent::_initialize();
        //获取菜单
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
            if (false !== $model->update()) {
                $this->success('操作成功', U('index'));
            } else {
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