<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\SortParent;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SortParentRepository
{
    /**
     * @var SortParent
     */
    private $model;

    /**
     * SortParentRepository constructor.
     * @param SortParent $model
     */
    public function __construct(SortParent $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of SortParent Model
     *
     * @return SortParent
     */
    public function newInstance()
    {
        return $this->model->newInstance();
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
     * Recupère toutes les lignes de la table
     *
     *
     * @return
     **/
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Supprime une ligne de la table
     *
     *
     * @return
     **/
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Recupère une ligne de la table
     *
     *
     * @return
     **/
    public function selectOne()
    {
        return $this->model->get()->first();
    }

    /**
     * Recupère une ligne de la table
     *
     *
     * @return
     **/
    public function selectAndDelete()
    {
        $parent = null;
        try {
            DB::beginTransaction();
                $parent = $this->model->limit(1)->get(); //Recupère une ligne
                $this->model->destroy($this->getID($parent)); // Supprime la ligne
            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
            return false;
        }
        return  $parent;
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

    /**
     * Recupère une ligne de la table
     *
     *
     * @return
     **/
    public function truncate ()
    {
        return $this->model->truncate ();
    }
}
