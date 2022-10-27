<?php
require_once '../libs/Router.php';
require_once '../app/controllers/api.controller.php' ;
//instancia el Router
$router = new Router() ;

$router->addRoute('chapters' , 'GET' , 'ApiController' , 'getAllChapters') ;
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);