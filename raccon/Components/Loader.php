<?php

class Loader
{
    public function autoLoad(): bool
    {
        spl_autoload_register(function ($className) {
            // Prevent path traversal through class names.
            if (preg_match('/\.\./', $className)) {
                return;
            }

            $paths = ['/Models/', '/Components/'];

            foreach ($paths as $path) {
                $file = ROOT . $path . $className . '.php';
                if (is_file($file)) {
                    require_once $file;
                    return;
                }
            }
        });

        return true;
    }

    public function load(string $component = '', $data = null)
    {
        $segments   = explode('_', $component);
        $pathFile   = ROOT;
        $objectName = ucfirst(end($segments));

        foreach ($segments as $segment) {
            $pathFile .= '/' . ucfirst($segment);
        }
        $pathFile .= '.php';

        if (is_file($pathFile)) {
            require_once $pathFile;
            if (class_exists($objectName, false)) {
                return new $objectName($data);
            }
        }

        return null;
    }

    public static function getData(string $dataPath, bool $returnData = false)
    {
        $segments  = explode('_', $dataPath);
        $pathFile  = ROOT;

        foreach ($segments as $segment) {
            $pathFile .= '/' . ucfirst($segment);
        }
        $pathFile .= '.php';

        if (!is_file($pathFile)) {
            return null;
        }

        return $returnData ? require $pathFile : $pathFile;
    }
}
