<?php
    get_header();

    global $post;
    $breeder_id = $post->post_author;
    // Fields
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

    $listing_title = get_field('listing_title');
    $listing_content = get_field('listing_content');
    $listing_price = get_field('listing_price');
    $listing_price_currency = get_field('listing_price_currency');

    $listing_image_primary = get_field('listing_primary_image');
    $listing_additional_images = get_field('listing_additional_images');
    $listing_video = get_field('listing_video');

    $listing_awards = get_field('listing_additional_select');
    $listing_text_champion_bloodline = get_field('listing_text_champion_bloodline');
    $listing_text_certified_breeder = get_field('listing_text_certified_breeder');
    $listing_text_free_shipping = get_field('listing_text_free_shipping');
    $listing_text_guaranteed_health = get_field('listing_text_guaranteed_health');

    $listing_first_name = get_user_meta( $breeder_id, 'first_name', true );
	$listing_last_name = get_user_meta( $breeder_id, 'last_name', true );
	$listing_role = get_user_meta( $breeder_id, 'breeder_role_preference', true ) ? get_user_meta( $breeder_id, 'breeder_role_preference', true ) : 'Breeder';
    $listing_city = get_user_meta( $breeder_id, 'city', true );
	$listing_state = get_user_meta( $breeder_id, 'user_state', true );
	$listing_zip = get_user_meta( $breeder_id, 'zip_code', true );
	$listing_country = get_user_meta( $breeder_id, 'country', true );
    $listing_breeder_link = get_author_posts_url( $breeder_id );
    // var_dump(  get_field('listing_primary_image') );
    // $user_msg = do_shortcode('[ultimatemember_message_button user_id="' . $breeder_id . '"]');
    $user_msg = do_shortcode('[ultimatemember_message_button user_id="'.  get_the_author_meta('ID') .'"]');

    // Related
    $related = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'listings',
        'author' => get_the_author_meta('ID'),
        'post__not_in' => array( get_the_ID() )
    ));

?>

<link itemprop="image" href="https://example.com/photos/16x9/photo.jpg" />
<meta itemprop="name" content="<?= $listing_title; ?>" />
<meta itemprop="description" content="<?= $listing_content; ?>" />

