<?php
namespace petpetgoose\product;

use  petpetgoose\util\GetAttachmentID;

//$_POST keys to human readable constants
//two processes to consider: 1. listing, 2. signup
if(preg_match('/list-your-pet/',$_SERVER['REQUEST_URI'])){
    define('aboutYourPetFormID',23); 
}else if(preg_match('/about-your-pet/',$_SERVER['REQUEST_URI'])){
    define('aboutYourPetFormID',11); 
}

define('entryIDaboutYourPetPrice',19); //$entry elem no
define('entryIDsex',13); 
define('entryIDpetSubCatDog',6); 
define('entryIDpetSubCatCat',8); 
define('entryIDpetSubCatBird',9); 
define('entryIDpetSubCatHorse',10); 
define('entryIDpetSubCatReptile',11); 
define('entryIDpetSubCatSmallPets',29); 
define('entryIDpetSubCatFarmLife',30); 
define('entryIDpetProdCat',21); 
define('entryIDcolor',14); 
define('entryIDusername',1); 
define('entryIDAge',22); 
define('entryIDWeight',23); 
define('entryIDVideolink',26); 
define('entryIDAddPhotos',25); 
define('entryIDPetName',28); 
define('entryIDHeadline',5); 

class AboutYourPet{
    private $user;

    function __construct($userObj){
        $this->user=$userObj;
        //add_filter( 'gform_after_submission_'.aboutYourPetFormID, array($this,'petListerUserIdUpdate'),10,2 );
        add_action( 'gform_after_submission_'.aboutYourPetFormID, array($this,'petListerUserIdUpdate'),10,2 );
    }
    function petListerUserIdUpdate($entry, $form){ 
        global $wpdb;
        //convert username to userid
        //$user = get_user_by('login',$entry[entryIDusername]);
        //$user=get_user_by('id',$this->userid);
        //if($user){
            $id=$this->user->ID;
            $userEmail= $this->user->user_email;
        //}

        set_post_type($entry['post_id'],'product');
        update_field('pet_lister_user_id', $id, $entry['post_id']);
        update_field('pet_lister_user_email', $userEmail, $entry['post_id']);
        update_field('age', $entry[entryIDAge], $entry['post_id']);
        update_field('weight', $entry[entryIDWeight], $entry['post_id']);
        update_field('youtube_videos', $entry[entryIDVideolink], $entry['post_id']);
        update_field('pets_nickname', $entry[entryIDPetName], $entry['post_id']);
        //gravity form creates _regular_price only.  also need _price for price to show
        update_post_meta($entry['post_id'],'_price',$entry[entryIDaboutYourPetPrice]);
        //set stock of 1
        update_post_meta($entry['post_id'], '_stock', 1);

        //set attributes (attributes have been created from wp-admin (wp-admin/edit.php?post_type=product&page=product_attributes))
        //TODO: create attributes programmatically using register_taxonomy
        $term_sex_id=wp_set_object_terms( $entry['post_id'],$entry[entryIDsex], 'pa_sex' , false);
        $term_color_id=wp_set_object_terms( $entry['post_id'],$entry[entryIDcolor], 'pa_color' , false);
        $term_age=wp_set_object_terms( $entry['post_id'],$entry[entryIDAge], 'pa_age' , false);
        $term_weight=wp_set_object_terms( $entry['post_id'],$entry[entryIDWeight], 'pa_weight' , false);
        $term_videoLink=wp_set_object_terms( $entry['post_id'],$entry[entryIDVideolink], 'pa_videolink' , false);

        //get pet sub category (get_term_by doesn't work at this point of loading until 'init')
        //can be any one of dog,cat,bird,horse,reptile, but just one
        //TODO: must be a better way...
        $animalSubCat='';
        if(!empty($entry[entryIDpetSubCatDog])){
            $animalSubCat=$entry[entryIDpetSubCatDog];
        }
        else if(!empty($entry[entryIDpetSubCatCat])){
            $animalSubCat=$entry[entryIDpetSubCatCat];
        }
        else if(!empty($entry[entryIDpetSubCatBird])){
            $animalSubCat=$entry[entryIDpetSubCatBird];
        }
        else if(!empty($entry[entryIDpetSubCatHorse])){
            $animalSubCat=$entry[entryIDpetSubCatHorse];
        }
        else if(!empty($entry[entryIDpetSubCatReptile])){
            $animalSubCat=$entry[entryIDpetSubCatReptile];
        }   
        else if(!empty($entry[entryIDpetSubCatSmallPets])){
            $animalSubCat=$entry[entryIDpetSubCatSmallPets];
        }  
        else if(!empty($entry[entryIDpetSubCatFarmLife])){
            $animalSubCat=$entry[entryIDpetSubCatFarmLife];
        }      
    
        //populate post_excerpt field to allow woof_text_filter better search results
        $post_excerpt_str=$entry[entryIDpetProdCat].' '.$entry[entryIDPetName].' '.$animalSubCat.' '.$entry[entryIDcolor].' '.$entry[entryIDsex];
        $post = get_post( $entry['post_id'] );
        $post->post_excerpt=$post_excerpt_str;
        //var_dump($post);exit();
        //as of 20210211 on, product slug wasn't getting formed automatically.  Forcing the formation and assignment
        if ( empty($post->post_name) ) {
            $post->post_name = sanitize_title($post->post_title);
        } else {
            // On updates, we need to check to see if it's using the old, fixed sanitization context.
            $check_name = sanitize_title( $post->post_name, '', 'old-save' );
            if ( $update && strtolower( urlencode( $post->post_name ) ) == $check_name && get_post_field( 'post->post_name', $post_ID ) == $check_name ) {
                $post->post_name = $check_name;
            } else { // new post, or slug has changed.
                $post->post_name = sanitize_title($post->post_name);
            }
        }
        $post->post_name = wp_unique_post_slug( $post->post_name, $post->ID, 'publish', $post->post_type, $post->post_parent );

        wp_update_post( $post );

        //$q="select name from {$wpdb->prefix}terms where term_id=".$animalSubCat;
        //$subAnimalTerm=$wpdb->get_row($q);
        //$term_animalSubType_id=wp_set_object_terms( $entry['post_id'],$subAnimalTerm->name, 'pa_pet-sub-category' , false);
        wp_set_object_terms( $entry['post_id'], $animalSubCat, 'pa_pet-sub-category' );
        wp_set_object_terms( $entry['post_id'], $entry[entryIDpetProdCat], 'product_cat' );

        $term_data = Array(
            'pa_sex'=>Array( 
                  'name'=>'pa_sex', 
                  'value'=>$entry[entryIDsex],
                  'is_visible' => '1',
                  'is_variation' => '1',
                  'is_taxonomy' => '1'
            ),
            'pa_color'=>Array( 
                'name'=>'pa_color', 
                'value'=>$entry[entryIDcolor],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),            
            'pa_pet-sub-category'=>Array( 
                'name'=>'pa_pet-sub-category', 
                //'value'=>$subAnimalTerm->name,
                'value'=>$animalSubCat,
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
          ),            
            'pa_age'=>Array( 
                'name'=>'pa_age', 
                'value'=>$entry[entryIDAge],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
          ),            
          'pa_weight'=>Array( 
              'name'=>'pa_weight', 
              'value'=>$entry[entryIDWeight],
              'is_visible' => '1',
              'is_variation' => '1',
              'is_taxonomy' => '1'
            ),            
            'pa_videolink'=>Array( 
                'name'=>'pa_videolink', 
                'value'=>$entry[entryIDVideolink],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            )
       );

       //https://support.advancedcustomfields.com/forums/topic/updating-the-gallery-field-using-update_field/
        //get attachment IDs
        //$entry[3] => array of URLs of uploaded files
        $GetAttachmentID=new GetAttachmentID;
        $attachmentIDs=$GetAttachmentID->getAttchmentIDarray($entry, entryIDAddPhotos);
        update_field('additional_photos', $attachmentIDs,  $entry['post_id']);

        //update default product gallery
        $this->petpetGoose_upload_all_images_to_product($entry['post_id'],$attachmentIDs);

        //This may be an edit, so there may be prev attributes from BreederDetails that need to be kept.
        //get these previously entered attributes and add them to $term_data array
        //pa_free-shipping,pa_health-guarantee,pa_registration,pa_returns,pa_training,pa_vaccine
        $prevAttributes = get_post_meta( $entry[aboutBreederDetailsProductId], '_product_attributes', true );
        $term_data_add=array();
        $breederDetailTax=array('pa_free-shipping','pa_health-guarantee','pa_registration','pa_returns','pa_training','pa_vaccine','pa_champion');
        if(sizeof($prevAttributes)){
            foreach($prevAttributes as $k=>$v){
                if(in_array($k,$breederDetailTax)){
                    $term_data_add[$k]=array(
                        'name'=>$k, 
                        'value'=>$v['name'],
                        'is_visible' => '1',
                        'is_variation' => '1',
                        'is_taxonomy' => '1'                        
                    );
                }
            }
        }
        $term_data=array_merge($term_data,$term_data_add);
       update_post_meta( $entry['post_id'],'_product_attributes',$term_data);

       //since pets get listed by registered breeders with at least basic level at this point of the workflow
       wp_publish_post($entry['post_id']);
    }
    function petpetGoose_upload_all_images_to_product($product_id, $image_id_array) {    
        if(sizeof($image_id_array)) { 
            update_post_meta($product_id, '_product_image_gallery', implode(',',$image_id_array)); //set the images id's left over after the array shift as the gallery images
        }
    }
}