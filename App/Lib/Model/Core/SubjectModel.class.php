<?php

class SubjectModel extends AppBaseModel {
    
    
    public function getSubjectById ($id) {
        return $this->get_one_data(array('id'=>$id,'is_del'=>0));
    }
}

?>
