<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$product_id = $product->get_id();
$product_link = get_permalink($product_id);
$image_array = [];
$featured_image = get_the_post_thumbnail_url($product_id);
$additional_images = get_field('additional_photos', $product_id);
$placeholder_image = get_field('pets_placeholder_image', 'option');
//$name = $product->name;
$breed = $product->get_attribute('pa_pet-sub-category');
$pet_name = get_field('pets_nickname', $product_id);
$age = get_field('age', $product_id);
if($age){
	$age == 1 ? $age=$age . ' year old' : $age . ' years old';
}
//$city = get_field('city', $product_id);
//$state = get_field('state', $product_id);
$breeder_id = get_field('pet_lister_user_id', $product_id);
um_fetch_user($breeder_id);
$breeder_name = um_user('Breeder_Name');
$city = um_user('city');
$state = um_user('State');
$breeder_url = um_user_profile_url($breeder_id);

if(!$state){
	$state=um_user('province');
}
$postal_code=um_user('zip_code');
if(!$postal_code){
	$postal_code=um_user('Postal_Code');
}
//attributes
$attr=array('champion'=>'ChampionBloodline.png',
'registration'=>'CertifiedBreeder.png',
'health-guarantee'=>'GuaranteedHealth.png',
'free-shipping'=>'FreeShipping.png');
$img_output='';
foreach($attr as $k=>$v){
	if($product->get_attribute('pa_'.$k)=='Yes'){
		$img_output.='<img src="/wp-content/themes/petPetGoose_wp-bootstrap-starter-child/img/'.$v.'">';
	}
}
$price=wc_price($product->get_price());



// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'card card--related', $product ); ?>>
	<?php

		// Product Image Carousel START
		if(!empty($featured_image)) {
			array_push($image_array, $featured_image);
		}
		if(!empty($additional_images)) {
			foreach($additional_images as $k=>$additional_image) {
				array_push( $image_array, wp_get_attachment_image_url( $additional_image['ID'], 'medium') );
			}
		}
		if( empty($featured_image) && empty($additional_images) ) {
			array_push($image_array, $placeholder_image);
		}
	?>

	<?php if(!empty($image_array)): ?>
		<div class="card__carousel">
			<div id="carousel-<?= $product->get_id(); ?>" class="carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-inner">
					<?php foreach($image_array as $k=>$image_url) : ?>
						<div class="carousel-item <?= $k ? '' : 'active'; ?>">
							<a href="<?= $product_link; ?>">
								<img src="<?= $image_url;?>" />
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if(count($image_array)!==1): ?>
					<a class="carousel-control-prev" href="#carousel-<?= $product->get_id(); ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel-<?= $product->get_id(); ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="card__meta">
		<div class="card__body">
			<div class="card__name">
				<h2 class="heading heading--lg"><a href="<?= $product_link; ?>"><?= $pet_name;?></a></h2>
			</div>
			<div class="card__info">
				<div class="card__info-breed">
					<p><?= $breed.' | '.$age; ?></p>
				</div>
				<!--
				<div class="card__info-breed">
					<p>Breeds: <?= $product->get_attribute('pa_pet-sub-category'); ?></p>
				</div>
				-->
				<div class="card__info-description">
					<p><?= wp_trim_words($product->description, 7, '...'); ?></p>
				</div>
				<?php if($breeder_name): ?>
					<div class="card__info-breeder">
						<p><strong><?= $breeder_name; ?></strong></p>
					</div>
				<?php endif; ?>			
				<?php if($city || $state): ?>
					<div class="card__info-location">
						<p><strong><?= $city; ?><?= $city && $state ? ',' : null; ?> <?= $state; ?> <?= $postal_code; ?></strong></p>
					</div>
				<?php endif; ?>
			</div>
			<div class="card__services">
				<?= $img_output; ?>
			</div>
			<div class="card__amount">
				<p><?= $price ;?></p>
			</div>
		</div>
		<div class="card__footer">
			<div class="card__footer-link">
				<a class="text--underline" href="<?= $breeder_url; ?>">More from this breeder</a>
			</div>
			<div class="card__footer-link">
				<?= get_template_part('/template-parts/social', null, ['style'=>'secondary', 'link'=> home_url() . '/breeder-profile/?bid=' . $breeder_id ]); ?>
			</div>
		</div>
	</div>
</li>
