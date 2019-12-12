<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Helpers\SendSMSHelper;
use App\Repositories\CodeTableRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class VerificationCodeController extends Controller
{

    private  $code_table_repository = null;
    private $user_repository = null;


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CodeTableRepository $code_table_repository, UserRepository $user_repository)
    {
        $this->code_table_repository = $code_table_repository;
        $this->user_repository = $user_repository;
    }

    /**
     *
     * Fonction qui affiche la vue où l'utilisateur devra inscrit(saisir)
     * son code verification recu par SMS
     *
     * @return View
     *
     **/
    public function index(Request $request)
    {

        if (User::where(
            ['identification_code' =>$request->code_identification,
                'account_activated' => 0]
        )->exists()) {

            $phone_number = $this->getPhoneNumber($request);

            return view('verificationCode',
                        [
                            'css_page' =>'app.style.verification.css', // Chargement du css
                            'count_down_date' => Setting::find(1)->pluck('sponsorship_date')->first(),
                            'code_identification' => $request->code_identification, //Code d'identification
                            'phone_number'=>  $phone_number
                        ]);
        }else {
            return abort(404); //Redirection à la page erreur
        }

    }

    /**
     * Fonction qui verifie le code verification saisi par l'utilisateur
     *
     * @param Request $request
     * @return View
     *
     **/
    public function codeValidation(Request $request)
    {
        //SI le compte de l'utilisateur n'est pas activé
        if (User::where([
            'identification_code' =>$request->code_identification,
            'account_activated' => 0
        ])->exists()) {

            Validator::make($request->all(), [
                'codeVerification' => 'required|digits:5',
            ])->validate();

            $data = $this->code_table_repository->getTuple($request->code_identification);

            if ($data != null && $data->code_verification ==   $request->codeVerification) {

                //Si l'user n'est pas connecté
                if (!Auth::check()) {
                    //On le connecte
                    Auth::login(User::where('identification_code', $request->code_identification)->first());
                }

                $this->sendWelcomeSMS(Auth::id());
                return redirect()->route('code.validation.success');
            } else {
                return back()
                ->withInput($request->only('codeVerification'))
                ->withErrors(['codeVerification' => 'Votre code de vérification est incorrect.']);
            }

        // Si le compte activé, action inutile. Retour d'un msg d'erreur(Page 404)
        }else {

            return abort(404);
        }

    }

    /**
     *
     * Fonction qui notifie(par vue HTML) l'utilisateur du bon deroulement de
     * son inscription
     *
     *
     * @param Type $var
     * @return View

     **/
    public function validationSuccess(Request $request)
    {
        if (User::where([
            'id' =>Auth::id(),
            'account_activated' => 0
        ])->exists()) {

            // Activation du compte
            $this->user_repository->update(
                Auth::id(),
                ['account_activated' => 1]
            );

            return view('successRegister', [
                'css_page' => 'app.succes.register.css',
                'count_down_date' => Setting::find(1)->pluck('sponsorship_date')->first(),
                'last_name_user' => Auth::user()->last_name
                ]);
        }else {
            abort(404);
        }
    }


    /**
     *
     * Fonction qui retourne le numero d'un utilisateur depuis son
     * code d'identification present dans la "request object"
     *
     *
     * @param Request $request
     * @return int
     **/
    private function getPhoneNumber($request = null)
    {
        if ($request instanceof Request) {

            return User::where('identification_code',$request->code_identification)->first()->contacts()->pluck('phone_orange')->first();

        } else {

            return User::find($request)->contacts()->pluck('phone_orange')->first();
        }
    }

    /**
     * Fonction d'envoi d'un SMS de Bienvenu après
     * validation du code verification
     *
     * @param int $user_id id de l'utilisateur
     * @return void
     *
     **/
    private function sendWelcomeSMS($user_id)
    {
        $user =  User::find($user_id);
        $sponsorship_date = Setting::find(1)->pluck('sponsorship_date')->first();
        $code_identification = $user->identification_code;
        $phone_number = $this->getPhoneNumber($user_id);
        $text = "Félication ".$user->last_name.". Tu es inscrit(e) pour le Parrainage à IAI - Centre de Douala. Rendez-vous le ".$sponsorship_date." pour la cérémonie.";

        SendSMSHelper::sendCodeVerification(
            $code_identification,
            $phone_number ,
            $text
        );
    }
}
