<?php

require_once('models/ModelMember.php');
require_once('models/ModelUniversity.php');
require_once('views/Index.view.php');

use Models\ModelMember;
use Models\ModelUni;
use Views\indexView;

class IndexController{

    private ModelMember $memberModel;
    private ModelUni $uniModel;
    private IndexView $view;

    public function __construct(){
        $this->memberModel = new ModelMember();
        $this->uniModel = new ModelUni();
        $this->view = new indexView();
    }
    public function index(){
        $data['member'] = $this->memberModel->getAll();
        $this->memberModel->close();
        $data['uni'] = $this->uniModel->getAll();
        $this->uniModel->close();
        $this->view->render($data);
    }

}