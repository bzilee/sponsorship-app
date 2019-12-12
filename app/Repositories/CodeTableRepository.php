<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Repositories;

use App\Models\CodeTable;
use App\User;

class CodeTableRepository
{
    /**
     * @var CodeTable
     */
    private $model;

    /**
     * CodeTableRepository constructor.
     * @param CodeTable $model
     */
    public function __construct(CodeTable $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of CodeTable Model
     *
     * @return CodeTable
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }

    /**
     * Toutes les lignes de la table code
     *
     *
     * @return Illuminate\Database\Eloquent\CollectionCollection
     **/
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     *
     *
     *
     * @return App\Models\CodeTable
     **/
    public function getTuple($code_identification)
    {
        return User::where('identification_code', $code_identification)->first()->codeVerification()->first();
    }



}
