<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\SortChild;
use App\Models\SortParent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnonymeRepository
{
    /**
     * @var $model_sort_parent
     */
    private $model_sort_parent;

    /**
     * @var $model_sort_child
     */
    private $model_sort_child;

    /**
     * Repository constructor.
     * @param  $model_sort_parent
     * @param  $model_sort_child
     */
    public function __construct(
        SortChild $model_sort_child,
        SortParent $model_sort_parent)
    {
        $this->model_sort_parent = $model_sort_parent;
        $this->model_sort_child = $model_sort_child;
    }

    /**
     * Return a new instance of Model
     *
     * @return
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

     /**
     * Recupère et supprime une ligne des tables SortChild et SortParent
     *
     *
     * @return array
     **/
    public function selectAndDelete()
    {
        $child = null;
        $parent = null;
        try {
            DB::beginTransaction();
                $parent = $this->model_sort_parent->first();
                $child = $this->model_sort_child->first();

                $this->model_sort_parent->destroy($this->getID($parent));
                $this->model_sort_child->destroy($this->getID($child));
            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
            return false;
        }
        return  ['child' => $child, 'parent' => $parent];
    }

     /**
     * Fonction sur une SortParent|SortChild  données
     *
     * Retourne l'id de l'unique object de la SortParent|SortChild $data
     *
     * @param SortParent|SortChild $data  Données
     * @return int

     **/
    private function getID(Model $data)
    {
        return $data->id;
    }

    /**
     * Fonction de réinitialisation
     *
     * Réinitialise les tables SortChild et SortParent
     *
     * @return boolean
     *
     **/
    public function resetSortTables()
    {
        try {
            DB::beginTransaction();
                $this->model_sort_parent->truncate ();
                $this->model_sort_child->truncate ();
            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
