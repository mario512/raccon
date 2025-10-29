<?php
date_default_timezone_set('Europe/Helsinki');
// Подключение файла с настройками
require_once ROOT . '/Config/Config.php';
// Подключение класса загрузчика
require_once ROOT . '/Components/Loader.php';
// Вызов автозагрузки классов
$loader = new Loader;
$loader->autoLoad();
// Заполнение регистров
Registry::set('load',       $loader);
Registry::set('db',         (new Db()));
Registry::set('language',   (new Language(LANGUAGE_CODE)));
//Registry::set('config',     $loader->load('controllers_tools_configController')->getSettingsAll());
Registry::set('image',      $loader->load('controllers_tools_imageTool'));

// Запуск сесии
Session::start();
// Запусе роутера
(new Router())->Run();
