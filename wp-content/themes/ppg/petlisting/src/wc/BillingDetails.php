<?php
namespace nyulawlms\wc;

class BillingDetails{

    public function __construct()
    {
        add_filter( 'woocommerce_billing_fields' , array($this,'unreqBillingPersonFields'),10,1);
        add_filter( 'woocommerce_default_address_fields' , array($this,'unreqBillingAddressFields'),10,1);
        add_filter( 'woocommerce_checkout_fields', array($this,'emailFirst') );

        //add_action('woocommerce_checkout_update_order_review', array($this,'getCartInfo'));
        add_action('woocommerce_before_checkout_billing_form', array($this, 'getCartInfo'));

    }
    public function unreqBillingPersonFields($fields){
        $fields['billing_first_name']['required']=false;
        $fields['billing_last_name']['required']=false;
        $fields['billing_company']['required']=false;
        $fields['billing_address_1']['required']=false;
        $fields['billing_address_2']['required']=false;
        $fields['billing_city']['required']=false;
        $fields['billing_postcode']['required']=false;
        $fields['billing_country']['required']=false;
        $fields['billing_state']['required']=false;
        $fields['billing_phone']['required']=false;
        //$fields['billing_email']['required']=false;
        return $fields;
    }
    public function unreqBillingAddressFields($fields){
        $fields['address_1']['required'] = false;
        $fields['city']['required'] = false;
        $fields['postcode']['required'] = false;
        $fields['state']['required'] = false;
        return $fields;
    }
    public function emailFirst($fields){
        $fields['billing']['billing_email']['priority'] = 4;
	return $fields;
    }
    public function removeDuringCheckout($fields){ //if don't want to show fields at all (as opposed to showing them as optional)
        unset($fields['billing']['billing_first_name']);
        unset($fields['billing']['billing_last_name']);
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_state']);
        unset($fields['billing']['billing_phone']);
        unset($fields['order']['order_comments']);
        //unset($fields['billing']['billing_email']);
        //unset($fields['account']['account_username']);
        //unset($fields['account']['account_password']);
        //unset($fields['account']['account_password-2']);
        return $fields;
    }
    public function getCartInfo( $posted_data) {

        global $woocommerce;
    
        // Parsing posted data on checkout
        $post = array();
        $vars = explode('&', $posted_data);
        foreach ($vars as $k => $value){
            $v = explode('=', urldecode($value));
            $post[$v[0]] = $v[1];
        }

        // Here we collect chosen payment method
        $payment_method = $post['payment_method'];
    
        // Run custom code for each specific payment option selected
        if ($payment_method == "paypal") {
            // Your code goes here
        }
    
        elseif ($payment_method == "bacs") {
            // Your code goes here
        }
    
        elseif ($payment_method == "stripe") {
            // Your code goes here
        }

        $cart = $woocommerce->cart;
    // Will get you cart object
    $cart_total = $woocommerce->cart->get_cart_total();
    //echo $cart_total;
    }
    
}
?>