<div class="pet-listing" itemtype="http://schema.org/Product" itemscope>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="pet-listing__image">
                    <?php
                        $image_array = [];
                        if(!empty($listing_image_primary)) {
                            if(is_array($listing_image_primary)) {
                                $lip = $listing_image_primary['url'];
                            } else {
                                $lip = $listing_image_primary;
                            }
                            array_push($image_array, $lip);
                        }
                        if(!empty($listing_additional_images)) {
                            if(is_array($listing_additional_images)) {
                                $listing_additional_images_exploded = $listing_additional_images;
                            } else {
                                $listing_additional_images_exploded = explode(',', $listing_additional_images);
                            }
                            foreach($listing_additional_images_exploded as $k=>$additional_image) {
                                array_push( $image_array, $additional_image );
                            }
                        }
                        if( empty($listing_image_primary) && empty($listing_additional_images) ) {
                            array_push($image_array, get_field('pets_placeholder_image', 'option'));
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
                                    <ol class="carousel-indicators">
                                        <?php foreach($image_array as $k=>$image_url) : ?>
                                            <?php if($k > 0): ?>
                                                <li data-target="#carousel-<?= get_the_ID(); ?>" data-slide-to="<?= $k; ?>" >
                                                    <img src="<?= $image_url;?>" />
                                                </li>
                                            <?php else: ?>
                                                <li data-target="#carousel-<?= get_the_ID(); ?>" data-slide-to="<?= $k; ?>" class="active">
                                                    <img src="<?= $image_url;?>" />
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ol>
                                    
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
                </div>
            </div>
            <div class="col-md-6">
                <div class="pet-listing__title">
                    <h1><?= $listing_title; ?></h1>
                </div>
                <div class="pet-listing__price price">
                    <bdi>
                        <span class="pet-listing__currency">$</span><?= $listing_price; ?>
                    </bdi>
                </div>
                
                <div class="pet-listing__meta">
                    <ul>
                        <?php if($listing_pet_name): ?>
                            <li><label>Name:</label><?= $listing_pet_name; ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_type): ?>
                            <li><label>Type:</label><?= ucwords(str_replace('-', ' ', $listing_pet_type)); ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_breed): ?>
                            <li><label>Breed:</label><?= ucwords(str_replace('-', ' ', $listing_pet_breed)); ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_color): ?>
                            <li><label>Color:</label><?= $listing_pet_color; ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_age): ?>
                            <li><label>Age:</label><?= $listing_pet_age; ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_weight): ?>
                            <li><label>Weight:</label><?= $listing_pet_weight; ?></li>
                        <?php endif; ?>
                        <?php if($listing_pet_sex): ?>
                            <li><label>Sex:</label><?= $listing_pet_sex; ?></li>
                        <?php endif; ?>
                        <?php if($listing_city || $listing_state): ?>
                            <li><label>Location:</label><?= $listing_city; ?></span><?= $listing_city && $listing_state ? ', ' : ''; ?><?= $listing_state; ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="pet-listing__additional">
                    <?= renderListingIcons($listing_awards); ?>
                </div>
                
                <div class="pet-listing__contact profile__contact-button">
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?= $listing_breeder_link; ?>" class="btn btn--primary btn--large">Contact <?= $listing_role; ?></a>
                    <?php else : ?>
                        <p><a class="link link--secondary" href="<?= home_url(); ?>/sign-up/">Sign up</a> or <a class="link link--secondary" href="<?= home_url(); ?>/login">log in</a> to send this breeder a message.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="pet-listing__tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="pet-story-tab" data-toggle="tab" href="#pet-story" role="tab" aria-controls="pet-story" aria-selected="true">Details</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="pet-story" role="tabpanel" aria-labelledby="pet-story-tab">
                            <div class="tab-pane__block">
                                <h2 class="heading heading--md">Pet Story</h2>
                                <p><?= $listing_content; ?></p>
                            </div>
                            
                            <div class="tab-pane__block">
                                <h2 class="heading heading--md">Breeder Details</h2>
                                <ul class="tab-pane__inline-list">
                                    <li><span>Name:</span> <?= $listing_first_name . ' ' . $listing_last_name; ?></li>
                                    <li><span>Location:</span> <?= $listing_city; ?></span><?= $listing_city && $listing_state ? ', ' : ''; ?><?= $listing_state; ?> <?= $listing_zip; ?></li>
                                </ul>
                            </div>

                            <?php if($listing_awards) {
                                $la_expoded = explode(', ', $listing_awards);
                                // var_dump($la_expoded);
                            } ?>

                            <div class="tab-pane__block tab-pane__block--flex">
                                <div class="tab-pane__block-inner">
                                    <div class="breeder-details__tab-card health_guarantee">
                                        <h2>Guaranteed Health</h2>
                                        <?php if( is_array($la_expoded) ) : ?>
                                            <p><strong><?= in_array('Guaranteed Health', $la_expoded) ? 'Yes' : 'No'; ?></strong></p>
                                            <?php if( in_array('Guaranteed Health', $la_expoded) ) : ?>
                                                <h3>Guaranteed Health Details:</h3>
                                                <p><?= $listing_text_guaranteed_health; ?></p>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <p>No</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="tab-pane__block-inner">
                                    <div class="breeder-details__tab-card health_guarantee">
                                        <h2>Champion Bloodline</h2>
                                        <?php if(is_array($la_expoded)) : ?>
                                            <p><strong><?= in_array('Champion Bloodline', $la_expoded) ? 'Yes' : 'No'; ?></strong></p>
                                            <?php if( in_array('Champion Bloodline', $la_expoded) ) : ?>
                                                <h3>Champion Bloodline Details:</h3>
                                                <p><?= $listing_text_champion_bloodline; ?></p>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <p>No</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="tab-pane__block-inner">
                                    <div class="breeder-details__tab-card health_guarantee">
                                        <h2>Certified Breeder</h2>
                                        <?php if(is_array($la_expoded)) : ?>
                                            <p><strong><?= in_array('Certified Breeder', $la_expoded) ? 'Yes' : 'No'; ?></strong></p>
                                            <?php if( in_array('Certified Breeder', $la_expoded) ) : ?>
                                                <h3>Certified Breeder Details:</h3>
                                                <p><?= $listing_text_certified_breeder; ?></p>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <p>No</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="tab-pane__block-inner">
                                    <div class="breeder-details__tab-card health_guarantee">
                                        <h2>Free Shipping</h2>
                                        <?php if(is_array($la_expoded)) : ?>
                                            <p><strong><?= in_array('Free Shipping', $la_expoded) ? 'Yes' : 'No'; ?></strong></p>
                                            <?php if( in_array('Free Shipping', $la_expoded) ) : ?>
                                                <h3>Free Shipping Details:</h3>
                                                <p><?= $listing_text_free_shipping; ?></p>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <p>No</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="tab-pane__block-inner tab-pane__block-inner--full">
                                    <a href="<?= $listing_breeder_link; ?>" class="btn btn--primary btn--large">Contact <?= $listing_role; ?></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if( count($related) > 0 ): ?>
    <div class="pet-listing__related">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="heading heading--md">More from this <?= $listing_role; ?></h2>
                </div>
            </div>
            <div class="row">
                <?php foreach($related as $pet): ?>
                    <?php // FIELDS
                        $related_image = get_field('listing_primary_image', $pet->ID) ? get_field('listing_primary_image', $pet->ID) : get_field('pets_placeholder_image', 'option');
                        $related_pet_name = get_field('listing_pet_name', $pet->ID);
                        $related_link = get_the_permalink($pet->ID);
                    ?>
                    <div class="col-md-3">
                        <div class="pet-listing__related">
                            <div class="pet-listing__related-image">
                                <a href="<?= $related_link; ?>">
                                    <?php if(is_array($related_image)): ?>
                                        <img src="<?= $related_image['url']; ?>" alt="Picture of <?= $related_pet_name; ?>">
                                    <?php else: ?>
                                        <img src="<?= $related_image; ?>" alt="Picture of <?= $related_pet_name; ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="pet-listing__related-info">
                                <h3><?= $related_pet_name; ?></h3>
                                <a href="<?= $related_link; ?>">Learn more about this pet</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
</div>

<?php get_footer();