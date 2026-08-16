<?php
function load_env_file(string $path): void
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        if ($key !== '' && getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
        }
    }
}

function env_value(string $key, string $default = ''): string
{
    $value = getenv($key);
    return $value === false ? $default : $value;
}

load_env_file(ROOT . '/.env');

// Template settings
define('APP_DEBUG',                     filter_var(env_value('APP_DEBUG', '0'), FILTER_VALIDATE_BOOLEAN));
define('APP_TIMEZONE',                  env_value('APP_TIMEZONE', 'UTC'));
define('THEME',                         env_value('APP_THEME', 'Default'));
define('TEMPLATE_EXT',                  env_value('APP_TEMPLATE_EXT', 'html'));
define('PAGE_404',                      '/Site/404.php');

define('LOGO',                          env_value('APP_LOGO', 'raccoon_logo.png'));
define('FAVICON',                       env_value('APP_FAVICON', 'favicon.ico'));
define('LANGUAGE_CODE',                 env_value('APP_LANGUAGE', 'en'));
define('TELEGRAM',                      env_value('APP_TELEGRAM', ''));
define('EMAIL',                         env_value('APP_EMAIL', ''));
define('IMAGE_QUALITY',                 env_value('APP_IMAGE_QUALITY', '90'));
define('LOGO_HEADER_SIZE',              env_value('APP_LOGO_HEADER_SIZE', '60x60'));
define('USER_PHONE_MASK',               env_value('APP_USER_PHONE_MASK', '+1'));

// Database connection
define('HOST',                          env_value('DB_HOST', 'localhost'));
define('DB_NAME',                       env_value('DB_DATABASE', 'raccon'));
define('USER',                          env_value('DB_USERNAME', 'raccon'));
define('PASSWORD',                      env_value('DB_PASSWORD', ''));

// System settings
define('CATALOG_IMAGE',                 env_value('APP_IMAGE_DIR', 'image'));
