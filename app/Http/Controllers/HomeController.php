<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers;

use App\Events\WebSocketEvent;
use App\Helpers\VerificationCodeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //
    }

    /**
     * Show the application dashboard.
     * Affiche la page principale de l'application
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Récuperation de la date de parrainage depuis la table setting de la BD
        $count_down_date = Setting::find(1)->pluck('sponsorship_date')->first();

         //Dans le cas où l'user n'est pas connecté(déjà inscrit ou pas)
         if (!Auth::check()) {

            // Retourne la vue qui incite à s'inscrire au parrainage
            return view('home',[
                // Envoi de la date de parrainage dans la barre de menu de la vue
                'count_down_date' =>  $count_down_date,
            ]);

        }else {
            return view('countdownProcess',[
                'css_page' =>'app.countdown.process.css',
                // Désactivation du compteur à rebout dans la barre de menu
                'count_down_nav' => false,
                // Parametrage du compte à rebout
                'count_down_date' =>  $count_down_date,
                // Chargement du fichier javaScript
                'js_page2' => 'countdownInstance.js'
            ]);
        }
    }
}
