<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeTable extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_verification',
        'users_id',
        'expire_at'
    ];

    /**
     * The table associated with the model.
     * Latale associée au modèle
     *
     * @var string
     */
    protected $table = 'code_tables';

    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
}
