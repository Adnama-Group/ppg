<?php
namespace nyulawlms\wc;

class AddToCartLinkCustom{
    private $product;
    function __construct()
    {
        global $product;

        $this->product=$product;
        // Replacing the single product button add to cart by a custom button
        add_action( 'woocommerce_single_product_summary', array($this,'replace_single_add_to_cart_button'), 1 );
        // Replacing the button add to cart in Shop and archives pages
        add_filter( 'woocommerce_loop_add_to_cart_link', array($this,'replace_loop_add_to_cart_button'), 10, 2 );
    }

    // The custom replacement button function
    function custom_product_button_enrolled(){
        global $NyuLawLMSCourseCourse;
        global $product;
        // HERE your custom button text and link
        $button_text = __( "Take Course", "woocommerce" );
        $button_link = '#';

        // Display button
        echo '<a class="button" href="'.$NyuLawLMSCourseCourse->link_to_dlor_iframe_by_product_id($product->id).'">' . $button_text . '</a>';
    }
    function custom_product_button_notenrolled(){
        
        // HERE your custom button text and link
        $button_text = __( "Enroll", "woocommerce" );
        $button_link = '#';
        global $product;
            //two different behavior depending on login status
            //TODO: 1. if logged in, go to the checkout (enroll confirmation) page
            //2. if not logged in, go to login page
            if(is_user_logged_in()){
                echo '<a class="button" href="'.site_url().'/?add-to-cart='.$product->id.'">'.$button_text.'</a>';
            }else{
               // echo '<a class="button" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'?add-to-cart='.$this->product->id.'">' . $button_text . '</a>';
                echo '<a class="button" href="'.site_url().'/?add-to-cart='.$product->id.'&addToCartFirst=Y">'. $button_text . '</a>';
            }
    }
    function replace_single_add_to_cart_button() {
        global $product;
        global $NyuLawLMSCourseEnrolled;
        if($NyuLawLMSCourseEnrolled->enrolled($product->id)){
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            add_action( 'woocommerce_single_product_summary', $this->custom_product_button_enrolled(), 30 );
        }else{
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            add_action( 'woocommerce_single_product_summary', $this->custom_product_button_notenrolled(), 30 );
        }
    }

    function replace_loop_add_to_cart_button( $button, $product  ) {    
        global $NyuLawLMSCourseEnrolled;
        if($NyuLawLMSCourseEnrolled->enrolled($product->get_id())){
            global $NyuLawLMSCourseCourse;
            $button_text = __( "Take Course", "woocommerce" );
            $button = '<a class="button" href="' . $NyuLawLMSCourseCourse->link_to_dlor_iframe_by_product_id($product->id). '">' . $button_text . '</a>';
        }else{
            $button_text = __( "Enroll", "woocommerce" );
            //two different behavior depending on login status
            //TODO: 1. if logged in, go to the checkout (enroll confirmation) page
            //2. if not logged in, go to login page
            if(is_user_logged_in()){
                $button = '<a class="button" href="'.site_url().'/?add-to-cart='.$product->id.'">'.$button_text.'</a>';
            }else
            {
                //$button = '<a class="button" href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '?add-to-cart='.$product->id.'">' . $button_text . '</a>';
                $button = '<a class="button" href="'.site_url().'/?add-to-cart='.$product->id.'&addToCartFirst=Y">'.$button_text.'</a>';
            }
        }

        return $button;
    }
}
?>