<?php
namespace nyulawlms\wc;

class DirectCheckout{ //this class kicks in when there is '?add-to-cart=123' GET param
    private $product_id;
    function __construct()
    {
        
        if((isset($_GET['add-to-cart'])&&!empty($_GET['add-to-cart'])&&is_numeric($_GET['add-to-cart']))||(isset($_GET['addToCartFirst'])&&$_GET['addToCartFirst']=='Y')) // ?add-to-cart=177
        {
            //because of ?add-to-cart=177 in the URL, the item is added to cart and then redirect is set to checkout
            add_filter('woocommerce_add_to_cart_redirect', array($this,'directCheckoutSingleProduct'));
            $this->product_id=$_GET['add-to-cart'];
        }else if(isset($_GET['added-to-cart'])&&!empty($_GET['added-to-cart'])&&is_numeric($_GET['added-to-cart'])&&isset($_POST['woocommerce-login-nonce'])&&!empty($_POST['woocommerce-login-nonce'])){ //came from enroll click as an unlogged in user.
            //first clicked "enroll" not logged in => the course added to cart behind the scene => forwarded to login page => logged in => redirect based on the login redirect set in the below filter
            //header('location:'.get_permalink( get_option( 'woocommerce_myaccount_page_id' ))); //redirect before it goes into the account page
            add_filter( 'woocommerce_login_redirect', array($this,'login_redirect_after_enroll_then_login' ));
            $this->product_id=$_GET['added-to-cart'];
        }else if(isset($_GET['empty_cart_product_id'])&&!empty($_GET['empty_cart_product_id'])&&is_numeric($_GET['empty_cart_product_id'])) //reached checkout page after clicking enroll for a course already enrolled that results in empty cart
        {
            $this->product_id=$_GET['empty_cart_product_id'];
            //add_filter( 'woocommerce_checkout_redirect_empty_cart', '__return_false' ); //for any reason, if the cart is empty, do not redirect to /cart page with the empty cart msg which is default woocommerce
            add_filter( 'woocommerce_checkout_redirect_empty_cart', array($this,'emptyCartRedirectionToAccount') ); //for any reason, if the cart is empty, do not redirect to /cart page with the empty cart msg which is default woocommerce
 
        }
       $this->enqueue();
    }
    private function enqueue(){
        wp_enqueue_style(
            'nyulawlms-styleRegular-css', // Handle.
            plugins_url( '../css/styleRegular.css', dirname( __FILE__ ) ),
            array( 'wp-editor' )
        );      
    }
    /*
    cases when a product link (Enroll, Take Course) is clicked.
    1. Logged in and click
        a. Enroll (so it's course the logged in user has not already enrolled)
            Go to the checkout page with the clicked course being processed
            Don't ask for any of the billing information.  Just the "Enroll" button.
        b. Take Course: takes the user to the course lesson page
    2. Not logged in and click
        a. Enroll
            Redirect to login page
            Once logged in, redirect to the checkout page with the clicked course being processed
            Don't ask for any of the billing information.  Just the "Enroll" button.
        b. Take Course: this link should not be available to anyone who has not logged in
    */

     //Process the product to checkout (so equivalent to "add to cart" and then "proceed to checkout")
    public function directCheckoutSingleProduct($url){
        if( is_user_logged_in()){ //when is_user_logged_in() is called within member function, and not as a part of a callable in filter or hook, not found error is encounted (namespace issue)
            //button: https://localhost/lms/?add-to-cart=177
            $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
        }else{
            $url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ).'?added-to-cart='.$_GET['add-to-cart']; 
            //button: https://localhost/lms/index.php/?add-to-cart=177&addToCartFirst=Y
           // $url = 'https://localhost/lms/index.php/account/?added-to-cart='.$_GET['add-to-cart']; 
        }
        return $url;
    }
    public function login_redirect_after_enroll_then_login($redirect, $user=''){ //when cart is not empty.  when it's empty, from constructor, emptyCartRedirectionToAccount below kicks in
        $url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ).'/?empty_cart_product_id='.$this->product_id;
         
        //return 'https://localhost/lms/index.php/checkout';
        return $url;
    }
    public function emptyCartRedirectionToAccount(){
        global $NyuLawLMSCourseCourse;
        wc_add_notice( __( 'You have already enrolled in the course.', 'woocommerce' ), 'notice' );
        //echo $this->product_id.' '.$NyuLawLMSCourseCourse->link_to_dlor_iframe_by_product_id($this->product_id);exit();
        //header('location:'.get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ));
        header('location:'.$NyuLawLMSCourseCourse->link_to_dlor_iframe_by_product_id($this->product_id));
        exit();
    }
}
?>