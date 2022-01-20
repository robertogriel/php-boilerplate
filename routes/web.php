<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Http\Controllers\PageController;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/teste', function(){
    
    $page = new PageController();
    $page->render('index');

});
