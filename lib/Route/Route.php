<?php
namespace Lib\Route;

/**
 * @method static Route get(string $route, Callable $callback)
 * @method static Route post(string $route, Callable $callback)
 * @method static Route any(string $route, Callable $callback)
 */
class Route{
    public static $routes = array();
    public static $methods = array();
    public static $callbacks = array();
    public static $patterns = array(
        '{id}' => '[0-9]+'
    );

    public static function __callStatic($method, $params)
    {
        $url = dirname($_SERVER['PHP_SELF']).'/'.$params[0];
        $callback = $params[1];

        array_push(self::$routes, $url);
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }

    public static function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $searches = array_keys(static::$patterns);
        $replaces = array_values(static::$patterns);

        self::$routes = preg_replace('/\/+/', '/', self::$routes);
        $found_route = false;

        if(in_array($url, self::$routes)){
            $route_index = array_keys(self::$routes, $url);
            foreach($route_index as $route){
                if(self::$methods[$route] == $method || self::$methods[$route] == 'ANY'){
                    $found_route = true;

                    /* if route is not a object */
                    if(!is_object(self::$callbacks[$route])){
                        $parts = explode('/', self::$callbacks[$route]);
                        $last = end($parts);
                        $segments = explode('@', $last);

                        /* Instanitate controller */
                        if(class_exists($segments[0])){
                            $controller = new $segments[0]();

                            /* Call method */
                            if(method_exists($controller, $segments[1])){
                                $controller->{$segments[1]}();
                            }else{
                                $found_route = false;
                            }
                        }else{
                            $found_route = false;
                        }
                    }else{
                        call_user_func(self::$callbacks[$route]);
                    }
                }
            }
        }else{
            foreach(self::$routes as $key=>$route){
                if(strpos($route, '{id}') !== false){
                    $route = str_replace($searches, $replaces, $route);
                }

                if(preg_match('#^' . $route . '$#', $url, $matched)){
                    $matched_array = explode('/', $matched[0]);
                    $matched_params = array(end($matched_array));
                    if(self::$methods[$key] == $method || self::$methods[$key] == 'ANY'){
                        $found_route = true;

                        /* if route is not a object */
                        if(!is_object(self::$callbacks[$key])){
                            $parts = explode('/', self::$callbacks[$key]);
                            $last = end($parts);
                            $segments = explode('@', $last);

                            /* Instanitate controller */
                            if(class_exists($segments[0])){
                                $controller = new $segments[0]();

                                /* Call method */
                                if(method_exists($controller, $segments[1])){
                                    call_user_func_array(array($controller, $segments[1]), $matched_params);
                                }else{
                                    $found_route = false;
                                }
                            }else{
                                $found_route = false;
                            }
                        }else{
                            call_user_func_array(self::$callbacks[$key], $matched_params);
                        }
                    }
                }
            }
        }

        if($found_route == false){
            header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
            echo '404 Not Found';
        }
    }
}