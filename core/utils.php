<?php
    function assets($path = ""){
        $url =  App::getPath()."/resources/assets/{$path}";
        $url = preg_replace('#/+#','/', $url);
        return $url;
    }
    function url($path = ""){
        $url = App::getPath().$path;
        $url = preg_replace('#/+#','/', $url);
        return $url;
    }
    function view($path = "",$data=[]){
        $url = "./resources/views/";
        $path = str_replace(".","/",$path);
        foreach($data as $key =>$value){
            $$key = $value;
        }
        return require_once $url.$path.".php";
    }