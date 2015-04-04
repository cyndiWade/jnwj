<?php
/**
 * 
 */
class SubjectSelectAction extends AdminBaseAction {
  	
	//控制器说明
	private $module_name = '编辑选择项';
	
	
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
      	
        $subject_title_id = $this->_get('subject_title_id');
        $subject_id = $this->_get('subject_id');
        
        $where = array();
        $where['subject_id'] = $subject_id;
        $where['subject_title_id'] = $subject_title_id;
        $where['is_del'] = 0;
        
        //分页
        $db_result = $this->service_subject->getSubjectSelectListHtmlByWhere($where,'*',500,'id DESC');
        
	    $result['list'] = $db_result['list'];
        $result['page_html'] = $db_result['page_html'];
        
	    parent::global_tpl_view( array(
	        'action_name'=>'数据列表',
	        'title_name'=>'数据列表',
	        'add_name'=>'添加数据'
	    ));
	     
	    parent::data_to_view($result);
	    parent::data_to_view(array(
            'subject_id'=>$subject_id,
            'subject_title_id'=>$subject_title_id
	    ));
	    $this->display();
	}
	
	
	public function edit () {
	    $result = array();
	   
	    $SubjectSelect = D('Core/SubjectSelect');
	    $act = $this->_get('act');
	    $id = $this->_get('id');
	    $subject_id = $this->_get('subject_id');
	    $subject_title_id = $this->_get('subject_title_id');
	    
	    if ($act == 'add') {
	        if ($this->isPost()) {
	            $SubjectSelect->create();
	            $SubjectSelect->subject_id = $subject_id;
	            $SubjectSelect->subject_title_id = $subject_title_id;
	            $SubjectSelect->add() ? $this->success('添加成功') : $this->error('添加失败请稍后再试！');
	            exit;
	        }
	    } else if ($act == 'update') {
	        if ($this->isPost()) {
	            $SubjectSelect->create();
	            $SubjectSelect->save_one_data(array('id'=>$id)) ? $this->success('修改成功') : $this->error('修改失败请稍后再试！');
	            exit;
	        } 
	        
	        $result = $SubjectSelect->get_one_data(array('id'=>$id));
	        
	    } else if ($act == 'delete') {
	       $SubjectSelect->delete_data(array('id'=>$id)) ? $this->success('删除成功') : $this->error('删除失败请稍后再试！');
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
