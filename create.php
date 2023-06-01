<?php

require_once('controllers/Create.controller.php');

$controller = new CreateController();
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST))){
    $controller->insert($_POST);
    header('location: index.php');
}

$controller->showForm();