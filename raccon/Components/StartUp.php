<?php
// Подключение файла с настройками
require_once ROOT . '/Config/Config.php';
date_default_timezone_set(APP_TIMEZONE);
ini_set('display_errors', APP_DEBUG ? '1' : '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
// Подключение класса загрузчика
require_once ROOT . '/Components/Loader.php';
// Вызов автозагрузки классов
$loader = new Loader;
$loader->autoLoad();
// Заполнение регистров
Registry::set('load',       $loader);
Registry::set('db',         (new Db()));
Registry::set('language',   (new Language(LANGUAGE_CODE)));
Registry::set('doom',       (new Doom));
Registry::set('image',      $loader->load('controllers_tools_imageTool'));

// Запуск сесии
Session::start();
// Запусе роутера
(new Router())->Run();
