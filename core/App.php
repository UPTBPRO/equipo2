<?php 
class App {
    private static $path="";
   
    public static function assets($path) {

        self::$path= $path;
    }
   
    public static function getPath() {

        return self::$path;
    }
   
}