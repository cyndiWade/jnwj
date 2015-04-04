<?php 

class ServiceSubjectModel extends AppBaseModel {


    public function getSubjectBySubjectId ($subject_id) {
        $subject_title_list = D('Core/SubjectTitle')->getSubjectTitleBySubjectId($subject_id);

        if (!empty($subject_title_list)) {
            
            $subject_title_ids =  getArrayByField($subject_title_list,'id');
            $subject_select_list = D('Core/SubjectSelect')->getSubjectSelectBySubjectTitleIds($subject_title_ids);
            $format_subject_select_list = regroupKey($subject_select_list,'subject_title_id',false);

            foreach ($subject_title_list as $key=>$val) {
                $subject_title_list[$key]['subject_select_list'] = $format_subject_select_list[$val['id']];
            }

        }

        return $subject_title_list;
    }
    
    
    public function getSubjectResultBySubjectId ($subject_id) {
        return D('Core/SubjectResult')->getSubjectResultBySubjectId($subject_id);
    }

    
    public function getNewTenSubject() {
        return D('Core/Subject')->getSubjectByNew(10);
    }
    
    
    public function getSubjectListHtmlByWhere  ($condition = array(),$fields = '*',$list_rows = 500,$order_by = '',$is_show_page_html =  true) {
    	return D('Core/Subject')->get_spe_page_data($condition,$fields,$list_rows,$order_by,$is_show_page_html);
    }
    
    
    public function getSubjectTitleListHtmlByWhere ($condition = array(),$fields = '*',$list_rows = 500,$order_by = '',$is_show_page_html =  true) {
    	return D('Core/SubjectTitle')->get_spe_page_data($condition,$fields,$list_rows,$order_by,$is_show_page_html);
    }
    
    public function getSubjectSelectListHtmlByWhere ($condition = array(),$fields = '*',$list_rows = 500,$order_by = '',$is_show_page_html =  true) {
    	return D('Core/SubjectSelect')->get_spe_page_data($condition,$fields,$list_rows,$order_by,$is_show_page_html);
    }
    
    public function getSubjectResultListHtmlByWhere ($condition = array(),$fields = '*',$list_rows = 500,$order_by = '',$is_show_page_html =  true) {
        return D('Core/SubjectResult')->get_spe_page_data($condition,$fields,$list_rows,$order_by,$is_show_page_html);
    }

}


?>