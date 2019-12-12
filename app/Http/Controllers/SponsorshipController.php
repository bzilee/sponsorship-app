<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */

namespace App\Http\Controllers;

use App\Helpers\FunctionHelper;
use App\Helpers\VerificationCodeHelper;
use App\Repositories\AnonymeRepository;
use App\Repositories\SortChildRepository;
use App\Repositories\SortParentRepository;
use App\Repositories\SponsorshipTableRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use App\Events\StartSponsorshipEvent;
use App\Events\StartCountDownSponsorshipEvent;
use App\Events\JoinSponsorshipEvent;
use App\Events\SponsorshipEvent;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Models\SponsorshipTable;
use App\Helpers\SendSMSHelper;

/**
 * Cette classe se charge du processus de parrainage tout entier
 */
class SponsorshipController extends Controller
{

    /**
     * @var array $parents_id Les ID des Parrains
     *
     */
    protected $parents_id = null;

    /**
     * @var array $children_id Les ID des Filleules
     */
    protected $children_id = null;

     /**
      * @var SortParentRepository $sort_parent_repository Notre Instance de SortParentRepository
      */
     protected $sort_parent_repository = null;

      /**
       * @var SortChildRepository $sort_child_repository  Notre Instance de SortChildRepository
       */
      protected $sort_child_repository = null;

      /**
       * @var AnonymeRepository $anonyme_repo Notre Instance de AnonymeRepository
       */
      protected $anonyme_repo = null;

      protected $stop_join_event = false;

     /**
      * @var FunctionHelper $helper Notre Instance de Helper : contient des fonctions importantes  pour le processus de parrainage
      */
     protected $helper= null;

    /**
     * @var UserRepository $UserRepository Notre Instance de UserRepository
     *
     */
    protected $userRepository = null;

    /**
     * Ce constructeur initialise les models, repositories,
     * fonctions d'aide(helpers)
     *
     * @return void
     *
     */
    public function __construct(
        UserRepository $UserRepository, // Les requetes sur la table User
        FunctionHelper $helper, // Les fonctions d'aide
        SortParentRepository $sort_parent_repository, // Les requetes sur la table SortParent
        SortChildRepository $sort_child_repository,  // Les requetes sur la table
        AnonymeRepository $anonyme_repo) {
        $this->userRepository = $UserRepository;
        $this->helper  = $helper;
        $this->sort_parent_repository = $sort_parent_repository;
        $this->sort_child_repository = $sort_child_repository;
        $this->anonyme_repo = $anonyme_repo;
    }


    /**
     * Affiche la page de démarrage du processus de parrainage
     *
     *
     * @param
     * @return View
     **/
    public function viewStart(Request $request)
    {
        if (Carbon::parse(Setting::find(1)->sponsorship_date)->lt(Carbon::now())) {
            $data = [
                'count_down_nav' => false,
                'css_page' =>'app.countdown.process.css',
                'js_page' => 'sponsorship.js',
                'css_page2' => 'app.sponsorship.css',
            ];

            if ($request->user()->type == 'Admin') {
                $data['show_button'] = true;
            }else{
                $data['show_button'] = false;
            }
            return view('sponsorship.sponsorshipViewStart', $data);
        } else {
            return redirect()->route('root');
        }
    }

     /**
     * Affiche la page principale du processus de parrainage
     *
     *
     * @param
     * @return
     **/

    public function index()
    {
        $this->init();

        $this->start();
        dd( $this->nextAffliation());
    }


    /**
     * Initialise les variables necessaires au processus de parrainage
     *
     *
     * @return array
     **/

    private function init()
    {
        $this->getIdUsers();

        $nb_parents = $this->userRepository->countWhere('Parent');;
        $nb_children = $this->userRepository->countWhere('Child');;
        $nb_loop = 0;
        $remainder = 0;
        $remainder_type = 'Parent';

        if ( $nb_children > $nb_parents) { // S'il ya plus de filleules
            $nb_loop = intval($nb_children / $nb_parents) + 1;
            $remainder = $nb_children % $nb_parents ;
            $remainder_type = 'children';
        } else{  // S'il ya plus de parrains

            $result = intval($nb_parents / $nb_children);
            $remainder =$nb_parents % $nb_children;
            $nb_loop =  $result;

        }

        return [
            'parents' => $nb_parents,
            'children' => $nb_children,
            'boucle' =>$nb_loop,
            'remainder' => $remainder,
            'remainder_type' => $remainder_type];
    }

