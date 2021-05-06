<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$product_id = $product->ID;
$breeder_id = get_field('pet_lister_user_id', $product_id);
$pet_name = get_field('pets_nickname');
$pet_dog_breed = get_field('dog_breed');
$pet_color = get_field('dog_color');
$pet_sex = get_field('sex');
$pet_weight = get_field('weight');
$pet_age = get_field('age');
$user_msg = do_shortcode('[ultimatemember_message_button user_id="'.$breeder_id.'"]');

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
	<div class="pet-details">
		<ul>
		<?php if($pet_name): ?>
			<li><label>Name:</label> <?= $pet_name; ?></li>
		<?php endif; ?>
		<?php if($pet_dog_breed): ?>
			<li><label>Breed:</label> <?= $pet_dog_breed; ?></li>
		<?php endif; ?>
		<?php if($pet_color): ?>
			<li><label>Color:</label> <?= $pet_color; ?></li>
		<?php endif; ?>
		<?php if($pet_age): ?>
			<li><label>Age:</label> <?= $pet_age; ?></li>
		<?php endif; ?>
		<?php if($pet_weight): ?>
			<li><label>Weight:</label> <?= $pet_weight; ?></li>
		<?php endif; ?>
		<?php if($pet_sex): ?>
			<li><label>Sex:</label> <?= $pet_sex; ?></li>
		<?php endif; ?>
		</ul>
	</div>

	<div class="profile__contact-button profile__contact-button--woo">
		<?php if ( is_user_logged_in() ) : ?>
			<?= $user_msg; ?>
		<?php else : ?>
			<p><a class="link link--secondary" href="<?= home_url(); ?>/sign-up/">Sign up</a> or <a class="link link--secondary" href="<?= home_url(); ?>/login">log in</a> to send this breeder a message.</p>
		<?php endif; ?>
	</div>

</div>
