<?php

class Image
{
    private  $imageOrig;
    public   $compression;
    private  $imageType;
    private  $image;

    public function __construct(string $imageFile)
    {

        if (is_file($imageFile)) {

            $this->imageOrig = $imageFile;

            switch (getimagesize($imageFile)[2]) {
                case IMAGETYPE_PNG;
                    $this->image = imagecreatefrompng($imageFile);
                    $this->imageType = IMAGETYPE_PNG;
                    break;
                case IMAGETYPE_JPEG;
                    $this->image = imagecreatefromjpeg($imageFile);
                    $this->imageType = IMAGETYPE_JPEG;
                    break;
                case IMAGETYPE_GIF;
                    $this->image = imagecreatefromgif($imageFile);
                    $this->imageType = IMAGETYPE_GIF;
                    break;
            }
        } else {
            throw new Exception('Error: Not load image ' . $imageFile . '!');
        }
    }

    public function output($imageType = IMAGETYPE_JPEG)
    {
        if ($imageType == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($imageType == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($imageType == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }


    public function getWidthHeight()
    {
        return getimagesize($this->imageOrig);
    }


    public function resize($width, $height, $direction = '')
    {
        if (!$width || !$height || $this->getWidthHeight()[0] < $width || $this->getWidthHeight()[1] < $height) {
            return;
        }

        $scale          = 1;
        $scaleWidth     = $width / $this->getWidthHeight()[0];
        $scaleHeight    = $height / $this->getWidthHeight()[1];

        switch ($direction) {
            case "width";
                $scale = $scaleWidth;
                break;
            case "height";
                $scale = $scaleHeight;
                break;
            default:
                $scale = min($scaleWidth, $scaleHeight);
        }

        if ($scale == 1 && $scaleHeight == $scaleWidth && ($this->imageType != 'IMAGETYPE_PNG')) {
            return;
        }

        $newWidth   = (int) ($this->getWidthHeight()[0] * $scale);
        $newHeight  = (int) ($this->getWidthHeight()[1] * $scale);


        $xPosition = (int) (($width - $newWidth) / 2);
        $yPosition = (int) (($height - $newHeight) / 2);

        $imageOld = $this->image;
        $this->image = imagecreatetruecolor($width, $height);

        if ($this->imageType == IMAGETYPE_PNG) {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
            imagecolortransparent($this->image, $background);
        } else {
            $background = imagecolorallocate($this->image, 255, 255, 255);
        }

        imagefilledrectangle($this->image, 0, 0, $width, $height, $background);
        imagecopyresampled($this->image, $imageOld, $xPosition, $yPosition, 0, 0, $newWidth, $newHeight, $this->getWidthHeight()[0], $this->getWidthHeight()[1]);
        imagedestroy($imageOld);

        return $this->image;
    }

    public function load($fileName)
    {
        $image_info = getimagesize($fileName);
        $this->imageType = $image_info[2];
        if ($this->imageType == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($fileName);
        } elseif ($this->imageType == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($fileName);
        } elseif ($this->imageType == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($fileName);
        }
    }

    public function save($fileName, $permissions = null)
    {

        switch ($this->imageType) {
            case IMAGETYPE_JPEG;
                imagejpeg($this->image, $fileName, $this->compression);
                break;
            case IMAGETYPE_GIF;
                imagegif($this->image, $fileName);
                break;
            case IMAGETYPE_PNG;
                imagepng($this->image, $fileName);
                break;
        }

        if ($permissions != null) {
            chmod($fileName, $permissions);
        }
    }

    
}
