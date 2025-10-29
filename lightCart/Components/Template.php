<?php

class Template
{

    public static function get($templateName, $catalogName = '')
    {
        if ($catalogName == 'catalog' || empty($catalogName)){
            $patch = ROOT . '/Views/Catalog/' . THEME;
        } else if ($catalogName == 'admin') {
            $patch = ROOT . '/Views/Admin/';
        }
        
        $segments = explode('_', $templateName);

        foreach ($segments as $segment) {
            $patch .= '/' . ucfirst($segment);
        }

        $patch .= '.php';
        
        if (is_file($patch)) {
            return $patch;
        } else {
            return false;
        }
    }

    public static function getPlugin($templateName)
    {

        $patch = ROOT . '/Plugins/Views';
        $segments = explode('_', $templateName);

        foreach ($segments as $segment) {
            $patch .= '/' . ucfirst($segment);
        }

        $patch .= '.php';

        if (is_file($patch)) {
            return $patch;
        } else {
            return false;
        }
    }

}
