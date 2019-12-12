<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Setting;

class UserProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userProfile()
    {
        $user = Auth::user();

        $title = 'Mon profile, '. $user->last_name.' | '.config('app.name');
        //$photo_profile = Storage::url($user->photo);

        return view('userProfile',[
            'title' =>  $title ,
            'count_down_date' => Setting::find(1)->pluck('sponsorship_date')->first(),
            'user' =>  $user,
            //'photo_profile' => $photo_profile,

        ]);
    }

     /**
     *
     *
     *
     */
    public function profile()
    {
        $title = 'Profile Utilisateur';
        return view('showProfile', [

        ]);
    }
}
