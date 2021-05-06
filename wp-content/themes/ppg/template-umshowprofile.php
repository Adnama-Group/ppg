<?php
	/* Template Name: UM Profile */
	get_header();
	$user_bid_id = um_profile_id();
	// User
	um_fetch_user($user_bid_id);
	$user_role = um_user('role');
	$first_name = get_user_meta( $user_bid_id, 'first_name', true );
	$last_name = get_user_meta( $user_bid_id, 'last_name', true );
	$user_display_name = um_user('display_name');
	$user_photo = um_get_avatar_uri( um_profile('profile_photo'), 'original' );
	$default_user_photo = get_field('breeders_placeholder_image', 'option');
	$user_company_name = get_user_meta( $user_bid_id, 'breeder_company_name', true );
	$user_about = get_user_meta( $user_bid_id, 'About_Me', true );
	$user_about_company = get_user_meta( $user_bid_id, 'breeder_company_details', true );
	$user_fb =  get_user_meta( $user_bid_id, 'facebook', true );
	$user_tw = get_user_meta( $user_bid_id, 'twitter', true );
	$user_ig = get_user_meta( $user_bid_id, 'instagram', true );
	$user_pt = get_user_meta( $user_bid_id, 'pinterest', true );
	$user_li = get_user_meta( $user_bid_id, 'linkedin', true );
	$user_msg = do_shortcode('[ultimatemember_message_button user_id="'. $user_bid_id .'"]');
	$profile = do_shortcode('[ultimatemember form_id="1156"]');
	$user_city = get_user_meta( $user_bid_id, 'city', true );
	$user_state = get_user_meta( $user_bid_id, 'user_state', true );
	$user_zip = get_user_meta( $user_bid_id, 'zip_code', true );
	$user_country = get_user_meta( $user_bid_id, 'country', true );
	$listing_role = get_user_meta( $user_bid_id, 'breeder_role_preference', true ) ? get_user_meta( $user_bid_id, 'breeder_role_preference', true ) : 'Breeder';

	// var_dump($user_city);
	// var_dump($user_bid_id, get_current_user_id(), um_user('zip_code'));
?>

