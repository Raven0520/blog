<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/6/9
 * Time: 上午1:29
 */

namespace Home\Model;


use Common\Model\CommonModel;

class UserModel extends CommonModel
{
    public function _after_select(&$result, $options)
    {
        $auth_group = $this->getDataKeyById('AuthGroup',['status'=>1],'id,title');
        foreach ($result as $k => $v){
            $result[$k]['group'] = $auth_group[$v['group_id']];
            '' == $v['head_img'] && $result[$k]['head_img'] = '/Public/img/default_head_img.png';
        }
    }
}