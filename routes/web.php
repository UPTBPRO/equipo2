<?php
    use Core\Route;
    Route::get('/',"MainController@index");
    Route::get('/home',"MainController@home");
    Route::get('/login',"MainController@login");
    Route::get('/logout',"MainController@logout");
    Route::get('/api/{id}',function($route){
        return $route['id'];
    });
    Route::get('/persona/{id}',"MainController@show");
    Route::group('/producto',function(){
        Route::get('/id',function(){
           return view("index");
        });
        Route::get('/nombre/{name}',function($route){
            return view("producto.index",["name"=>$route['name']]);
         });
    });