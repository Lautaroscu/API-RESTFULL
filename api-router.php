<?php
require_once '../API-RESTFULL/libs/Router.php';
require_once '../API-RESTFULL/app/controllers/api.controller.php';
require_once '../API-RESTFULL/app/controllers/auth-api-controller.php';
//instancia el Router
$router = new Router();

$router->addRoute('chapters', 'GET', 'ApiController', 'getAllQueryParams');
$router->addRoute('chapters/:ID', 'GET', 'ApiController', 'getChapter');
$router->addRoute('seasons', 'GET', 'ApiController', 'filterChapters');
$router->addRoute('chapters/:ID', 'DELETE', 'ApiController', 'deleteChapter');
$router->addRoute('chapters', 'POST', 'ApiController', 'insertChapter');
$router->addRoute('chapters/:ID', 'PUT', 'ApiController', 'updateChapter');

$router->addRoute('auth/token', 'GET', 'AuthApiController', 'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
