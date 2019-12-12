<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorshipTable extends Model
{
    /**
    * The table associated with the model.
    * Latale associée au modèle
    *
    * @var string
    */
   protected $table = 'sponsorship_tables';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id','child_id','child_order','sponsorship_no','created_at','updated_at'];

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
}
