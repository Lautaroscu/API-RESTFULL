<?php
require_once '../API-RESTFULL/libs/Router.php';
require_once '../API-RESTFULL/app/controllers/api.controller.php';
//instancia el Router
$router = new Router() ;

$router->addRoute('chapters' , 'GET' , 'ApiController' , 'getAllChapters') ;
$router->addRoute('chapters/:ID' , 'GET' , 'ApiController' , 'getChapter') ;
$router->addRoute('season/:ID' , 'GET' , 'ApiController' , 'filterChapters') ;
$router->addRoute('chapters/:ID' , 'DELETE' , 'ApiController' , 'deleteChapter') ;
$router->addRoute('chapters' , 'POST' , 'ApiController' , 'insertChapter') ;
$router->addRoute('chapters/:ID' , 'PUT' , 'ApiController' , 'updateChapter') ;
$router->addRoute('chapters/order/:ORDER' , 'GET' , 'ApiController' , 'orderById') ;
$router->addRoute('order/:FIELD/:ORDERBY' , 'GET' , 'ApiController' , 'order') ;


$router->addRoute('pagination/:?' , 'GET' , 'ApiController' , 'page') ;


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);