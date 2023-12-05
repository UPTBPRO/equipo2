<?php
    include_once './core/user.php';
    include_once './core/user_session.php';
    include_once './core/Request.php';
    include_once './core/Route.php';
    include_once './core/utils.php';
    include_once './core/App.php';
    include_once './app/controller/MainController.php';
    include_once './routes/web.php';
    use Core\Route;
    $request = new Request();
    App::assets($request->getPublicUrl());
    $routes = Route::getRoutes();
    $url = $request->getUrl();
    $request->validate($routes,$url);