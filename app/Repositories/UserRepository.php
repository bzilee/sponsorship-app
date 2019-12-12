<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of User Model
     *
     * @return User
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

    /**
     * Retourne le nombre total d'enregistrement
     *
     *
     *
     * @return int
     **/
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Retourne le nombre total d'enregistrement
     *
     *
     *
     * @return int
     **/
    public function countWhere($type)
    {
        return $this->model->where('type', $type)->count();
    }

     /**
     * Retourne les id des users
     *
     *
     *
     * @return int
     **/
    public function getUsersId($where)
    {
        return $this->model->where('type', $where)->pluck('id')->toArray();

    }

    /**
     * Informations utilisateur
     *
     * Récupère les informations d'un utilisateur via son id
     *
     * @param int $id id de l'utilisateur
     * @return Collection
     **/
    public function getUserInformations($id)
    {
        return $this->model->find($id);
    }


    /**
     * Informations utilisateur
     *
     * Mets à jour les informations d'un utilisateur via son id
     *
     * @param int $id id de l'utilisateur
     * @param string $value id de l'utilisateur
     * @return Collection
     **/
    public function updateUrlLink($id, $value)
    {
        $user = $this->model->find($id);
        $user->url_link_affiliate = $value;
        return $user->save();
    }

    /**
     * Informations utilisateur
     *
     * Mets à jour les informations d'un utilisateur via son id
     *
     * @param int $id id de l'utilisateur
     * @param array $value Tableau des valeurs à mettre à jour
     * @return boolean
     **/
    public function update($id, $values)
    {
        $user = $this->model->find($id); //Récuperation de l'user

        foreach ($values as $key => $value) {
            $user->$key = $value; // Modiffication
        }

        return $user->save(); // Validation
    }

    /**
     * Verification de champ
     *
     * Vérifie si une valeur donnée du champ existe déjà
     *
     * @param String $code Code d'identification
     * @return boolean
     **/
    public function codeIDExist($code)
    {
        return $this->model->where('identification_code', $code)->exists();
    }

     /**
     *
     *
     *
     */
    public function updateAny($identification_code, $data)
    {
        $value_update = [];

        foreach ($data as $key => $value) {
            $value_update[$key] = $value;
        }

        return $this->model->where('identification_code', $identification_code)
          ->update($value_update);
    }


}
