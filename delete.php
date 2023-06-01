<?php

require_once('controllers/Delete.controller.php');

$controller = new DeleteController;
if(($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET))){
    $controller->delete($_GET);
}
header('location: index.php');