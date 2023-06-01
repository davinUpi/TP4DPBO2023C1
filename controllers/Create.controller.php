<?php

require_once('models/ModelMember.php');
require_once('models/ModelUniversity.php');
require_once('views/Create.view.php');

use Models\ModelMember;
use Models\ModelUni;
use Views\CreateView;

class CreateController{

    private ModelMember $memberModel;
    private ModelUni $uniModel;
    private createView $view;
    public function __construct(){
        $this->memberModel = new ModelMember();
        $this->uniModel = new ModelUni();
        $this->view = new CreateView();
    }

    public function insert($data){
        $this->memberModel->insert($data);
    }

    public function showForm(){
        $data = $this->uniModel->getAll();
        $this->view->render($data);
        $this->memberModel->close();
        $this->uniModel->close();
    }
}