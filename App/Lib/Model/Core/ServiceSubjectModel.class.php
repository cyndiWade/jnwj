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


}


?>