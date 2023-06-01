<?php

require_once('controllers/Edit.controller.php');

$controller = new EditController();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $controller->showForm($_GET);
}
else{
    if(isset($_POST)){
        $controller->update($_POST);
        header('location: index.php');
    }
}
header('location index.php');