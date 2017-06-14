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

    public function _after_insert($data, $options)
    {
        $data['group_id'] && $this->updateAuthGroupAccess($data['id'],$data['group_id']);
    }
    public function _after_update($data, $options)
    {
        $data['group_id'] && $this->updateAuthGroupAccess($data['id'],$data['group_id']);
    }

    public function updateAuthGroupAccess($id,$group_id){
        $access = M('auth_group_access')->where(['uid' => $id])->find();
        if ($access){
            M('auth_group_access')->where(['uid' => $id])->save(['group_id'=>$group_id]);
        }else{
            M('auth_group_access')->add(['group_id'=>$group_id,'uid'=>$id]);
        }
    }
}