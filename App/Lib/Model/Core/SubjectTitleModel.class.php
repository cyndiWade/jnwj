<?php

class SubjectTitleModel extends AppBaseModel {
    
    
    public function getSubjectTitleBySubjectId ($subject_id) {
        $subject_title_list = $this->get_spe_data(array('subject_id'=>$subject_id,'is_del'=>0));

        return $subject_title_list;
    }
    
    
}

?>
