<?php
/**
 * 
 */
class SubjectTitleAction extends AdminBaseAction {
  	
	//控制器说明
	private $module_name = '选择题管理';
	
	
	private $service_subject;
	
	/**
	 * 构造方法
	 */
	public function __construct() {
	
	   parent::__construct();
	
	   $this->_initData();
	}
	
	
	
	private function _initData () {
	    
	    parent::global_tpl_view(array('module_name'=>$this->module_name));
	    
	    
	    $this->service_subject = D('Core/ServiceSubject');
	    
	}
	
    public function index () {
        $result = array();
      	
        $subject_id = $this->_get('subject_id');
        
        $where = array();
        $where['subject_id'] = $subject_id;
        $where['is_del'] = 0;
        
        //分页
        $db_result = $this->service_subject->getSubjectTitleListHtmlByWhere($where,'*',500,'id DESC');
        
	    $result['list'] = $db_result['list'];
        $result['page_html'] = $db_result['page_html'];
        
	    parent::global_tpl_view( array(
	        'action_name'=>'数据列表',
	        'title_name'=>'数据列表',
	        'add_name'=>'添加数据'
	    ));
	     
	    parent::data_to_view($result);
	    parent::data_to_view(array('subject_id'=>$subject_id));
	    $this->display();
	}
	
	
	public function edit () {
	    $result = array();
	   
	    $SubjectTitle = D('Core/SubjectTitle');
	    $act = $this->_get('act');
	    $id = $this->_get('id');
	    $subject_id = $this->_get('subject_id');
	    
	    if ($act == 'add') {
	        if ($this->isPost()) {
	            $SubjectTitle->create();
	            $SubjectTitle->subject_id = $subject_id;
	            $SubjectTitle->add() ? $this->success('添加成功') : $this->error('添加失败请稍后再试！');
	            exit;
	        }
	    } else if ($act == 'update') {
	        if ($this->isPost()) {
	            $SubjectTitle->create();
	            $SubjectTitle->save_one_data(array('id'=>$id)) ? $this->success('修改成功') : $this->error('修改失败请稍后再试！');
	            exit;
	        } 
	        
	        $result = $SubjectTitle->get_one_data(array('id'=>$id));
	        
	    } else if ($act == 'delete') {
	       $SubjectTitle->delete_data(array('id'=>$id)) ? $this->success('删除成功') : $this->error('删除失败请稍后再试！');
	        exit;
	    } 
	    
	    
	    parent::global_tpl_view( array(
	        'action_name'=>'编辑',
	        'title_name'=>'编辑',
	        'add_name'=>'编辑'
	    ));
	    
	    parent::data_to_view($result);
	    $this->display();
	}
	
	
	

}
