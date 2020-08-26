<?php
class Route {
    public static function get($path, $controller, $method) : bool {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && self::checkPath($path)) {
            if (file_exists(CONTROLLER.$controller.".php")) {
                $controller = new $controller;
                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], self::getParams($path));
                    return true;
                }
            }
        }
        return false;
    }

    public static function post($path, $controller, $method) : bool {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && self::checkPath($path)) {
            if (file_exists(CONTROLLER.$controller.".php")) {
                $controller = new $controller;
                if(method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], self::getParams($path));
                    return true;
                }
            }
        }
        return false;
    }

    public static function put($path, $controller, $method) : bool {
       if (isset($_POST['_method'])) {
           if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT' && self::checkPath($path)) {
                if (file_exists(CONTROLLER.$controller.".php")) {
                    $controller = new $controller;
                    if (method_exists($controller, $method)) {
                        call_user_func_array([$controller, $method], self::getParams($path));
                        return true;
                    }
                }
           }
       }
       return false;
    }

    public static function delete($path, $controller, $method) : bool {
        if (isset($_POST['_method'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE' && self::checkPath($path)) {
                if (file_exists(CONTROLLER.$controller.".php")) {
                    $controller = new $controller;
                    if (method_exists($controller, $method)) {
                        call_user_func_array([$controller, $method], self::getParams($path));
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private static function getParams($path) {
        $request = trim($_SERVER['REQUEST_URI'], '/');
        $path = trim($path, '/');
        if (($index = self::hasWildCard($path)) !== false) {
            $requestArr = explode('/', $request);
            if (array_key_exists($index, $requestArr)) {
                return [$requestArr[$index]];
            }
        }
        return [];
    }

    private static function checkPath($path) {
        $request = trim($_SERVER['REQUEST_URI'], '/');
        $requestArr = explode('/', $request);
        $path = trim($path, '/');
        $pathArr = explode("/", $path);
        if (($index = self::hasWildCard($path)) !== false && array_key_exists($index, $requestArr)) {
            array_splice($requestArr, $index, 1);
            array_splice($pathArr, $index, 1);
            $request = implode('/',$requestArr);

            $path = implode('/',$pathArr);
            if (isset($_SESSION['username']) && in_array('auth', $requestArr)) {
                header('location: /');
                return false;
            } elseif ($path !== $request) {
                return false;
            }
            return true;
        }

        elseif ($path === $request) {
            if (isset($_SESSION['username']) && in_array('auth', $requestArr)) {
                header('location: /');
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    private static function hasWildCard($path) {
        $pathArr = explode('/', $path);
        $wildCard = end($pathArr);
        if(strpos($wildCard, '{') !== false && strpos($wildCard, '}') !== false) {
            return array_key_last($pathArr);
        }
        return false;
    }
}