<main class="profile profile--<?= str_replace('_', '-', $user_role); ?>">
	<?php if( strpos( $user_role, 'breeder') ) : ?>
		<?php if( get_current_user_id() == $user_bid_id || current_user_can('administrator') ): ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="switch__buttons">
						<button data-switch="member" class="btn btn--secondary">Live View</button>
						<button data-switch="account" class="btn btn--secondary active">Preview</button>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div id="member" class="profile__member container <?= get_current_user_id() != $user_bid_id ? 'active' : null; ?>">
			<div class="row">
				<div class="col-md-7">
					<div class="profile__image">
						<?php
							if(strpos($user_photo, 'ultimatemember')){
								echo '<img alt="Image of ' . $first_name . ' ' . $last_name . '" src="' . $user_photo . '">';
							} else {
								echo '<img alt="Breeder has not uploaded an image" src="' . $default_user_photo . '">';
							}		
						?>
						<img style="display:none;" class="certified" src="<?= get_stylesheet_directory_uri(); ?>/img/ppg-certified-v3.svg" />
					</div>
				</div>
				<div class="col-md-5">
					<div class="profile__contact">
						<?php if( !empty($user_company_name) ): ?>
							<h1 class="heading heading--xl"><?= $user_company_name; ?></h1>
						<?php else: ?>
							<h1 class="heading heading--xl"><?= $first_name;?> <?= $last_name; ?></h1>
						<?php endif; ?>
						<p><?= $user_about_company; ?></p>
						<div class="profile__contact-button">
							<?= $user_msg; ?>
						</div>
						
						<?php if( $user_fb || $user_tw || $user_ig || $user_pt || $user_li ): ?>
						<div class="profile__social">
							<ul>
								<li>Follow <?= !empty($user_company_name) ? $user_company_name : $first_name . ' ' . $last_name; ; ?>:</li>
								<?php if($user_fb) : ?>
									<li><a href="<?= $user_fb; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<?php endif; ?>
								<?php if($user_tw) : ?>
									<li><a href="<?= $user_tw; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<?php endif; ?>
								<?php if($user_ig) : ?>
									<li><a href="<?= $user_ig; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<?php endif; ?>
								<?php if($user_pt) : ?>
									<li><a href="<?= $user_pt; ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
								<?php endif; ?>
								<?php if($user_li) : ?>
									<li><a href="<?= $user_li; ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
								<?php endif; ?>
							</ul>
						</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<div class="profile__about">
						<h2 class="heading heading--lg">About the Breeder</h2>
						<?= get_template_part('template-parts/divider', null); ?>
						<p><?= $user_about; ?></p>
						<ul class="profile__about-details">
							<li><strong>Breeder Name:</strong> <?= $first_name;?> <?= $last_name; ?></li>
							<?php //<li><strong>Breeds:</strong> echo implode(', ',$breeds);></li>?>
							<li><strong>Location: </strong> <span class="text--capitalize"><?= $user_city; ?></span><?= $user_city && $user_state ? ', ' : ''; ?><?= $user_state; ?></li>
						</ul>
						<?php
							// $breeds = array();
							// $typeofanimals = array('Dogs','Cats','horses','Birds','reptiles','small_pets','farm_life');
							// foreach($typeofanimals as $k=>$v){
							// 	$breeds = array_merge($breeds, um_user($v));
							// }
						?>
						<?php
							$awards = [];
							$awards = um_user('awards');
							if( !empty($awards) ) :
						?>
						<div class="profile__awards">
							<h2 class="heading text--uppercase">Awards &amp; Distinctions</h2>
							<figure class="wp-block-image size-large">
								<img style="width:201px;height:auto" class="wp-image-840" src="/wp-content/themes/petPetGoose_wp-bootstrap-starter-child/img/Seperator_paw_red.png" sizes="(max-width: 381px) 100vw, 381px" srcset="https://petpetgoosedev.wpengine.com/wp-content/uploads/2020/11/red_paw_lines-1.png 381w, https://petpetgoosedev.wpengine.com/wp-content/uploads/2020/11/red_paw_lines-1-300x34.png 300w" alt="" width="381" height="43">
							</figure>

							<div class="profile__awards-group">
								<?php foreach($awards as $k=>$v) : ?>
									<?php
										$tooltip = "";
										switch($v) {
											case('Certified Breeder'):
												$tooltip = "This reputable breeder has been personally vetted by the Pet Pet Goose team.";
												break;
											case('Champion Bloodline'):
												$tooltip = "This breeder has superpets from verifiable champion bloodlines. Please ask them directly for more information!";
												break;
											case('Free Shipping'):
												$tooltip = "This purr-riffic breeder offers to cover all shipping and handling costs.";
												break;
											case('Guaranteed Health'):
												$tooltip = "This breeder offers health and wellness guarantees for their little loved ones. Please inquire directly on their specific guarantees!";
												break;
											default:
												$tooltip = "";
										}
									?>
									<div class="profile__award">
										<div class="profile__award-image">
											<img src="<?= get_stylesheet_directory_uri(); ?>/img/<?= str_replace(' ','',$v); ?>.png" alt="This breeder is recognized for <?= $v; ?>" />	
										</div>
										<div class="profile__award-content">
											<strong><?= $v; ?></strong>
											<?php if( $tooltip ): ?>
											<button type="button" class="btn btn--reset" data-toggle="tooltip" data-placement="top" title="<?= $tooltip; ?>">
												<i class="fas fa-info-circle"></i>
											</button>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-5">
					<div class="profile__sign-up">
						<?= do_shortcode('[ultimatemember form_id="1025"]'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="profile__more">
						<?php
							$args = array(
								'post_type'  => 'listings',
								'post_status' => 'publish',
								'author' => $user_bid_id,
							);
							$query = new WP_Query($args);
						?>
						<div class="profile__current">
							<div class="profile__title">
								<h2 class="heading">Current Pets Available</h2>
								<?= get_template_part('template-parts/divider', null); ?>
							</div>
							<?php if ( $query->have_posts() ) : $i = 0; ?>
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<?php if($i==0): ?>
										<?php
											$listing_pet_name = get_field('listing_pet_name');
											$listing_pet_type = get_field('listing_pet_type');
											$listing_pet_age = get_field('listing_pet_age');
											$listing_pet_color = get_field('listing_pet_color');
											$listing_pet_weight = get_field('listing_pet_weight');
											$listing_pet_sex = get_field('listing_pet_sex');
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
												default:
													$listing_pet_breed = get_field('listing_other_breed');
											}
											$listing_image_primary = get_field('listing_primary_image');
											$listing_title = get_field('listing_title');
											$listing_content = get_field('listing_content');
											$listing_price = get_field('listing_price');
											$listing_price_currency = get_field('listing_price_currency');
											
										?>
										<div class="profile__current-image">
											<a href="<?php the_permalink(); ?>">
												<?php if( is_array($listing_image_primary) ):?>
													<img src="<?= $listing_image_primary['url']; ?>" alt="">
												<?php else: ?>
													<img src="<?= $listing_image_primary; ?>" alt="">
												<?php endif; ?>
											</a>
										</div>
										<div class="profile__current-info">
											<?php if($listing_pet_name): ?><p><label>Name:</label> <?= $listing_pet_name;?></p><?php endif; ?>
											<?php if($listing_pet_breed): ?><p><label>Breed:</label> <?= $listing_pet_breed;?></p><?php endif; ?>
											<?php if($listing_pet_color): ?><p><label>Color:</label> <?= $listing_pet_color;?></p><?php endif; ?>
											<?php if($listing_pet_age): ?><p><label>Age:</label> <?= $listing_pet_age;?></p><?php endif; ?>
											<?php if($listing_pet_weight): ?><p><label>Weight:</label> <?= $listing_pet_weight;?></p><?php endif; ?>
											<?php if($listing_pet_sex): ?><p><label>Sex:</label> <?= $listing_pet_sex;?></p><?php endif; ?>
										</div>
										<div class="profile__current-content">
											<h2 class="heading">Pet Story</h2>
											<?= $listing_content; ?>
										</div>
									<?php else: ?>
										<?php if($i > 1): ?>
											<div class="profile__additional mt-5">
												<div class="row">
													<div class="col-12"><h2 class="heading heading--lg">More from this <?= $listing_role; ?></h2></div>
												</div>
												<div class="row">
													<div class="col-md-4">
														<div class="pet-listing__related">
															<div class="pet-listing__related-image">
																<a href="<?php the_permalink(); ?>">
																	<?php if( is_array($listing_image_primary) ):?>
																		<img src="<?= $listing_image_primary['url']; ?>" alt="">
																	<?php else: ?>
																		<img src="<?= $listing_image_primary; ?>" alt="">
																	<?php endif; ?>
																</a>
															</div>
															<div class="pet-listing__related-info">
																<h3><?= $listing_title; ?></h3>
																<a href="<?php the_permalink(); ?>">Learn more about this pet</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								<?php $i++; endwhile; ?>
							<?php else : ?>
								<div class="row">
									<div class="col-12">
										<p class="heading heading--sm" style="color:#dc3545;">No pets are available at this time</p>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if( get_current_user_id() == $user_bid_id || current_user_can('administrator') ): ?>
		<div id="account" class="profile__account active">
			<?= $profile; ?>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<?= $profile; ?>
	<?php endif; ?>
</main>

<?php get_footer();