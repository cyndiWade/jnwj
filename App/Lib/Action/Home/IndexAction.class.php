<?php

class IndexAction extends HomeBaseAction {
    
    protected  $is_check_rbac = false;		//当前控制是否开启身份验证
    
    protected  $not_check_fn = array();		//登陆后无需登录验证方法
    
    public function index () {

    }
}