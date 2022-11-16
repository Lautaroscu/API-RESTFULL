<?php
require_once '../API-RESTFULL/libs/Router.php';
require_once '../API-RESTFULL/app/controllers/api.controller.php';
require_once '../API-RESTFULL/app/controllers/auth-api-controller.php';
require_once '../API-RESTFULL/app/controllers/comments.controller.php' ;
//instancia el Router
$router = new Router();

$router->addRoute('chapters', 'GET', 'ApiController', 'getAllQueryParams');
$router->addRoute('chapters/:ID', 'GET', 'ApiController', 'getChapter');
$router->addRoute('chapters/comments/:ID', 'GET', 'CommentsController', 'getComment');
$router->addRoute('seasons', 'GET', 'ApiController', 'filterChapters');
$router->addRoute('chapters/comments/:ID', 'DELETE', 'CommentsController', 'deleteComment');
$router->addRoute('comments', 'GET', 'CommentsController', 'getAllComments');
$router->addRoute('chapters/comments/:ID', 'PUT', 'CommentsController', 'updateComment');
$router->addRoute('chapters/comments/', 'POST', 'CommentsController', 'insertComment');


$router->addRoute('auth/token', 'GET', 'AuthApiController', 'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
