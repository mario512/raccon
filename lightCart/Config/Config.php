<?php
// НАСТРОЙКИ ШАБЛОНА
define('THEME',                         'theme-def');            // Название темы
define('PAGE_404',                      '/Site/404.php');        // Страница 404 относительно каталога темы

define('LOGO',                          'logo.svg');            // Лого сайта относительно каталога image
define('FAVICON',                       'favicon.svg');         // Иконка сайта относительно каталога image
define('LANGUAGE_CODE',                 'ru');                  // Код основного языка шаблона сайта. например 'ru' или 'uk'
define('TELEGRAM',                      'https://t.me/myxa_cc');// Ссылка на телеграм канал сайта
define('EMAIL',                         'cc@Myxa.cc');          // Email сайта
define('IMAGE_QUALITY',                 '100');                 // Качество изображения 
define('LOGO_HEADER_SIZE',              '100x60');              // Размер логотипа в шапке сайта
define('USER_PHONE_MASK',               '+7');

// ПАРАМЕТРЫ ПОДКЛЮЧЕНИЯ DB //
define('HOST',            'localhost');                     // Адресс сервера
define('DB_NAME',         'my_mag');                        // Имя базы данных
define('USER',            'my_mag');                        // Пользователь
define('PASSWORD',        'my_mag');                          // Пароль

// СИСТЕМНЫЕ НАСТРОЙКИ
define('CATALOG_IMAGE',          'image');
// ФИНАНСОВЫЕ НАСТРОЙКИ
define('MIN_MAX_SUMM',       '19-1000'); // Минимальная и максимальная сумма транзакции в USD
define('FEE_EXCHANGE',         '0.50'); // Комиссия за операцию. Указанна в USD