<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\SponsorshipTable;

class SponsorshipTableRepository
{
    /**
     * @var SponsorshipTable
     */
    private $model;

    /**
     * SponsorshipTableRepository constructor.
     * @param SponsorshipTable $model
     */
    public function __construct()
    {
        $this->model = new SponsorshipTable();
    }

    /**
     * Récupère toutes les lignes de la table
     *
     *
     * @return Illuminate\Database\Eloquent\Collection
     **/
    public function getAll()
    {
        return $this->model->all();
    }

     /**
     * Récupère toutes les lignes de la table
     *
     *
     * @return Illuminate\Database\Eloquent\Collection
     **/
    public function create($data)
    {
        return $this->model->create($data);
    }

}
