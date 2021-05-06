<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
/*
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
*/
?>
<?php
//Initializations carried out in wp-content\themes\ppg\singlepagecheckout\ppgsinglepagecheckout.php
//Login check should be enabled from wp admin => page with UM

//TODO: Make them compatible with Angel's components
//TODO: Place the JS codes into Angel's frontend eco
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	var params=getParams(window.location.href);
	if(typeof params['upgrade']!=='undefined'){
		var upgradeParam='&upgrade='+params['upgrade'];
	}else{
		var upgradeParam='';
	}
	if(typeof params['upgradeFrom']!=='undefined'){
		var upgradeFromParam='&upgradeFrom='+params['upgradeFrom'];
	}else{
		var upgradeFromParam='';
	}
	jQuery('input[type="radio"]').change(function(){
		window.location.href='/checkout/?add-to-cart='+jQuery(this).val()+upgradeParam+upgradeFromParam;
	});
});
var getParams = function (url) {
	var params = {};
	var parser = document.createElement('a');
	parser.href = url;
	var query = parser.search.substring(1);
	var vars = query.split('&');
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split('=');
		params[pair[0]] = decodeURIComponent(pair[1]);
	}
	return params;
};
</script>
<?php
define('basicProductId',1798); 
// define('basicProductId',1554); 
define('plusProductId',1555); 
define('professionalProductId',1556); 
//Process params/values passed by URL (e.g., /checkout/?add-to-cart=1555&upgrade=Y)
//1554 => basic, 1555 => plus, 1556 => professional on petpetgoosedev
//1. upgrade => Y/N (determines if upgrade message is shown)

//Upgrade msg block START
$upgradeFrom='';
if(isset($_GET['upgrade'])&&$_GET['upgrade']=='Y'){
	if(isset($_GET['upgradeFrom'])){
		if($_GET['upgradeFrom']=='basic'){
			$upgradeFrom='basic';
		}else{
			$upgradeFrom='plus';
		}
	}
?>
	<div id="upgrade_msg" class="mt-5 mb-5">
		<h2 class="heading heading--sm heading--secondary text--red">Meow! You have hit your limit for active pet listings.</h2>
		<p>Please upgrade your subscription level to enjoy an unlimited number of listings, more visibility and additional perks. Complete the form below.</p>
	</div>
<?php
}
//Upgrade msg block END

$prod_basic = wc_get_product( basicProductId );
$prod_plus = wc_get_product( plusProductId );
$prod_professional = wc_get_product( professionalProductId );
//Membership level block START

?>
<div id="listing_levels" class="woocommerce__listing-levels">
	<ul>
		<?php
		if(empty($upgradeFrom)){
			$subscription_ids=array(basicProductId,plusProductId,professionalProductId);
		}else if($upgradeFrom=='basic'){
			$subscription_ids=array(plusProductId,professionalProductId);
		}else if($upgradeFrom=='plus'){
			$subscription_ids=array(professionalProductId);
		}
		foreach($subscription_ids as $k=>$v){
			$subscription_product=get_post($v);
			if(isset($_GET['add-to-cart'])&&!empty($_GET['add-to-cart'])){
				$_GET['add-to-cart']==$v?$checked='checked':$checked='';
				$defaultChecked='';
			}else{
				$checked='';
				$defaultChecked='checked';
			}
		?>
		<li id="<?php echo $subscription_product->post_name;?>" class="woocommerce__listing-levels-options <?= $_GET['add-to-cart']==$v ? 'active' : ''; ?>">
			<label><?php echo $subscription_product->post_title;?></label>
			<input type='radio' name="listing_level" value="<?php echo $v;?>" <?php echo $k==0?$defaultChecked:'';?> <?php echo $checked;?> />
			<p>
				<?php echo $subscription_product->post_content;?>
			</p>
		</li>
		<?php			
		}
		?>
	</ul>
</div>
<?php
//Membership level block END
?>

<?php
	$url = $_SERVER['REQUEST_URI'];
	if( strpos($url,'1555') || strpos($url,'1556')  ): ?>

	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<?php if ( $checkout->get_checkout_fields() ) : ?>
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

		<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</form>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<?php else: ?>
	<div class="woocommerce-checkout__footer">
		<a class="btn btn--secondary" href="<?= home_url(); ?>/onboarding/breeder-details/">Back</a>
		<a class="btn btn--primary" href="<?= home_url(); ?>/onboarding/complete/">Complete Onboarding</a>
	</div>
<?php endif; ?>
