<?php

class ImageTool
{

    public $image;

    public function resize($fileName, $width = '', $height = '')
    {
        $quality            = IMAGE_QUALITY;
        $catalogImage       = ROOT . '/' . CATALOG_IMAGE . '/';
        $catalogCacheImage  = '/cache/image';

        if (!is_file($catalogImage . $fileName)) {
            if (is_file($catalogImage . 'no_image.jpg')) {
                $fileName = 'no_image.jpg';
            } elseif (is_file($catalogImage . 'no_image.png')) {
                $fileName = 'no_image.png';
            } else {
                return;
            }
        }

        $patch      = (pathinfo($fileName, PATHINFO_DIRNAME) != '.') ? pathinfo($fileName, PATHINFO_DIRNAME) . '/' : '';
        $name       =  pathinfo($fileName, PATHINFO_FILENAME);
        $extension  =  pathinfo($fileName, PATHINFO_EXTENSION);

        $imageOriginal = $fileName;

        $imageNew = $patch
            . StringFunctions::stripTags(StringFunctions::transLit($name))
            . '-' . (int) $width . 'x' . (int) $height . '.' . $extension;

        if (!is_file(ROOT . $catalogCacheImage . '/' . $imageNew) || (filectime($catalogImage . $imageOriginal) > filectime(ROOT . $catalogCacheImage . '/' . $imageNew))) {
            if ($extension !== 'svg') {
                $imgW       = getimagesize($catalogImage . $imageOriginal)['0'];
                $imaH       = getimagesize($catalogImage . $imageOriginal)['1'];
                $imgType    = getimagesize($catalogImage . $imageOriginal)['2'];

                switch ($imgType) {
                    case IMAGETYPE_PNG;
                        break;
                    case IMAGETYPE_JPEG;
                        break;
                    case IMAGETYPE_GIF;
                        break;
                    default:
                        return $catalogImage . $imageOriginal;
                }
            } else {
                $imgW = '';
                $imaH = '';
                $imgType = '';
            }

            $patchImg           = ROOT;
            $sigmentsPatchImg   = explode('/', dirname($catalogCacheImage . '/' . $imageNew));

            foreach ($sigmentsPatchImg as $dir) {
                if (!empty($dir)) {
                    $patchImg = $patchImg . '/' . $dir;
                    if (!is_dir($patchImg)) {
                        @mkdir($patchImg, 0777);
                    }
                }
            }

            if ($imgW != $width || $imaH != $height) {
                $resultImage = new Image($catalogImage . $imageOriginal);
                $resultImage->compression = $quality;
                $resultImage->resize($width, $height);
                $resultImage->save(ROOT . $catalogCacheImage . '/' . $imageNew, 0755);
            } else {
                copy($catalogImage . $imageOriginal, ROOT . $catalogCacheImage . '/' . $imageNew);
            }
        }
        return Router::getUrlLink($catalogCacheImage . '/' . $imageNew);
    }

    public function uploadImg($file)
    {
        $typeImg = array(
            'image/gif',
            'image/png',
            'image/jpeg'
        );

        $sizeImg = '1024000';
        $patchImg = ROOT . '/' . CATALOG_IMAGE . '/bank/';
        if (in_array($_FILES['file']['type'], $typeImg) && $_FILES['file']['size'] < $sizeImg) {
            $newImg = $patchImg . $_FILES['file']['name'];
            if (@copy($_FILES['file']['tmp_name'], $newImg)) {
                chmod($newImg, 0755);
                return '/bank/' . $_FILES['file']['name'];
            } else {
                return false;
            }
        }
    }
}