    /**
     * Cette fonction déclenche le processus de parrainage
     *
     */
    public function begin()
    {
        $data = $this->init(); // Evaluation des effectifs
        $this->start(); // Chargement des tables Parrains et filleule après mélange aléatoire
        if ($data['remainder_type'] == 'children' || $data['remainder'] == 0) { // Si plus de filleule ou egalité de parrains et filleule
            for ($i=1; $i <=  $data['boucle']; $i++) {
                if ($data['boucle'] == $i) { // Si dernier tour, limite boucle au restant de filleule

                    for ($j=1; $j <=  ($data['remainder'] == 0)? 1:$data['remainder']; $j++) {
                        $this->affliate();
                    }
                } else {
                   for ($j=1; $j <= $data['parents']; $j++) {
                        $this->affliate();
                    }
                }
                $this->resetSortTables(); // A chaque tour de sous boucles, on réinitialise le de parrains et filleule pour un nouveau tour
            }
            //Fin d'affiliation
        } else {
            for ($i=1; $i <=  $data['boucle']; $i++) {

                for ($j=1; $j <= $data['children']; $j++) {

                    $this->affliate();
                }
                $this->resetSortTables(); // A chaque tour de sous boucles, on réinitialise le de parrains et filleule pour un nouveau tour
            }
            //Fin d'affiliation
        }
        $this->stop_join_event = true; // On ferme l'evenement JoinSponsorshipEvent
        dd();
    }

    /**
     *
     * Cette fonction déclenche un et une seule affliation
     * et notifie son parrain et filleul
     */
    private function affliate()
    {
        $user_insert = $this->nextAffliation(); // Affiliation
        $user_parent = User::find($user_insert->parent_id);
        $user_child = User::find($user_insert->child_id);

        $this->sendEventSponsorship(
            [
                'avatar_parent' => Storage::url($user_parent->photo),
                'name_parent' => $user_parent->name,
                'avatar_child' => Storage::url($user_child->photo),
                'name_child' => $user_child->name,
            ]
        );
        //$this->sendSMS($user_parent,$user_child,$user_insert); //Envoi du sms
        sleep(5); // Pause de 5 secondes avant l'appel suivant de cette fonction
    }

    /**
     *
     * Cette fonction est chargée de declencher
     * l'evenement d'abonnement au channel SponsorshipEvent
     */
    private function sendEventSponsorship($data)
    {
        $event = new SponsorshipEvent($data);
        event($event);
    }

    /**
     * Initialisation
     *
     * Initialise les variables $this->parents_id et $this->children_id
     *
     *
     **/
    public function getIdUsers()
    {
        $this->parents_id =  $this->userRepository->getUsersId('Parent');
        $this->children_id =  $this->userRepository->getUsersId('Child');
    }

    /**
     * Déclenche le processus de parrainage
     *
     *
     * @return
     **/
    public function start()
    {
        $this->load();
    }

    /**
     * Chargement ou Rechargement
     *
     * Charge ou recharge les tables SortParent et SortChild
     *
     * @return
     **/
    public function load()
    {
        $this->getIdUsers();
        // Melange aléatoire des éléments d'affiliation
        $this->parents_id = $this->helper->shuffle_extra($this->parents_id);
        $this->children_id = $this->helper->shuffle_extra($this->children_id);

        $array_chunk_parents = $this->helper->arrayFillKeys(// on modiffie les clés numerique par "users_id"
            array_chunk($this->parents_id, 1), //On sépare le tableau en tableaux de taille inférieure à 1
            "users_id");
        // Meme scenario
        $array_chunk_children = $this->helper->arrayFillKeys(
                array_chunk($this->children_id, 1),
                "users_id");

        //Insertion dans la BD
        try {
            DB::beginTransaction();
                $this->sort_parent_repository->insert($array_chunk_parents);
                $this->sort_child_repository->insert($array_chunk_children);
            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
        }
    }

