<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $query->have_posts() )
{
	?>
	
	<div class="row">
		<div class="col-12">
			<p>Found <?php echo $query->found_posts; ?> Results</p>
			<hr>
			<?php /*
				Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?>
			*/?>
		</div>
	</div>

	<div class="row">
		<?php while ($query->have_posts()) { $query->the_post(); ?>
			<?php
				//Fields
				$breeder_id = get_the_author_meta('ID');
				$image_array = [];
				$featured_image = get_field('listing_primary_image');
				$additional_images = get_field('listing_additional_images');
				$placeholder_image = get_field('pets_placeholder_image', 'option');
				$listing_pet_type = get_field('listing_pet_type');
				$listing_awards = get_field('listing_additional_select');
				$listing_pet_breed = '';
				switch($listing_pet_type) {
					case 'dogs':
						$listing_pet_breed = get_field('listing_dog_breed');
						break;
					case 'cats':
						$listing_pet_breed = get_field('listing_cat_breed');
						break;
					case 'birds':
						$listing_pet_breed = get_field('listing_bird_breed');
						break;
					case 'horses':
						$listing_pet_breed = get_field('listing_horse_breed');
						break;
					case 'reptiles':
						$listing_pet_breed = get_field('listing_reptile_breed');
						break;
					case 'small-pets':
						$listing_pet_breed = get_field('listing_small_pet_breed');
						break;
					case 'farm-life':
						$listing_pet_breed = get_field('listing_farm_life_breed');
						break;
					case 'other':
						$listing_pet_breed = get_field('listing_other_breed');
						break;
				}
				$listing_city = get_user_meta( $breeder_id, 'city', true );
				$listing_state = get_user_meta( $breeder_id, 'user_state', true );
				$listing_breeder_link = get_author_posts_url( $breeder_id );
			?>
			<div class="col-md-6 mb-5">
				<div class="card">
					<?php
						// Product Image Carousel START
						if(!empty($featured_image)) {
							if(is_array($featured_image)) {
                                $lip = $featured_image['url'];
                            } else {
                                $lip = $featured_image;
                            }
							array_push($image_array, $lip);
						}
						if(!empty($additional_images)) {
							if(is_array($additional_images)) {
                                $listing_additional_images_exploded = $additional_images;
                            } else {
                                $listing_additional_images_exploded = explode(',', $additional_images);
                            }
							foreach($listing_additional_images_exploded as $k=>$additional_image) {
								array_push( $image_array, $additional_image );
							}
						}
						if( empty($featured_image) && empty($additional_images) ) {
							array_push($image_array, $placeholder_image);
						}
					?>

					<?php if(!empty($image_array)): ?>
						<div class="card__carousel">
							<div id="carousel-<?= get_the_ID(); ?>" class="carousel slide" data-ride="carousel" data-interval="false">
								<div class="carousel-inner">
									<?php foreach($image_array as $k=>$image_url) : ?>
										<div class="carousel-item <?= $k ? '' : 'active'; ?>">
											<a href="<?= get_the_permalink(); ?>">
												<img src="<?= $image_url;?>" />
											</a>
										</div>
									<?php endforeach; ?>
								</div>
								<?php if(count($image_array)!==1): ?>
									<a class="carousel-control-prev" href="#carousel-<?= get_the_ID(); ?>" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carousel-<?= get_the_ID(); ?>" role="button" data-slide="next">
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
								<h2 class="heading heading--lg"><a href="<?= get_the_permalink(); ?>"><?= get_field('listing_pet_name'); ?></a></h2>
							</div>
							<div class="card__info">
								<div class="card__info-breed">
									<p style="margin:0; text-transform: capitalize;"><?= $listing_pet_type . ' - ' . $listing_pet_breed;?></p>
									<?php if(get_field('listing_pet_age') > 0) : ?>
										<p style="margin:0"><?= get_field('listing_pet_age');?> years old</p>
									<?php else: ?>
										<p style="margin:0">Under 1 years old</p>
									<?php endif; ?>
								</div>
								<!--
								<div class="card__info-breed">
									<p>Breeds: <?php //= $product->get_attribute('pa_pet-sub-category'); ?></p>
								</div>
								-->
								<div class="card__info-description">
									<p><?= wp_trim_words( get_field('listing_content'), 7, '...'); ?></p>
								</div>
								<?php if($breeder_name = get_the_author_meta('first_name') ): ?>
									<div class="card__info-breeder">
										<p><strong><?= $listing_city; ?></span><?= $listing_city && $listing_state ? ', ' : ''; ?><?= $listing_state; ?></strong></p>
									</div>
								<?php endif; ?>	
							</div>
							<div class="card__services">
								<?= renderListingIcons($listing_awards); ?>
							</div>
						</div>
						<div class="card__footer">
							<div class="card__amount">
								<p>$<?= get_field('listing_price') ;?> <small style="font-size: 10px;"><?= get_field('listing_price_currency') ;?></small></p>
							</div>
							<div class="card__footer-link">
								<a class="text--underline" href="<?= $listing_breeder_link; ?>">More from this breeder</a>
							</div>
							<!-- <div class="card__footer-link">
								<?php //= get_template_part('/template-parts/social', null, ['style'=>'secondary', 'link'=> home_url() . '/breeder-profile/?bid=' . $breeder_id ]); ?>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-12">
			<hr>
			<?php /*<p class="text-center">Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?></p>*/ ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="pagination">
				<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links(array(
						// 'base' => '/stories/' . '%_%' . '#archive_1',
						'format' => 'page/%#%/',
						'prev_next' => false,
						'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'my-text-domain') . '</span> ',
						'current' => $query->query['paged'],
						'total' => $query->max_num_pages
					));
				?>
				<?php /*  if ($query->max_num_pages > 1) : ?>
					<?php if ($query->query['paged'] < $query->max_num_pages) : ?>
						<a href="<?= home_url(); ?>/search-pets/?sf_paged=<?= $query->query['paged']; ?>" aria-label="Next results page">
							<svg width="11px" height="27px" viewBox="0 0 11 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="SPRINT-02" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="STORIES" transform="translate(-830.000000, -3407.000000)" fill="#550200">
										<polygon id="Triangle-Copy-2" transform="translate(835.500000, 3420.500000) scale(1, -1) rotate(-270.000000) translate(-835.500000, -3420.500000) " points="835.5 3415 849 3426 822 3426"></polygon>
									</g>
								</g>
							</svg>
						</a>
					<?php else : ?>
						<span class="faded">
							<svg width="11px" height="27px" viewBox="0 0 11 27" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="SPRINT-02" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="STORIES" transform="translate(-830.000000, -3407.000000)" fill="#550200">
										<polygon id="Triangle-Copy-2" transform="translate(835.500000, 3420.500000) scale(1, -1) rotate(-270.000000) translate(-835.500000, -3420.500000) " points="835.5 3415 849 3426 822 3426"></polygon>
									</g>
								</g>
							</svg>
						</span>
					<?php endif; ?>
				<?php endif; */ ?>
			</div>
		</div>
	</div>
	
	<?php
}
else
{
	echo get_field('no_results_content','option');
}
?>