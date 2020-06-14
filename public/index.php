<?php
// router: appelle des fonction différents des controller différentes en fonction de l'url
session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';
require SRC . 'database.php';

$router = new App\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "HomeController@index");
// exemple: si l'url est "/register" on va chercher la fonction "showRegister"
// pour afficher la page qui est dans le controller "AuthController"
$router->get('/register', "AuthController@showRegister");
$router->get('/login', "AuthController@showLogin");
$router->get('/logout', "AuthController@logout");


$router->get('/error/404', "HomeController@pageNotFound");

$router->get('/img/article/:id', "ImageController@imageArticle");

$router->get('/contact', "ContactController@index");

$router->get('/administration', "AdminController@index");

$router->get('/articles', "ArticleController@index");
$router->get('/article/create', "ArticleController@create");
$router->get('/article/searchTag/:tag', "ArticleController@searchByTag");
$router->get('/article/:id', "ArticleController@show");

$router->post('/article/:id/send', "CommentController@store");
$router->post('/article/:id/edit/:idComment', "CommentController@update");
$router->post('/article/:id/delete/:idComment', "CommentController@delete");



$router->post('/register', "AuthController@register");
$router->post('/login', "AuthController@login");

$router->post('/contact', "ContactController@store");

$router->post('/administration/article/edit/:id', "ArticleController@update");
$router->post('/administration/article/delete/:id', "ArticleController@delete");
$router->post('/administration/user/create', "AuthController@createUser");
$router->post('/administration/user/edit/:id', "AuthController@update");
$router->post('/administration/user/delete/:id', "AuthController@delete");
$router->post('/administration/tag/create', "TagController@store");
$router->post('/administration/tag/edit/:id', "TagController@update");
$router->post('/administration/tag/delete/:id', "TagController@delete");
$router->post('/administration/contact/edit/:id', "ContactController@update");
$router->post('/administration/contact/delete/:id', "ContactController@delete");

$router->post('/article/create', "ArticleController@store");
$router->post('/article/search', "ArticleController@searching");


$router->run();