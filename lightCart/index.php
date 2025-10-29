<?php
// Вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Настройка корневой директории сайта
define('ROOT', __DIR__);
// Подключение загрузчика классов
require_once ROOT . '/Components/StartUp.php';
// Для отладки (Не пускать в продакшн)
class p
{
    static public function a($param)
    {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }
    static public function e($param)
    {
        echo '<br>' . $param;
    }
    static public function es($param)
    {
        echo '<br>' . $param;
        exit('Точка остановы');
    }
}
