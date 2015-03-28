<?php

/**
 * 微信Api
 */
class WeixinAction extends ApiBaseAction {
	
	protected  $is_check_rbac = false;		//当前控制是否开启身份验证
	
	protected  $not_check_fn = array('upload','show_img');	//登陆后无需登录验证方法
	
	//和构造方法
	public function __construct() {
		parent::__construct();
	
	}
	
	public function getNewTenSubject() {
	    $data = D('Core/ServiceSubject')->getNewTenSubject();
	    
	    if (!empty($data)) {
	        parent::callback(C('STATUS_SUCCESS'),'获取成功',$data);
	    } else {
	        parent::callback(C('STATUS_NOT_DATA'),'没有数据',$data);
	    }
	    
	}
	
	
	public function getSubject ($subject_id) {
	    $CoreSubject = D('Core/Subject');
	    $subject_info = $CoreSubject->getSubjectById($subject_id);
	    
	    if (!empty($subject_info)) {
	        parent::callback(C('STATUS_SUCCESS'),'获取成功',$subject_info);
	    } else {
	        parent::callback(C('STATUS_NOT_DATA'),'没有数据',$subject_info);
	    }
	}
	
	
    public function getSubjectResultBySubjectId ($subject_id) {
        $data = D('Core/ServiceSubject')->getSubjectResultBySubjectId($subject_id);
        
        if (!empty($data)) {
            parent::callback(C('STATUS_SUCCESS'),'获取成功',$data);
        } else {
            parent::callback(C('STATUS_NOT_DATA'),'没有数据',$data);
        }

    }
    
    
}

?>