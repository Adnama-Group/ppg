<?php
define('prodIdPro',1556);
define('prodIdPlus',1555);
// define('prodIdBasic',1554);
define('prodIdBasic',1798);
// /checkout/?add-to-cart=1108 for example removes all other items in cart 
// just in case bugs/loopholes allowed other products to be in a cart
add_filter( 'woocommerce_add_to_cart_validation', 'ppg_remove_cart_item_before_add_to_cart', 20, 3 );
function ppg_remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {
    if( ! WC()->cart->is_empty() )
        WC()->cart->empty_cart();
    return $passed;
}
//remove unnecessary fields
add_filter( 'woocommerce_checkout_fields' , 'ppg_custom_override_checkout_fields',100,1 );
function ppg_custom_override_checkout_fields( $fields ) {
     unset($fields['order']['order_comments']);
     unset($fields['billing']['billing_company']);

     return $fields;
}
//prepopulate fields
//TODO: bring in UM fields as needed.  Since checkout page is accessible only after login, many more fields should be available.
add_filter('woocommerce_checkout_get_value', 'ppg_prefill_checkout_fields', 10, 2);
function ppg_prefill_checkout_fields($input, $key ) {
    global $current_user;
    switch ($key) :
        case 'billing_first_name':
        case 'shipping_first_name':
            return $current_user->first_name;
        break;

        case 'billing_last_name':
        case 'shipping_last_name':
            return $current_user->last_name;
        break;
        case 'billing_email':
            return $current_user->user_email;
        break;
        case 'billing_phone':
            return $current_user->phone;
        break;
    endswitch;
}
//remove view cart, added to cart woocommerce notices
add_filter( 'wc_add_to_cart_message', 'ppg_remove_add_to_cart_message' );
function ppg_remove_add_to_cart_message() {
    return;
}
//remove coupon
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 
// Removes Order Notes Title - Additional Information & Notes Field
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
//after successful payment, 
// 1. remove all roles and assign um_breeder-plus, um_breeder-pro
// 2. redirect to custom URL 
add_action( 'woocommerce_thankyou', 'ppg_postpaymentprocessing');
function ppg_postpaymentprocessing( $order_id ){
    global $wpdb;
    $order = wc_get_order( $order_id );
    $prodRoleArr=array(prodIdPro=>'um_breeder-pro',
        prodIdPlus=>'um_breeder-plus',
        prodIdBasic=>'um_breeder');
    $items = $order->get_items();
    foreach ( $items as $item ) {
        $product_id = $item->get_product_id();
    }
    $user = $order->get_user();
    if( $user ){
        $existingRoles=$user->roles;
        foreach($existingRoles as $k=>$v){
            $user->remove_role($v);
        }
        $user->add_role($prodRoleArr[$product_id]);
    }
    //get all subscriptions by the user
    /*When a subscription order is received
    1. Regular post is created.  post_type='shop_order'
    2. Then a subscription is created.  It is a post with a parent_post of the regular post created in 1 with post_type=shop_subscription.
    3. Thereafter, for every renewal, an additional post is created with the same parent_post, the post created in 1
    4. Select all subscription post IDs of the user
    */
    /* if $subscription->update_status('cancelled'); were to be used
    $q="select * from {$wpdb->prefix}posts wp 
    inner join {$wpdb->prefix}postmeta wpm on wp.ID=wpm.post_id
    where wpm.meta_key='_customer_user' and wpm.meta_value={$user->id} and wp.post_parent>0 and wp.post_type='shop_subscription'";
    */
    $q="select * from {$wpdb->prefix}posts wp 
    inner join {$wpdb->prefix}postmeta wpm on wp.ID=wpm.post_id
    where wpm.meta_key='_customer_user' and wpm.meta_value={$user->id} and wp.post_parent=0 and wp.post_type='shop_order'";

    $result = $wpdb->get_results( $q, ARRAY_A);
    foreach($result as $k=>$v)    
    {
        //cancel all except for the subscription post of the current order
        //Subscription post IDs of the previous orders is smaller than the post ID of the current order
        if($v['ID']<$order_id){ 
            $subscription = new WC_Subscription( $v['ID'] );
            if(!empty($subscription)){
                //$subscription->update_status('cancelled');
                WC_Subscriptions_Manager::cancel_subscriptions_for_order($v['ID'] );
                //unset($subscription);
            }
        }
    }

    $url = '/onboarding/complete/';
    if ( ! $order->has_status( 'failed' ) ) {
        wp_safe_redirect( $url );
        exit;
    }
}
//make cart page inaccessible
if(preg_match('/\/cart\//',$_SERVER['REQUEST_URI'])){
    $checkout_url="/checkout/?add-to-cart=".prodIdPro;
    wp_redirect( $checkout_url );
    exit;
}