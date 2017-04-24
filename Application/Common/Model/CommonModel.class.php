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
    );

    public function update($data = null) {
        $this->_data = $data;

        //transaction 在model.class.php 与 Drive.class.php 中添加了 transaction方法

        return Db::transaction(function($model) {
            $data = empty($model->_data) ? $_POST : $model->_data;
            '自动编号' == $data['id'] && $data['id'] = '';
            $data = $model->create($data);
            if (!$data) {
                return false;
            }
            return empty ($data [$model->getPk()]) ? $model->add() : $model->save();
        }, $this);

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
}