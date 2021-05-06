<?php
/**
 * Plugin Name: Pet Pet Goose
 * Description: Pet Pet Goose ecommerce and community platform
 * Version: 0.0.1
 * Author: Harbor Social
 */
require_once('autoload.php');
//Initialization 
//two processes to consider: 1. listing, 2. signup
if(preg_match('/list-your-pet/',$_SERVER['REQUEST_URI'])||preg_match('/breeder-details-listing/',$_SERVER['REQUEST_URI'])){
    define('aboutYourPetFormID',23); 
    define('aboutBreederDetailsFormID',24); 
    define('aboutYourPetSlug','list-your-pet');
}else if(preg_match('/about-your-pet/',$_SERVER['REQUEST_URI'])||preg_match('/breeder-details/',$_SERVER['REQUEST_URI'])){
    define('aboutYourPetFormID',11); 
    define('aboutBreederDetailsFormID',9); 
    define('aboutYourPetSlug','about-your-pet');
}
define('aboutYourPetSubmitted','is_submit_'.aboutYourPetFormID); //when $_POST['is_submit_8']=1
define('addPetExtrasSubmitted','is_submit_8'); //when $_POST['is_submit_8']=1
define('breederDetailsSubmitted','is_submit_'.aboutBreederDetailsFormID); //when $_POST['is_submit_9']=1
define('listPlanCheckout','is_submit_12'); //when $_POST['is_submit_12']=1

class petPetGoose{
    public $registration;
    public $AddPetProduct;
    public $BreederRemainingPetlisting;
    public $inputs=array();
    private $user;

    public function __construct(){
        $this->user = wp_get_current_user();
        $this->load();
        //no need to load js and css since they may conflict with Angel's new backend
        //add_action('plugins_loaded',array($this,'enqueu'));
    }
    public function enqueu(){
        wp_enqueue_script(
            'petpetgoose-main-js', // Handle.
            plugins_url( 'js/main.js',  __FILE__  ), 
            array( 'jquery' ), // Dependencies, defined above.
            time(), 
            true 
        );          
        wp_enqueue_style(
            'petpetgoose-style-css', // Handle.
            plugins_url( 'css/style.css', __FILE__ ),
            array( 'wp-editor' )
        );	        
    }
    //load classes
    public function load(){
        if(preg_match('/list-your-pet/',$_SERVER['REQUEST_URI'])){ //legacy about-your-pet is only for the signup process, not listing.  Assume zero pet listing so far for about-your-pet, i.e., no need to redirect
            //check if the logged in user is breeder and if any more pet listing is allowed for the user
            $this->BreederRemainingPetlisting=new petpetgoose\product\BreederRemainingPetlisting;
            $noremaining=$this->BreederRemainingPetlisting->getRemainingListingAllowed($this->user);
            if($noremaining<1)
            {  
                //ref
                $roles=$this->user->roles;
                if(in_array('um_breeder',$roles)){
                    $upgradeFrom='basic';
                }else if(in_array('um_breeder-plus',$roles)){
                    $upgradeFrom='plus';
                }
                //1556 is the professional
                wp_redirect(site_url().'/checkout/?add-to-cart=1556&upgrade=Y&upgradeFrom='.$upgradeFrom);
                exit();
            }
        }
        if(isset($_POST[aboutYourPetSubmitted])&&$_POST[aboutYourPetSubmitted]){
            $this->AboutYourPet=new petpetgoose\product\AboutYourPet($this->user);
        }
        if(isset($_POST[addPetExtrasSubmitted])&&$_POST[addPetExtrasSubmitted]){
            $this->AddPetExtras=new petpetgoose\product\AddPetExtras;
        }
        if(isset($_POST[breederDetailsSubmitted])&&$_POST[breederDetailsSubmitted]){
            $this->AddPetExtras=new petpetgoose\product\BreederDetails;
        }
        if(isset($_POST[listPlanCheckout])&&$_POST[listPlanCheckout]){
            $this->AddPetExtras=new petpetgoose\product\ListPlanCheckout;
        }        
    }
}

$petPetGoose=new petPetGoose();
?>