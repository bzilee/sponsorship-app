<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Traits\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use ResponseTrait;

trait RoleTrait {

	/**
	 * Verifie si l'user est un Adminnistrateur
	 */
	public function isAdmin($user) :bool
	{
		if ($user->role == 'ADMIN') {
			return true;
		}
		return false;
	}
}
