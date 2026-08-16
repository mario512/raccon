<?php
class Errors extends Controller
{
    public static function handle404()
    {
        $controllerFile = ROOT . '/Controllers/Catalog/ErrorsController.php';

        if (is_file($controllerFile)) {
            require_once $controllerFile;
            if (class_exists('ErrorsController')) {
                (new ErrorsController([]))->action404();
                return;
            }
        }

        // если кастомного нет — вызвать дефолтный шаблон
        self::default404();
    }

    private static function default404()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        $theme404 = ROOT . '/Views/Catalog/' . THEME . '/common/404.' . TEMPLATE_EXT;

        if (is_file($theme404)) {
            require_once $theme404;
        } else {
            // простая заглушка
            $html =<<<HTML
                <section class="error-page text-center" style="padding:80px 20px; font-family: 'Open Sans', sans-serif;">
                    <div class="container">    
                        <h1 style="font-size:120px; font-weight:800; color:#dc3545; margin-bottom:10px;">404</h1>
                        <h2 style="font-size:32px; font-weight:600; margin-bottom:15px;">
                            🦝 Page not found
                        </h2>
                        <p style="color:#666; font-size:18px; margin-bottom:30px;">
                            Sorry, the page you are looking for does not exist or has been moved.
                        </p>
                        <a href="/" class="btn btn-primary" style="display:inline-block; padding:10px 25px; font-size:16px; border-radius:4px; background-color:#007bff; color:#fff; text-decoration:none;">
                            Back to Home
                        </a>
                    </div>
                </section>
HTML;
            echo $html;
        }
    }
}
