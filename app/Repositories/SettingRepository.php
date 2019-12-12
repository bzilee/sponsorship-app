<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    /**
     * @var Setting
     */
    private $model;

    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of Setting Model
     *
     * @return Setting
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

     /**
     * Met à jo enregistrement
     *
     *
     *
     * @return int
     **/
    public function updateMR($value)
    {
        $setting = $this->model->find(1); // Permet de recuperer la ligne id=1 de la table users
        $setting->max_affiliation = $value;
        $setting->remainber = $value;

    }
}
