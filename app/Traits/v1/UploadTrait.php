<?php

/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Traits\v1;

use App\Helpers\MediaHelper;
use Illuminate\Http\UploadedFile;
use App\Interfaces\ConstantsInterface as Cst;

trait UploadTrait
{
    /**
     * Upload file to uploads folder
     *
     * @param string|null $folder
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file, string $folder = null, string $code = null)
    {
        $destinationPath =  is_null($folder) ?
            MediaHelper::getStoragePath() :
            MediaHelper::getStoragePath(). Cst::SEPARATOR .$folder. Cst::SEPARATOR .date('F-Y');
        $extension = $file->getClientOriginalExtension();

        //Renommage du fichier
        $fileName = is_null($code) ?
        'file_'.sha1(explode('.', $file->getClientOriginalName())[0]).'_'.time().'.' .$extension :
        'file_'.sha1(explode('.', $file->getClientOriginalName())[0]).'_'.$code.'.' .$extension;
        $file->move($destinationPath, $fileName);
        $name = $folder.Cst::SEPARATOR.date('F-Y').Cst::SEPARATOR.$fileName;

        return $name;
    }

    public function getFileSizes(string $file, string $folder = null)
    {
        return MediaHelper::getFileSizes($file,$folder);
    }

    private function getFile($file, string $folder = null, $code = null)
    {
        //Récuperation de l'avart et stockage du chemin d'acces dans $file
        if ($file)
            return $this->upload($file,$folder,$code);
        return null ;
    }
    // public function f($value='')
    // {
    //     return Cst::DS;
    // }
}
