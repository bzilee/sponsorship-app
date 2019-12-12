<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name','filiere','type','sexe','photo','identification_code','url_link_affiliate','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the contacts for the user.
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contacts','users_id');
    }

    public function codeVerification()
    {
        return $this->hasMany('App\Models\CodeTable','users_id');
    }

    public function sms()
    {
        return $this->hasMany('App\Models\SmsTable','users_id');
    }

}
