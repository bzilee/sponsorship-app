<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SortChild extends Model
{
    /**
     * The table associated with the model.
     * Latale associée au modèle
     *
     * @var string
     */
    protected $table = 'sort_children';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','created_at','updated_at'];
}
