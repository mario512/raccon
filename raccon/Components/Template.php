<?php

class Template
{


    public static function get($templateName, $catalogName = '')
    {
        if ($catalogName == 'catalog' || empty($catalogName)) {
            $patch = ROOT . '/Views/Catalog/' . THEME;
        } else if ($catalogName == 'admin') {
            $patch = ROOT . '/Views/Admin/';
        }

        $segments = explode('_', $templateName);

        foreach ($segments as $segment) {
            $patch .= '/' . $segment;
        }

        $patch .= '.' . TEMPLATE_EXT;

        if (is_file($patch)) {
            return $patch;
        } else {
            return false;
        }
    }

    public static function view($templateName, $data = [], $catalogName = '')
    {
        $file = self::get($templateName, $catalogName);

        if (!$file || !is_file($file)) {
            trigger_error('Error: Not load file ' . $file . '!', E_USER_ERROR);
            exit('Template not found!');
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $file;
        $output = ob_get_clean();

        return $output;
    }
}
