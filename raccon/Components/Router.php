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
        // Получаем строку запроса
        $uri = $this->getURI();
        $matched = false;

        foreach ($this->routes as $uriPattern => $path) {

            // Проверка соответствия URI шаблону
            if ($uriPattern === '' && $uri === '') {
                $internalRoute = $path;
            } elseif (preg_match("~^$uriPattern$~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
            } else {
                continue;
            }

            $matched = true;

            // Разбиваем внутренний путь
            $segments = explode('/', trim($internalRoute, '/'));

            $controllerName = ucfirst(array_shift($segments)) . 'Controller';
            $actionName     = 'action' . ucfirst(array_shift($segments) ?? 'index');
            $parameters     = $segments;

            // Определяем каталог контроллера (admin или catalog)
            if (strpos($uri, 'admin') === 0) {
                $catalog = '/Controllers/Admin/';
            } else {
                $catalog = '/Controllers/Catalog/';
            }

            $controllerFile = ROOT . $catalog . $controllerName . '.php';

            // Проверка существования файла
            if (is_file($controllerFile)) {
                include_once $controllerFile;

                if (class_exists($controllerName)) {
                    $controllerObject = new $controllerName;

                    if (method_exists($controllerObject, $actionName)) {
                        // Запускаем экшен с параметрами
                        call_user_func_array([$controllerObject, $actionName], $parameters);
                        return; // Всё успешно, прекращаем роутинг
                    }
                }
            }

            // Если файл, класс или метод не найдены — ошибка 404
            Errors::handle404();
            return;
        }

        // Если вообще ничего не совпало
        if (!$matched) {
            Errors::handle404();
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
            $patchAssets = [
                'Views',
                'Admin',
                'Assets'
            ];
        } else {
            $patchAssets  = [
                'Theme',
                THEME
            ];
        }
        return self::getUrlLink($patchAssets);
    }
}
