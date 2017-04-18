<?php

namespace Common\Controller;

use Think\Controller;

/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/4/18
 * Time: 上午9:49
 */
class CommonController extends Controller
{
    public function _initialize()
    {

    }

    /**
     * 查询单条数据
     * @param $id
     * @param bool $field
     * @param mixed|string $model
     * @param null $name
     * @return mixed
     */
    protected function info($id, $field = true, $model = CONTROLLER_NAME, $where = array(), $name = null) {
        $pk = M($model)->getPk();
        $map = array();
        if ($id && !$name) {
            $map[$pk] = $id;
        } else {
            $map[$name] = $id;
        }
        $info = D($model)->field($field)->where($map)->where($where)->find();
        if (is_string($field) && 1 == count(explode(',', $field))) {
            return $info[$field];
        }
        return $info;
    }
}