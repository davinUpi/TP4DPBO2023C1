<?php

require_once('models/ModelMember.php');

use Models\ModelMember;

class DeleteController{
    private ModelMember $memberModel;

    public function __construct(){
        $this->memberModel = new ModelMember();
    }

    public function delete($data){
        $id = intval($data['id']);
        $this->memberModel->delete($id);
    }
}