<?php

require_once('models/ModelMember.php');
require_once('models/ModelUniversity.php');
require_once('views/Edit.view.php');

use Models\ModelMember;
use Models\ModelUni;
use Views\EditView;

class EditController{
    private ModelMember $memberModel;
    private ModelUni $uniModel;
    private EditView $view;

    public function __construct(){
        $this->memberModel = new ModelMember();
        $this->uniModel = new ModelUni();
        $this->view = new EditView();
    }

    public function update($data){
        $this->memberModel->update(intval($data['id']), $data);
    }

    public function showForm($data){
        $id = $data['id'];
        $data['member'] = $this->memberModel->getById($id);
        $data['uni'] = $this->uniModel->getAll();
        $this->view->render($data);
        $this->memberModel->close();
        $this->uniModel->close();
    }
}