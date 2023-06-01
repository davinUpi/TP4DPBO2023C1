<?php

require_once('models/ModelUniversity.php');
require_once('views/university.view.php');

use Models\ModelUni;
use Views\UniversityView;

class UniversityController{
    private ModelUni $uniModel;
    private UniversityView $view;

    public function __construct(){
        $this->uniModel = new ModelUni();
        $this->view = new UniversityView();
    }
    public function index(){

        $data = $this->uniModel->getAll();
        $this->view->render($data);
        $this->uniModel->close();
    }
}
