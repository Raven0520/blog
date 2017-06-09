<?php

namespace Common\Model;

use Think\Db;
use Think\Model\RelationModel;

/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/4/20
 * Time: 下午3:36
 */
class CommonModel extends RelationModel
{
    protected $_data = array();

    protected $_auto = array(
        array('create_time', NOW_TIME, 1),
        array('update_time', NOW_TIME, 2)
    );

    public function update($data = null)
    {
        $this->_data = $data;

        //transaction 在model.class.php 与 Drive.class.php 中添加了 transaction方法

        $data = empty($this->_data) ? $_POST : $this->_data;
        if ($data['skipping_link']){
            unset($data['skipping_link']);
        }
        '自动编号' == $data['id'] && $data['id'] = '';
        $data = $this->create($data);
        if (!$data) {
            return false;
        }
        return empty ($data [$this->getPk()]) ? $this->add() : $this->save();

//        $it = &$this;
//        $fun = function ()use($it){
//        $ob = $this;
//        isset($ob)|| $ob=$it;
//        $data = empty($data) ? $_POST : $data;
//        '自动编号' == $data['id'] && $data['id'] = '';
//        $data = $ob->create($data);
//        if (!$data) {
//            return false;
//        }
//        return empty ($data [$ob->pk]) ? $ob->add() : $ob->save();
//        };
//        return Db::transaction($fun);
    }

    public function _update($data = null)
    {
        $this->_data = $data;

        //transaction 在model.class.php 与 Drive.class.php 中添加了 transaction方法

        return Db::transaction(function ($model) {
            $data = empty($model->_data) ? $_POST : $model->_data;
            '自动编号' == $data['id'] && $data['id'] = '';
            $data = $model->create($data);
            if (!$data) {
                return false;
            }
            return empty ($data [$model->getPk()]) ? $model->add() : $model->save();
        }, $this);
    }

    /**
     * 获取id为键的列表的方法
     */
    public function getDataKeyById($model = CONTROLLER_NAME, $where = null, $field, $sepa = null)
    {
        return D($model)->where($where)->getField($field, $sepa);
    }
}