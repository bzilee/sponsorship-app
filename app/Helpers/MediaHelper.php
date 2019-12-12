<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Helpers;

 use Intervention\Image\Facades\Image;
use App\Interfaces\ConstantsInterface as Cst;

class MediaHelper implements Cst
{
    /**
     * @protected
     *
     * @var string $dir, the file uploaded path
     */
    protected static $dir = 'app'.Cst::SEPARATOR.'public';

    /**
     * @return string
     */
    public static function getUploadsFolder()
    {
        return self::$dir;
    }

    /**
     * @return string
     */
    public static function getStoragePath()
    {
        return storage_path(self::getUploadsFolder());
    }

    /**
     * Return the size of an image
     *
     * @param string $file
     * @param string $folder
     * @return array $width and $height of the file give in parameter
     */
    public static function getFileSizes(string $file)
    {
        list($width, $height, $type, $attr) = getimagesize(storage_path(self::$dir.Cst::SEPARATOR.$file));
        return [
            'width'     => $width,
            'height'    => $height
        ];
    }

    /**
     * resize, To rezise and image
     *
     * @param string    $file,      l'image à redimmensionner
     * @param int       $width,     la largeur à laquelle on doit redimensionner l'image
     * @param int       $height,    la hateur à laquelle on doit redimensionner l'image
     * @param string    $filepath,  le chemin ou est gardé le fichier redimensionné
     */
    public static function resize($file, $width, $height, $filepath)
    {
        Image::make($file)->resize($width, $height)->save($filepath);
    }

}
