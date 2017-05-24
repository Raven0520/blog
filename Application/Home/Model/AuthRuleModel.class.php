<?php
namespace Home\Model;
use Common\Model\CommonModel;

/**
 * Created by PhpStorm.
 * User: raven
 * Date: 2017/5/16
 * Time: 下午11:38
 */
class AuthRuleModel extends CommonModel
{
    protected $menu_type = [
        0 => 'Top Menu',
        1 => 'Second Menu',
        2 => 'Window',
        3 => 'Button'
    ];

    protected $previous = [];

    public function _after_find(&$result, $options)
    {
        $this->previous = $this->getField('id,title');
        $this->previous[0] = 'Top';
        $result['menu_type_name'] = $this->menu_type[$result['menu_type']];
        $result['previous']  = $this->previous[$result['sort_id']];
    }
}