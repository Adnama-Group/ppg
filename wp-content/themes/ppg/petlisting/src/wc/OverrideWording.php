<?php
namespace nyulawlms\wc;

class OverrideWording{
    public function __construct(){
        add_filter( 'gettext', array($this,'overrideWording'), 999, 3 );
    }
  
    function overrideWording( $translated, $untranslated, $domain ) {
     
       if ( ! is_admin() && 'woocommerce' === $domain ) {
     
          switch ( $translated) {
             case 'Place order' :
                $translated = 'Enroll';
                break;
             case 'Billing details' :
                $translated = 'Your info';
                break;
            case 'Order details' :
               $translated = 'Enrollment details';
            break;      
            case 'Billing address' :
               $translated = 'Your address';
            break;                         
            case 'Product':
                $translated='Course';
                break;
            case 'Your order':
                $translated='Your enrollment';
                break;
             // ETC
           
          }
     
       }   
      
       return $translated;
     
    }
}
?>