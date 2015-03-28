<?php

class ForecastAction extends HomeBaseAction {
    
    protected  $is_check_rbac = false;		//当前控制是否开启身份验证
    
    protected  $not_check_fn = array();		//登陆后无需登录验证方法
    
    public function index () {
        
        $this->display();
    }
    public function xxx () {
        $this->display();
    }
    
    public function subject () {
        $subject_id = $this->_get('subject_id');
        $call_bak_url = '/xxx/XX';
        
        $CoreSubject = D('Core/Subject');
        $subject_info = $CoreSubject->getSubjectById($subject_id);
        
        if (empty($subject_info))  $this->redircet($call_bak_url);
        
        //$CoreSubjectTitle = D('Core/SubjectTitle');
        //$subject_title_list = $CoreSubjectTitle->getSubjectTitleBySubjectId($subject_id);

        $CoreServiceSubject = D('Core/ServiceSubject');
        $subject_list = $CoreServiceSubject->getSubjectBySubjectId($subject_id);
        $subject_list_count = count($subject_list);

        parent::data_to_view(array(
            'subject_info' => $subject_info,
            'subject_list' => $subject_list,
            'subject_list_count' => $subject_list_count,
        ));
        
        $this->display();
    }
}