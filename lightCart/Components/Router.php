<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/Config/Routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            if (preg_match('!/{2,}!', $_SERVER['REQUEST_URI'])) {
                $url = preg_replace('!/{2,}!', '/', $_SERVER['REQUEST_URI']);
                header('Location: ' . $url, false, 301);
                exit;
            } else {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }
    }

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~^$uriPattern$~", $uri) || $uriPattern == "") {

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                
                // Определение каталога контроллера
                switch (preg_match("~admin~", $uri)) {
                    case 0:
                        $catalog = '/Controllers/Catalog/';
                        break;
                    case 1:
                        $catalog = '/Controllers/Admin/';
                        break;
                }

                $controllerFile = ROOT . $catalog . $controllerName . '.php';
                
                // Проверка файла и подключение файла
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                    if (class_exists($controllerName)) {
                        $controllerObject = new $controllerName;
                        if (method_exists($controllerObject, $actionName)) {
                            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                        } else {
                            $result = null;
                        }
                    }
                } else {
                    $result = null;
                }

                if ($result != null) {
                    break;
                } else {                  
                    Errors::err404();     
                    break;
                }
            }
        }
    }

    public static function getUrlLink($elementUrl = '', $elementId = '')
    {
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        if ($elementUrl == '' && $elementId == '') {
            $patch = $url . $_SERVER['REQUEST_URI'];
        } else if (is_array($elementUrl)) {
            $patch = $url . '/';
            foreach ($elementUrl as $value) {
                $patch .= $value . '/';
            }
        } else {
            $patch = $url .  $elementUrl  . $elementId;
        }
        return $patch;
    }

    public static function getUrlAsets($admin = false)
    {
        if ($admin) {
            $atchAssets = array(
                'Views',
                'Admin',
                'Assets'
            );
        } else {
            $atchAssets  = array(
                'Views',
                'Catalog',
                THEME,
                'Assets'
            );
        }
        return $atchAssets;
    }
}
