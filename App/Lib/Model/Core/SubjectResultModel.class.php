<?php

class SubjectResultModel extends AppBaseModel {
    
    public function getSubjectResultBySubjectId (subject_id) {
        return $this->get_spe_data(array('subject_id'=>subject_id,'is_del'=>0));
    }
}

?>
