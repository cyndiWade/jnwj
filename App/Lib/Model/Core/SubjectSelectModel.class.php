<?php

class SubjectSelectModel extends AppBaseModel {
    
    
    public function getSubjectSelectBySubjectTitleIds ($subject_title_ids) {
        return $this->get_spe_data(array('subject_title_id'=>array('IN',$subject_title_ids),'is_del'=>0));
    }
}

?>
