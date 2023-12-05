<?php
class Request{
    private static $php_self="";
    private static $request_uri="";
    private static $script_filename="";
    private static $document_root="";
    function __construct()
    {
        self::$php_self = $_SERVER['PHP_SELF'];
        self::$request_uri = $_SERVER['REQUEST_URI'];
        self::$script_filename = $_SERVER['SCRIPT_FILENAME'];
        self::$document_root = $_SERVER['DOCUMENT_ROOT'];
    }
    public static function getUrl(){
        $path_origin = self::$script_filename;
        $path_main = self::$document_root.self::$php_self;
        $request_url = str_replace($path_origin,'',$path_main);
        return empty($request_url)?'/':$request_url;
   }
    public static function getPublicUrl(){
        $path_origin = self::$script_filename;
        $request_uri = self::$request_uri;
        $path_main = self::$document_root.self::$php_self;
        $request_url = str_replace($path_origin,'',$path_main);
        $public_path= str_replace($request_url,'',$request_uri);
        return $public_path;
    }
    
    public static function validate($routes,$url){
        foreach ($routes as $route) {
            $regex_route = preg_replace_callback(
                '/{([^}]+)}/',
                function ($matches) {
                    return "(?P<" . $matches[1] . ">[^/]+)";
                },
                $route['path']
            );
            $regex_route = str_replace("/", "\/", $regex_route);
            $regex_route = '/^' . $regex_route . '$/';
            if(preg_match($regex_route, $url,$matches)){
                $params = [];
                foreach ($matches as $key => $value) {
                    $params[$key]=$value;
                }
                unset($params[0]);
                if(is_string($route['class'])){
                    $route_class = $route['class'];
                    $array_class = explode('@', $route_class);
                    $controller = new $array_class[0]();
                    $method = $array_class[1];
                    // print_r($array_class);
                    $response = $controller->$method(...array_values($params));
                    if(is_array($response)){
                        $response = json_encode($response);
                        header('Content-Type: application/json');
                        echo $response; 
                        return false;
                    }else{
                        return $response;
                    }
                }
                if(is_callable($route['class'])){
                    $response = $route['class']($params);
                    if(is_array($response)){
                        $response = json_encode($response);
                        header('Content-Type: application/json');
                        echo $response; 
                        return false;
                    }else{
                        return $response;
                    }
                }
            }
        }
        return view('error.404');
    }

}