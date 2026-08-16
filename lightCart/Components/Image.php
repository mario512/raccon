<?php

class Image
{
    private  $imageOrig;
    public   $compression = IMAGE_QUALITY; // для webp и jpeg
    private  $imageType;
    private  $image;

    public function __construct(string $imageFile)
    {
        if (is_file($imageFile)) {

            $this->imageOrig = $imageFile;

            $info = getimagesize($imageFile);
            $this->imageType = $info[2];

            switch ($this->imageType) {
                case IMAGETYPE_PNG:
                    $this->image = imagecreatefrompng($imageFile);
                    break;

                case IMAGETYPE_JPEG:
                    $this->image = imagecreatefromjpeg($imageFile);
                    break;

                case IMAGETYPE_GIF:
                    $this->image = imagecreatefromgif($imageFile);
                    break;

                case IMAGETYPE_WEBP:
                    if (function_exists('imagecreatefromwebp')) {
                        $this->image = imagecreatefromwebp($imageFile);
                    } else {
                        throw new Exception('Error: WebP not supported by your PHP GD library');
                    }
                    break;

                default:
                    throw new Exception('Error: Unsupported image type ' . $imageFile);
            }
        } else {
            throw new Exception('Error: Not load image ' . $imageFile . '!');
        }
    }

    public function output($imageType = IMAGETYPE_JPEG)
    {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, null, $this->compression);
                break;

            case IMAGETYPE_GIF:
                imagegif($this->image);
                break;

            case IMAGETYPE_PNG:
                imagepng($this->image);
                break;

            case IMAGETYPE_WEBP:
                if (function_exists('imagewebp')) {
                    imagewebp($this->image, null, $this->compression);
                } else {
                    throw new Exception('Error: WebP not supported by your PHP GD library');
                }
                break;
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
        $scaleWidth     = $width  / $this->getWidthHeight()[0];
        $scaleHeight    = $height / $this->getWidthHeight()[1];

        switch ($direction) {
            case "width":
                $scale = $scaleWidth;
                break;
            case "height":
                $scale = $scaleHeight;
                break;
            default:
                $scale = min($scaleWidth, $scaleHeight);
        }

        if ($scale == 1 && $scaleHeight == $scaleWidth && ($this->imageType != IMAGETYPE_PNG)) {
            return;
        }

        $newWidth   = (int) ($this->getWidthHeight()[0] * $scale);
        $newHeight  = (int) ($this->getWidthHeight()[1] * $scale);

        $xPosition = (int) (($width - $newWidth) / 2);
        $yPosition = (int) (($height - $newHeight) / 2);

        $imageOld = $this->image;
        $this->image = imagecreatetruecolor($width, $height);

        if (in_array($this->imageType, [IMAGETYPE_PNG, IMAGETYPE_WEBP])) {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
            imagecolortransparent($this->image, $background);
        } else {
            $background = imagecolorallocate($this->image, 255, 255, 255);
        }

        imagefilledrectangle($this->image, 0, 0, $width, $height, $background);
        imagecopyresampled(
            $this->image,
            $imageOld,
            $xPosition,
            $yPosition,
            0,
            0,
            $newWidth,
            $newHeight,
            $this->getWidthHeight()[0],
            $this->getWidthHeight()[1]
        );

        imagedestroy($imageOld);
        return $this->image;
    }

    public function load($fileName)
    {
        $image_info = getimagesize($fileName);
        $this->imageType = $image_info[2];
        switch ($this->imageType) {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($fileName);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($fileName);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($fileName);
                break;
            case IMAGETYPE_WEBP:
                $this->image = imagecreatefromwebp($fileName);
                break;
        }
    }

    public function save($fileName, $permissions = null)
    {
        switch ($this->imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, $fileName, $this->compression);
                break;

            case IMAGETYPE_GIF:
                imagegif($this->image, $fileName);
                break;

            case IMAGETYPE_PNG:
                imagepng($this->image, $fileName);
                break;

            case IMAGETYPE_WEBP:
                if (function_exists('imagewebp')) {
                    imagewebp($this->image, $fileName, $this->compression);
                } else {
                    throw new Exception('Error: WebP not supported by your PHP GD library');
                }
                break;
        }

        if ($permissions !== null) {
            chmod($fileName, $permissions);
        }
    }
    
    public function getSize(string $size): array
    {
        $parts = explode('x', strtolower(trim($size)));

        if (count($parts) !== 2 || !is_numeric($parts[0]) || !is_numeric($parts[1])) {
            throw new Exception('Invalid size format. Expected "WIDTHxHEIGHT", got: ' . $size);
        }

        return [
            'width'  => (int) $parts[0],
            'height' => (int) $parts[1],
        ];
    }
}
