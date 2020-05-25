<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';
require SRC . 'database.php';

$router = new App\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "HomeController@index");

$router->get('/register', "AuthController@showRegister");
$router->get('/login', "AuthController@showLogin");
$router->get('/logout', "AuthController@logout");

$router->get('/img/article/:id', "ImageController@imageArticle");

$router->get('/contact', "ContactController@index");

$router->get('/administration', "AdminController@index");

$router->get('/articles', "ArticleController@index");
$router->get('/article/create', "ArticleController@create");
$router->get('/article/search', "ArticleController@search");
$router->get('/article/:id', "ArticleController@show");



$router->post('/register', "AuthController@register");
$router->post('/login', "AuthController@login");

$router->post('/contact', "ContactController@store");

$router->post('/administration/user/create', "AuthController@createUser");
$router->post('/administration/user/edit/:id', "AuthController@updateUser");
$router->post('/administration/tag/create', "TagController@store");
$router->post('/administration/tag/edit/:id', "TagController@update");
$router->post('/administration/contact/edit/:id', "ContactController@update");

$router->post('/article/create', "ArticleController@store");
$router->post('/article/search', "ArticleController@searching");


$router->run();