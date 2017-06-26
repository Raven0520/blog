<?php
/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/6/23
 * Time: 下午10:49
 */

namespace Home\Model;
use Common\Model\CommonModel;

class ProfileModel extends CommonModel
{
    public function _after_insert($data, $options)
    {
        D('User')->update(['id'=>$data['user_id'],'profile_id'=>$data['id']]);
    }
}