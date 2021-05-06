<?php
namespace petpetgoose\product;

//$entry elem no to human readable constants
//two processes to consider: 1. listing, 2. signup
if(preg_match('/breeder-details-listing/',$_SERVER['REQUEST_URI'])){
    define('aboutBreederDetailsFormID',24); 
}else if(preg_match('/breeder-details/',$_SERVER['REQUEST_URI'])){
    define('aboutBreederDetailsFormID',9); 
}
define('aboutBreederDetailsUsername','1'); //$entry elem id
define('aboutBreederDetailsProductId','35');
define('aboutBreederDetailsHealthGuarantee','3');
define('aboutBreederDetailsHealthGuaranteeDetails','4');
define('aboutBreederDetailsFreeShipping','5');
define('aboutBreederDetailsFreeshippingdetails','6');
define('aboutBreederDetailsArereturnsallowed','7');
define('aboutBreederDetailsReturnsdetails','8');
define('aboutBreederDetailsDoyouoffertraining','9');
define('aboutBreederDetailsTrainingdetails','10');
define('aboutBreederDetailsVaccinesShots','11');
define('aboutBreederDetailsVaccinedetails','12');
define('aboutBreederDetailsRegistrationIncluded','13');
define('aboutBreederDetailsRegistrationdetails','14');
define('aboutBreederDetailsChampion','15');
define('aboutBreederDetailsChampiondetails','16');
define('aboutBreederDetailsFacebook','20');
define('aboutBreederDetailsTwitter','22');
define('aboutBreederDetailsInstagram','23');
define('aboutBreederDetailsPinterest','24');
define('aboutBreederDetailsLinkedIn','25');

class BreederDetails{
    function __construct(){        
        //add_filter( 'gform_after_submission_'.aboutBreederDetailsFormID, array($this,'breederInfoUpdate'),10,2 );
        add_action( 'gform_after_submission_'.aboutBreederDetailsFormID, array($this,'breederInfoUpdate'),10,2 );
    }
    function breederInfoUpdate($entry, $form){
        //var_dump($entry);exit();
        update_field('health_guarantee', $entry[aboutBreederDetailsHealthGuarantee],$entry[aboutBreederDetailsProductId]);
        update_field('health_guarantee_description', $entry[aboutBreederDetailsHealthGuaranteeDetails],$entry[aboutBreederDetailsProductId]);
        update_field('free_shipping', $entry[aboutBreederDetailsFreeShipping],$entry[aboutBreederDetailsProductId]);
        update_field('free_shipping_details', $entry[aboutBreederDetailsFreeshippingdetails],$entry[aboutBreederDetailsProductId]);
        update_field('returns', $entry[aboutBreederDetailsArereturnsallowed],$entry[aboutBreederDetailsProductId]);
        update_field('returns_details', $entry[aboutBreederDetailsReturnsdetails],$entry[aboutBreederDetailsProductId]);
        update_field('training', $entry[aboutBreederDetailsDoyouoffertraining],$entry[aboutBreederDetailsProductId]);
        update_field('training_details', $entry[aboutBreederDetailsTrainingdetails],$entry[aboutBreederDetailsProductId]);
        update_field('vaccines', $entry[aboutBreederDetailsVaccinesShots],$entry[aboutBreederDetailsProductId]);
        update_field('vaccine_details', $entry[aboutBreederDetailsVaccinedetails],$entry[aboutBreederDetailsProductId]);
        update_field('registration_included', $entry[aboutBreederDetailsRegistrationIncluded],$entry[aboutBreederDetailsProductId]);
        update_field('registration_details', $entry[aboutBreederDetailsRegistrationdetails],$entry[aboutBreederDetailsProductId]);
        update_field('champion', $entry[aboutBreederDetailsChampion],$entry[aboutBreederDetailsProductId]);
        update_field('champion_details', $entry[aboutBreederDetailsChampiondetails],$entry[aboutBreederDetailsProductId]);
        update_field('facebook', $entry[aboutBreederDetailsFacebook],$entry[aboutBreederDetailsProductId]);
        update_field('twitter', $entry[aboutBreederDetailsTwitter],$entry[aboutBreederDetailsProductId]);
        update_field('instagram', $entry[aboutBreederDetailsInstagram],$entry[aboutBreederDetailsProductId]);
        update_field('pinterest', $entry[aboutBreederDetailsPinterest],$entry[aboutBreederDetailsProductId]);
        update_field('linked', $entry[aboutBreederDetailsLinkedIn],$entry[aboutBreederDetailsProductId]);

        //set attributes
        //color(About Your Pet),free-shipping,health-guarantee,pet-sub-category(About Your Pet),registration,returns,sex(About Your Pet),training,vaccine,champion
        $term_aboutBreederDetailsHealthGuarantee_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsHealthGuarantee], 'pa_health-guarantee' , false);
        $term_aboutBreederDetailsFreeShipping_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsFreeShipping], 'pa_free-shipping' , false);
        $term_aboutBreederDetailsArereturnsallowed_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsArereturnsallowed], 'pa_returns' , false);
        $term_aboutBreederDetailsDoyouoffertraining_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsDoyouoffertraining], 'pa_training' , false);
        $term_aboutBreederDetailsVaccinesShots_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsVaccinesShots], 'pa_vaccine' , false);
        $term_aboutBreederDetailsRegistrationIncluded_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsRegistrationIncluded], 'pa_registration' , false);
        $term_aboutBreederDetailsChampion_id=wp_set_object_terms( $entry[aboutBreederDetailsProductId],$entry[aboutBreederDetailsChampion], 'pa_champion' , false);

        $term_data = Array(
            'pa_free-shipping'=>Array( 
                  'name'=>'pa_free-shipping', 
                  'value'=>$entry[aboutBreederDetailsFreeShipping],
                  'is_visible' => '1',
                  'is_variation' => '1',
                  'is_taxonomy' => '1'
            ),
            'pa_health-guarantee'=>Array( 
                'name'=>'pa_health-guarantee', 
                'value'=>$entry[aboutBreederDetailsHealthGuarantee],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),            
            'pa_registration'=>Array( 
                'name'=>'pa_registration', 
                'value'=>$entry[aboutBreederDetailsRegistrationIncluded],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),
            'pa_returns'=>Array( 
                'name'=>'pa_returns', 
                'value'=>$entry[aboutBreederDetailsArereturnsallowed],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),
            'pa_training'=>Array( 
                'name'=>'pa_training', 
                'value'=>$entry[aboutBreederDetailsDoyouoffertraining],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),            
            'pa_vaccine'=>Array( 
                'name'=>'pa_vaccine', 
                'value'=>$entry[aboutBreederDetailsVaccinesShots],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            ),
            'pa_champion'=>Array( 
                'name'=>'pa_champion', 
                'value'=>$entry[aboutBreederDetailsChampion],
                'is_visible' => '1',
                'is_variation' => '1',
                'is_taxonomy' => '1'
            )                    
       );
        //From About Your Pet, there may be attributes set on the _product_attributes key.  update_post_meta will remove these previous attribtues.  
        //get these previously entered attributes and add them to $term_data array
        //pa_color,pa_sex,pa_pet-sub-category
        $prevAttributes = get_post_meta( $entry[aboutBreederDetailsProductId], '_product_attributes', true );
        $term_data_add=array();
        $breederDetailTax=array('pa_color','pa_sex','pa_pet-sub-category','pa_age','pa_weight','pa_videolink');
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
       //update_post_meta overwrites attributes created in About Your Pet
       update_post_meta( $entry[aboutBreederDetailsProductId],'_product_attributes',$term_data);
    }
}