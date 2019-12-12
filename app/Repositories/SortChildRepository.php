<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\SortChild;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SortChildRepository
{
    /**
     * @var SortChild
     */
    private $model;

    /**
     * SortChildRepository constructor.
     * @param SortChild $model
     */
    public function __construct(SortChild $model)
    {
        $this->model = $model;
    }

     /**
     * Insere les données $data dans la table
     *
     *
     * @return
     **/
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * Return a new instance of SortChild Model
     *
     * @return SortChild
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

    /**
     * Toutes les lignes de la table
     *
     *
     * @return Illuminate\Database\Eloquent\CollectionCollection
     **/
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Recupère et supprime une ligne de la table
     *
     *
     * @return
     **/
    public function selectAndDelete()
    {
        $child = null;
        try {
            DB::beginTransaction();
                $child = $this->model->limit(1)->get();
                $this->model->destroy($this->getID($child));
            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
            return false;
        }
        return  $child;
    }

    /**
     * Fonction sur une Collection de données
     *
     * Retourne l'id de l'unique object de la collection $data
     *
     * @param Collection $data Collection de données
     * @return int

     **/
    private function getID(Collection $data)
    {
        return $data[0]->id;
    }

}
