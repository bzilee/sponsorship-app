<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\CodeTable;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\v1\UploadTrait;
use App\Helpers\VerificationCodeHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Helpers\SendSMSHelper;
use App\Models\Setting;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    use UploadTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $helper = null;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $code_identification= null;

      /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /**
         * Désactivation du login automatique par mise en commentaire
         */

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $count_down_date = Setting::find(1)->pluck('sponsorship_date')->first();
        return view('auth.register',[
            'count_down_date' =>  $count_down_date
        ]);
    }

    protected function redirectTo()
    {
        return '/sms/code/verification/'.$this->code_identification;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationCodeHelper $helper)
    {
        $this->helper = $helper;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:55'],
            'last_name' => ['required', 'string', 'max:55'],
            'sexe' => ['required', 'string'],
            'filiere' => ['required', 'string'],
            'phone_orange' => ['required', 'integer','starts_with:69,655,656,657,658,659','digits:9'],
            'phone2' => ['nullable', 'integer','starts_with:650,652,653,656,657,658,659,67,69,655,66,68,654,651','digits:9'],
            'phone3' => ['nullable', 'integer','starts_with:67,69,650,653,655,66,68,654,651,652,650','digits:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => 'required|image|mimes:jpeg,jpg',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = null;

        //Sauvegarde de l'image et recuperation du chemin d'accèes
        $avatar = $this->getFile($data['avatar'], 'avatar', $data['name']);
        // Type d'user
        $type = (($data['filiere'] =='SR1' || $data['filiere'] == 'GL1')? 'Child':'Parent');

        //Code d'identification
        do {
            $this->code_identification = $this->helper->getIdentificationCode(6);
        } while (User::where('identification_code', $this->code_identification)->exists());

        //Url d'accès au profil
        $url = (($type =='Child' )? 'show/my-child/'. $this->code_identification:'show/my-proposer/'.$this->code_identification);

        //Code de verification SMS
        $code_verification =null;
        do {
            $code_verification = $this->helper->getVerificationCode(5);
        } while (CodeTable::where('code_verification',  $code_verification)->exists());

        try {
            DB::beginTransaction(); //Lancement de la transaction

                //Creation de l'user dans la table des Users
                $user = User::create([
                    'name' =>  ucwords(strtolower($data['name'])),
                    'last_name' => ucwords(strtolower($data['last_name'])),
                    'sexe' => $data['sexe'],
                    'filiere' => $data['filiere'],
                    'type' => $type,
                    'identification_code' => $this->code_identification ,
                    'url_link_affiliate' =>  $url,
                    'photo' =>  $avatar,
                    'phone2' => $data['phone2'],
                    'phone3' => $data['phone3'],
                    'email' => strtolower($data['email']),
                    'password' => Hash::make($data['password']),

                ]);
                //Insertion des Contacts
                $user->contacts()->create([
                    'phone_orange' => $data['phone_orange'],
                    'phone2' => ($data['phone2'] == "")? NULL: $data['phone2'],
                    'phone3' => ($data['phone3'] == "")? NULL: $data['phone3']
                ]);

                 //Sauvegarde du code verification
                $user->codeVerification()->create([
                    'code_verification' => $code_verification,
                    'expire_at' => Carbon::now()->add(2,'hour')
                ]);
            // Validation de la transaction
            DB::commit();
            $this->sendSMS(); // Envoi du code verification
        } catch (\Throwable $th) { //Echec de transaction
            DB::rollBack(); //Annulation de toutes les requetes
           // dd($th);
        }
        return $user;
    }

    /**
     *
     *
     *
     **/
    private function sendSMS()
    {
        $code_verification = $this->getCodeVerification($this->code_identification);

        $phone_number = $this->getPhoneNumber($this->code_identification);
        $text = "Parrainage IAI - Centre de Douala. Veillez saisir ce code de verification : "
        .$code_verification
        ." ou alors utilisez directement ce lien : "
        .config('data.url')
        ."/sms/code/verification/"
        .$this->code_identification
        .$code_verification;

        SendSMSHelper::sendCodeVerification(
            $this->code_identification,
            $phone_number ,
            $text
        );
    }


    /**
     *
     *
     *
     *
     * @param Request $request
     * @return
     **/
    private function getPhoneNumber($code_identification)
    {
       return User::where('identification_code',$code_identification)->first()->contacts()->pluck('phone_orange')->first();
    }

    /**
     *
     *
     *
     *
     * @param Request $request
     * @return
     **/
    private function getCodeVerification($code_identification)
    {
       return User::where('identification_code',$code_identification)->first()->codeVerification()->pluck('code_verification')->first();
    }
}
