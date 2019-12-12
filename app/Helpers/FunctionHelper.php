<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Helpers;
/**
 * Ce helper regroupe des fonctions
 */
class FunctionHelper
{
    /**
     * Fonction sur un tableau
     *
     * Cette fonction mélange aléatoirement les index-valeurs d'un tableau
     *
     * @param array $array Tableau à mélanger
     * @return array
     **/
    public function shuffle_extra($array )
    {
        // vérifie si c'est un tableau
        if (!is_array($array)) {
            return array();
        }

        // mélange les clés du tableau
        shuffle($array);

        // retourne le résultat
        return $array;
    }

    /**
     * Fonction de tableaux complexes
     *
     * Cette fonction permet de renommer index d'un sous-tableau dans un tableau
     *
     * @param array $data Un tableau de données
     * @param string $key La valeur nouvelle de l'unique index du sous tableau
     * @return array
     **/
    public function arrayFillKeys($data, $key)
    {
        $result = [];
       foreach ($data as $values) {
           $array_tmp = [];
           foreach ($values as  $value) {
               $array_tmp[$key] = $value;
           }
           $result[] =  $array_tmp;
       }
       return $result;
    }



}
