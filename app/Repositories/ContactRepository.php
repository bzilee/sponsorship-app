<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    /**
     * @var Contact
     */
    private $model;

    /**
     * ContactRepository constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of Contact Model
     *
     * @return Contact
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

    /**
     * Toutes les lignes de la table contacts
     *
     *
     * @return Illuminate\Database\Eloquent\CollectionCollection
     **/
    public function getAll()
    {
        return $this->model->all();
    }
}
