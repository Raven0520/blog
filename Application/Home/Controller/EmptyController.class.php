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
    public function __empty(){
        $this->display();
    }
}