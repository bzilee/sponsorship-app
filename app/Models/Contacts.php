<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_orange', 'phone2','phone3'
    ];

    /**
     * The table associated with the model.
     * La table associée au modèle
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
}