     /**
     * Etapes d'affliation
     *
     * Cette fonction affilie un filleule à son parrain
     *
     * @param
     * @return
     **/
    public function nextAffliation()
    {
        // Sélection du parrain et filleule
        $parent_and_child = $this->anonyme_repo->selectAndDelete();

        // Si echec
        if ($parent_and_child == null) {
            # code...
        }else {

            //Initialisation du réferentiel(repository)
            $sponsorship_model = new SponsorshipTableRepository();

            // Récupération des id respectifs
            $parent_id = $parent_and_child['parent']->users_id;
            $child_id = $parent_and_child['child']->users_id;

            // Sélection des champs
            $parent_information = $this->userRepository->getUserInformations($parent_id);
            $child_information = $this->userRepository->getUserInformations($child_id);

            // Mis à jour des champs Table Users
            $this->userRepository->update(
                $parent_id,
                [
                    'url_link_affiliate' => "/show/my-child/".$parent_information->identification_code,
                    'nb_filleules' => $parent_information->nb_filleules + 1
                ]
            );
            $this->userRepository->updateUrlLink(
                    $child_id,
                    "/show/my-proposer/".$child_information->identification_code
            );

            // Insertion dans la table de Parrainage
            return $sponsorship_model->create([
                'parent_id' => $parent_id,
                'child_id' => $child_id,
                'child_order' => $parent_information->nb_filleules,
                'sponsorship_no' => 0
            ]);
        }

    }

    /**
     * Réinitialisation
     *
     * Réinitialise les tables SortChild et SortParent
     *
     * @return boolean
     **/
    public function resetSortTables()
    {
        $this->anonyme_repo->resetSortTables();
        $this->load();
    }


    /**
     * Cette fonction declenche l'evenement CountDownSponsorshipEvent
     * avec un mini compteur à rebout de 5 sec
     *
     *
     *
     * @return
     **/
    public function waitingStart()
    {
        // Tri et Melange
        $event = new StartCountDownSponsorshipEvent(5);
        event($event);
        dd();
    }


    /**
     * Cette active à chaque 5 secondes
     * l'evenement d'abonnement
     *
     */
    public function joinSponsorshipChannel()
    {
        // Boucle infinie
        do {
            $event = new JoinSponsorshipEvent();
            event($event);
            sleep(5);
        } while (!$this->stop_join_event);
        dd();
    }


    /**
     * Cette fonction envoi un SMS de notification sur les
     * resultats d'affliation
     *
     * @param User $parent, child
     * @param SponsorshipTable $affiliate
     **/
    public function sendSMS($parent,$child,$affiliate)
    {

        $order = ['','prémièr(e)', 'deuxième', 'troisième', 'quatrième','cinquième', 'sixième', 'septième','huitième','neuvième','dixième','onzième','douzième','treizième'];

        $phone_number_parent = $parent->contacts()->first()->phone_orange;
        $phone_number_child =  $child->contacts()->first()->phone_orange;
        $phone2_child = $child->contacts()->first()->phone2;
        $phone2_parrain = $parent->contacts()->first()->phone2;

        $msg_parrain = "Parrainage IAI - Centre de Douala. Salut "
        .$parent->last_name
        .'. Voici ton/ta '.$order[$affiliate->child_order]
        .' filleul(e); Nom : '
        .$child->name.' '.$child->last_name
        .' Sexe : '
        .$parent->sexe
        .', Téléphone(s) : '
        .$child->contacts()->first()->phone_orange
        .', '
        .$phone2_child;

        $msg_child = "Parrainage IAI - Centre de Douala. Salut "
        .$child->last_name
        .'. Voici ton/ta parrain/marraine; '
        .'Nom : '
        .$parent->name.' '.$parent->last_name
        .' Sexe : '
        .$child->sexe
        .', Téléphone(s) : '
        .$parent->contacts()->first()->phone_orange
        .', '
        .$phone2_parrain;

        // Envoi d'un SMS au parrain
        SendSMSHelper::sendSMS(
            $parent->identification_code,
            $phone_number_parent ,
            $msg_parrain
        );

        // Envoi d'un SMS au parrain
        SendSMSHelper::sendSMS(
            $child->identification_code,
            $phone_number_child ,
            $msg_child
        );
    }



}
