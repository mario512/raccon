<?php

class ImageTool
{
    public $image;

    public function resize($fileName, $width = '', $height = '')
    {
        $quality            = IMAGE_QUALITY;
        $catalogImage       = ROOT . '/' . CATALOG_IMAGE . '/';
        $catalogCacheImage  = '/cache/image';

        // Проверяем наличие исходного файла
        if (!is_file($catalogImage . $fileName)) {
            if (is_file($catalogImage . 'no_image.webp')) {
                $fileName = 'no_image.webp';
            } elseif (is_file($catalogImage . 'no_image.jpg')) {
                $fileName = 'no_image.jpg';
            } elseif (is_file($catalogImage . 'no_image.png')) {
                $fileName = 'no_image.png';
            } else {
                return;
            }
        }

        $pathInfo = pathinfo($fileName);
        $patch = ($pathInfo['dirname'] != '.') ? $pathInfo['dirname'] . '/' : '';
        $name = StringFunctions::stripTags(StringFunctions::transLit($pathInfo['filename']));
        $extension = strtolower($pathInfo['extension']);

        $imageOriginal = $fileName;
        $imageNew = $patch . $name . '-' . (int) $width . 'x' . (int) $height . '.' . $extension;

        $cacheFullPath = ROOT . $catalogCacheImage . '/' . $imageNew;
        $sourceFullPath = $catalogImage . $imageOriginal;

        // Проверяем, нужно ли пересоздать кеш
        if (!is_file($cacheFullPath) || (filectime($sourceFullPath) > filectime($cacheFullPath))) {
            if ($extension !== 'svg') {

                // Загружаем информацию об изображении один раз
                $imageInfo = getimagesize($sourceFullPath);
                [$imgW, $imgH, $imgType] = $imageInfo;

                // Поддерживаем только корректные форматы
                if (!in_array($imgType, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP])) {
                    return $sourceFullPath;
                }

            } else {
                // SVG не ресайзим
                copy($sourceFullPath, $cacheFullPath);
                return Router::getUrlLink($catalogCacheImage . '/' . $imageNew);
            }

            // Создаем структуру каталогов
            $pathBuild = ROOT;
            foreach (explode('/', dirname($catalogCacheImage . '/' . $imageNew)) as $dir) {
                if (!empty($dir)) {
                    $pathBuild .= '/' . $dir;
                    if (!is_dir($pathBuild)) {
                        @mkdir($pathBuild, 0777, true);
                    }
                }
            }

            // Если размер другой — ресайзим
            if ($imgW != $width || $imgH != $height) {
                $resultImage = new Image($sourceFullPath);
                $resultImage->compression = $quality;
                $resultImage->resize($width, $height);
                $resultImage->save($cacheFullPath, 0755);
            } else {
                copy($sourceFullPath, $cacheFullPath);
            }
        }

        return Router::getUrlLink($catalogCacheImage . '/' . $imageNew);
    }

    public function uploadImg($file)
    {
        $allowedTypes = [
            'image/gif',
            'image/png',
            'image/jpeg',
            'image/webp'
        ];

        $maxSize = 1024000; // 1MB
        $uploadDir = ROOT . '/' . CATALOG_IMAGE . '/';

        if (in_array($_FILES['file']['type'], $allowedTypes) && $_FILES['file']['size'] < $maxSize) {
            $newImg = $uploadDir . basename($_FILES['file']['name']);
            if (@copy($_FILES['file']['tmp_name'], $newImg)) {
                chmod($newImg, 0755);
                return '/' . $_FILES['file']['name'];
            }
        }

        return false;
    }

    
}
