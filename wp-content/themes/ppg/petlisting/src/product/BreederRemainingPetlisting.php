<?php
namespace petpetgoose\product;

class BreederRemainingPetlisting{
    public function __construct(){
        define('basicallowed',1);
        define('plusallowed',3);
    }
    public function getRemainingListingAllowed($breeder_obj){ //returns how many more pets the breeder can list
        //get breeder type (um_breeder, um_breeder-plus, um_breeder-pro)
        $roles=$breeder_obj->roles;
        if(in_array('um_breeder',$roles)){
            //get allowed no of listings
            $allowed=basicallowed;
        }else if(in_array('um_breeder-plus',$roles)){
            $allowed=plusallowed;
        }else{  //um_breeder-pro
            return 1;
        }
        //get how many already listed
        $nolisted=$this->getNoListings($breeder_obj->ID);
        //No remaining
        $noremaining=$allowed-$nolisted;
        /*
        var_dump($roles);
        var_dump($nolisted);
        var_dump($allowed);
        var_dump($noremaining);exit();
        */
        //return difference
        return $noremaining;
    }
    private function getNoListings($breeder_id){
        //find products with pet_lister_user_id ACF
        $listings= get_posts(array(
            'post_type'		=> 'product',
            'meta_key'		=> 'pet_lister_user_id',
            'meta_value'	=> $breeder_id,
            'post_status'    => 'publish',
        ));
        $query = new \WP_Query($listings);
        $post_count = count($query->posts);
        //var_dump($post_count);exit();
        return $post_count;
    }
}