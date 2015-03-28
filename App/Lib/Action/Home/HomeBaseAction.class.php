<?php

/**
 * Home核心类
 */
class HomeBaseAction extends AppBaseAction {
	
	//构造方法
	public function __construct() {
		
		parent:: __construct();			//重写父类构造方法
		
		$this->init_rbac();		//RBAC权限控制类库
		
		//全局系统变量
		$this->global_system();
		
		//初始化用户数据
		$this->check_system_info();
	}
	

	/**
	 * 全局系统用到的数据
	 */
	private function global_system () {
	
		//初始化局模板变量
		parent::global_tpl_view(array(
				'user_info' => array(
					'nickname' => $this->oUser->nickname
				),
				'button' => array (
					'prve' => C('PREV_URL')
				),
				'prve_url' => C('PREV_URL'),
				
				'path'=>'http://'.$_SERVER['SERVER_NAME'].$path.''.'Public/'.GROUP_NAME.'/',
				
				'group_name' =>GROUP_NAME,
				
				'module_name'=>MODULE_NAME,
				
				'action_name'=>ACTION_NAME,
				
				//网站当前分组资源路径
				'Group_Resource_Path'=>C('LocalHost').'/'.APP_PATH.'Public/'.GROUP_NAME.'/',
				
				//模块级页面路径
				'Module_Resource_Path'=>C('LocalHost').'/'.APP_PATH.'Public/'.GROUP_NAME.'/Module/'.MODULE_NAME.'/',
				
		));
	}
	
	private function check_system_info() {
	
	   
	    if ($this->is_check_rbac == true && !in_array(ACTION_NAME,$this->not_check_fn)) {

	       $session_userinfo = parent::get_session('user_info');
	       if (!empty($session_userinfo)) {
	           $this->oUser = (object) $session_userinfo;					//转换成对象
	       }

	        $check_result = $this->init_check($this->oUser);
	        	
	        if ($check_result['status'] == false) parent::callback(C('STATUS_RBAC'),$check_result['message']);
	    }
	}
	
	
}


?>