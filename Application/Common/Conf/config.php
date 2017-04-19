<?php
return array(
    //'配置项'=>'配置值'
    'URL_CASE_INSENSITIVE' => true,  //设置为true的时候表示URL地址不区分大小写
    'SHOW_PAGE_TRACE' => true,     //使得页面底部显示跟踪信息
    'MD5_PRE' => '_Raven', //加密前缀
    'MD5_POS' => '_Blog', //加密后缀

    //url访问模式为PathInfo模式
    'URL_MODEL' => '1',

    //测试时关闭缓存
    'TMPL_CACHE_ON' => false,//禁止模板编译缓存
    'HTML_CACHE_ON' => false,//禁止静态缓存

    //域名部署
    'APP_SUB_DOMAIN_DEPLOY' => 1,
    'APP_SUB_DOMAIN_RULES' => array(
//        'r.raven.com' => 'Admin',
        'raven.com' => 'Home',
//        'r.raven.pub' => 'Admin'
    ),

    //引用文件路径设置
    /*'TMPL_PARSE_STRING' => array(
        '__ASSETS__' => __ROOT__.'/Public/assets',
        '__IMAGE__' => __ROOT__ . '/Public/images',
        '__CSS__' => __ROOT__ . '/Public/css',
        '__JS__' => __ROOT__ . '/Public/js',
        '__UPLOAD__' => __ROOT__ . '/Public/upload',
    ),*/

    // 加载扩展配置文件 多个用,隔开
    'LOAD_EXT_CONFIG' => 'db',

    //Auth权限设置
//    'AUTH_CONFIG' => array(
//        'AUTH_ON' => true,  // 认证开关
//        'AUTH_TYPE' => 1, // 认证方式，1为实时认证；2为登录认证。
//        'AUTH_GROUP' => 'blog_auth_group', // 用户组数据表名
//        'AUTH_GROUP_ACCESS' => 'blog_auth_group_access', // 用户-用户组关系表
//        'AUTH_RULE' => 'blog_auth_rule', // 权限规则表
//        'AUTH_USER' => 'blog_user', // 用户信息表
//    ),

    //开启伪静态
//    'URL_HTML_SUFFIX' => '.html',
    //开启路由
//    'URL_ROUTER_ON' => true,
    //路由规则
//    'URL_ROUTE_RULES' => array(
//        'news/:id' => 'News/read',
//    ),
);