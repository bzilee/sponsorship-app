<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'max_affiliation',
        'iteration_order',
        'iteration_level',
        'iteration_order_stop',
        'iteration_order',
        'iteration_level_stop',
        'iteration_remainber',
        'remainber',
        'stop_process',
        'sponsorship_date',

    ];

     /**
     * The table associated with the model.
     * Latale associée au modèle
     *
     * @var string
     */
    protected $table = 'settings';

}
