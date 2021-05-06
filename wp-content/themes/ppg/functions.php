<?php
/* um specific functions */
// require_once(get_stylesheet_directory().'/um-functions.php');
// require_once(get_stylesheet_directory().'/um-functions-member-directory.php');

//social login redirect inconsistency fix
// require_once(get_stylesheet_directory().'/breeder_acl.php');

//petlisting
// require_once(get_stylesheet_directory().'/petlisting/petpetgoose.php');
require_once(get_stylesheet_directory().'/singlepagecheckout/ppgsinglepagecheckout.php');

// Helpers
require get_template_directory() . '/inc/helpers.php';

// ACTIONS
add_action( 'after_setup_theme', 'ppg_theme_support' );
add_action( 'after_setup_theme', 'ppg_nav_menus', 0 );
add_action( 'wp_enqueue_scripts', 'ppg_styles' );
add_action( 'get_footer', 'ppg_scripts' );
add_action( 'admin_menu', 'remove_from_admin_menus' );
add_action( 'um_members_after_user_name', 'member_buttons', 10, 2 );
add_action( 'wp_print_footer_scripts', 'um_remove_scripts_and_styles', 9 );
add_action( 'wp_print_scripts', 'um_remove_scripts_and_styles', 9 );
add_action( 'wp_print_styles', 'um_remove_scripts_and_styles', 9 );
add_action( 'dynamic_sidebar', 'um_remove_scripts_and_styles_widget' );
// add_action( 'get_delete_post_link', 'redirect_after_trashing_listing', 10 );
// add_action( 'gform_after_submission', 'iss_gf_after_submission', 10, 2 );
// add_action('init', 'remove_comment_support', 100);
// add_action( 'wp_print_scripts', 'petpetgoose_dequeue' );
// add_action( 'um_profile_before_header', 'my_profile_before_header', 10, 1 );
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// FILTERS
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
//add_filter( 'woocommerce_is_purchasable', '__return_false'); // empty ADD TO CART and QUANTITY FIELD from all product detail page
add_filter( 'woocommerce_get_stock_html', '__return_empty_string', 10, 2 ); // put READ MORE on all products on all listing
add_filter( 'nav_menu_link_attributes','petpetgoose_override_main_menu_sharp',10,4);
add_filter( 'rpwwt_categories_petpetGoose','petpetgoose_override_rpwwt_categories',10,1);
add_filter( 'upload_mimes', 'cc_mime_types');
add_filter( 'gform_pre_submission_filter', 'dw_show_confirmation_and_form' );
add_filter( 'rest_prepare_listings', 'acf_to_rest_api', 10, 3);



// FUNCTIONS
function woof_show_btn($autosubmit = 1, $ajax_redraw = 0)  {
    ?>
    <div class="woof_submit_search_form_container">

        <?php
        global $WOOF;
        if ($WOOF->is_isset_in_request_data($WOOF->get_swoof_search_slug()) OR ( class_exists("WOOF_EXT_TURBO_MODE") AND isset($WOOF->settings["woof_turbo_mode"]["enable"]) AND $WOOF->settings["woof_turbo_mode"]["enable"] )): global $woof_link;
            ?>

            <?php
            $woof_reset_btn_txt = '';
            if (empty($woof_reset_btn_txt)) {
                $woof_reset_btn_txt = __('Reset', 'woocommerce-products-filter');
            }
            $woof_reset_btn_txt = WOOF_HELPER::wpml_translate(null, $woof_reset_btn_txt);
            ?>

            <?php if ($woof_reset_btn_txt != 'none'): ?>
                <button  class="button woof_reset_search_form" data-link="<?php echo $woof_link ?>"><?php echo $woof_reset_btn_txt ?></button>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!$autosubmit OR $ajax_redraw): ?>
            <?php
            $woof_filter_btn_txt = '';
            if (empty($woof_filter_btn_txt)) {
                $woof_filter_btn_txt = __('Filter', 'woocommerce-products-filter');
            }

            $woof_filter_btn_txt = WOOF_HELPER::wpml_translate(null, $woof_filter_btn_txt);
            ?>
            <button style="float: left;" class="button woof_submit_search_form"><?php echo $woof_filter_btn_txt ?></button>
        <?php endif; ?>
    </div>
    <?php
}

function get_user_role( $user = null ) {
    $user = $user ? new WP_User( $user ) : wp_get_current_user();
    return $user->roles ? $user->roles[0] : '';
}

/*
Add classes to breeder-profile page which is the public access page of UM profile page
*/
// if(preg_match('/\/breeder-profile\//',$_SERVER['REQUEST_URI'])){
//     add_filter( 'body_class','petpetGoose_breeder_profile_body_classes' );
//     function petpetGoose_breeder_profile_body_classes( $classes ) {
//         //body.um-own-profile.um-page-user h1, body.um-own-profile.um-page-user h2, body.um-own-profile.um-page-user h3
//         $classes[] = 'um-own-profile';
//         $classes[] = 'um-page-user';
        
//         return $classes;
        
//     }
// }
//single product page tabs


function member_buttons( $user_id, $args ){
    return 'boom';
}

// Remove product data tabs
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}

// Add a custom product data tab
function woo_new_product_tab( $tabs ) {
	// Adds the new tab
	$tabs['pet_story'] = array(
		'title' 	=> __( 'Pet Story', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'pet_story_product_tab_content'
    );
    $tabs['test_tab2'] = array(
		'title' 	=> __( 'Breeder Details', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'breeder_details_product_tab_content2'
	);
	return $tabs;
}

function pet_story_product_tab_content() {
    wc_get_template( 'single-product/tabs/pet-story.php' );	
}

function breeder_details_product_tab_content2() {
    wc_get_template( 'single-product/tabs/breeder-details.php' );
}

function ppg_theme_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support('post-thumbnails', ['post']);
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

function remove_from_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

function ppg_nav_menus(){
    register_nav_menus(
        array(
            'header_menu' => __( 'Header Menu' ),
            'pets_header_menu'  => __( 'Pets Header Menu' ),
        )
    );
}

function ppg_styles() {
    wp_enqueue_style( 'ppg', get_stylesheet_directory_uri() . '/dist/app.min.css', [], filemtime(get_template_directory() . '/dist/app.min.css') );
};

function ppg_scripts() {
    // wp_enqueue_script( 'jquer-js', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array(), '', false );
    wp_enqueue_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array(), '', false );
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array( 'jquery' ), '', false );
    // wp_enqueue_script( 'app-js', get_stylesheet_directory_uri().'/dist/app.js', array(), '', false );
    wp_enqueue_script('app-js', get_template_directory_uri() . '/dist/app.js', [], filemtime(get_template_directory() . '/dist/app.js'), true);
    wp_enqueue_script('listings', get_template_directory_uri() . '/build/index.js', ['wp-element'], filemtime(get_template_directory() . '/build/index.js'), true);

    // wp_enqueue_script( 'app-js-map', get_stylesheet_directory_uri().'/dist/app.js.map', array(), '', false );
    // wp_enqueue_script( 'ppg-js', get_stylesheet_directory_uri().'/dist/ppg.min.js', array(), '', false );
    // wp_enqueue_script( 'ppg-js-map', get_stylesheet_directory_uri().'/dist/ppg.min.js.map', array(), '', false );
    // wp_enqueue_script( 'cookies-js', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array(), '', false);
    //for um member directory (breeders-search), dequeue UM's default JS and enqueue petpetgoose custom
    //the purpose is to modify breeders-search (um member directory) without editing UM core files
    // if(preg_match('/breeders-search/',$_SERVER['REQUEST_URI'])){
    //     wp_enqueue_script( 'petpetummemberdirectory',get_stylesheet_directory_uri().'/petpetgoose-um-members.js',array( 'jquery', 'wp-util', 'jquery-ui-slider', 'um_dropdown', 'wp-hooks', 'jquery-masonry', 'um_scripts' ), ultimatemember_version, true );
    // }
};

function petpetgoose_dequeue(){
    //for um member directory (breeders-search), dequeue UM's default JS and enqueue petpetgoose custom
    if(preg_match('/breeders-search/',$_SERVER['REQUEST_URI'])){
        wp_dequeue_script( 'um_members' );
        wp_deregister_script( 'um_members' );
    }
}

/*
In WP bootstrap starter, top menu with dropdonws (sub menus) defaults to href='#' even if the top menu has a proper link.  
Override this and make the top menu link persist
Filter available for this: 
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
which is line 209 of themes/wp-bootstrap-starter/inc/wp_bootstrap_navwalker.php
*/
function petpetgoose_override_main_menu_sharp($atts, $item, $args, $depth){
    if($atts['href']=='#'){
        $atts['href']=$item->url;
        $atts['data-toggle']   = '';
    }
    return $atts;
}
/* 
resources landing right side bar categories texts to colored codes (e.g., "HEALTH & SAFETY", "RESEARCH", etc.)

post categories: obtained from https://harborsocial.wpengine.com/wp-admin/post.php?post=153&action=edit
by clicking "Section settings" icon (gear icon) next to "Blog"
1. Pet Planning ("Research" on front end)
2. Pet Care ("Health and safety")
3. Lifestyle
4. Pet Products
*/
function petpetgoose_override_rpwwt_categories($string){
    $output='';
    if(preg_match('/pet planning/i',$string)){
        $output.='<span class="research">PET PLANNING</span>';
    }else if(preg_match('/pet care/i',$string)){
        $output.='<span class="health_safety">HEALTH & SAFETY</span>';
    }else if(preg_match('/lifestyle/i',$string)){
        $output.='<span class="lifestyle">LIFESTYLE</span>';
    }else if(preg_match('/pet products/i',$string)){
        $output.='<span class="pet_products">PET PRODUCTS</span>';
    }else{
        $output=$string;
    }
    return $output;
}

/* get resources category by post id
"Resources" are posts in the following categories
1. ID: 8 => Pet Planning ("Research" on front end)
2. ID: 17 => Pet Care ("Health and safety")
3. ID: 20 => Lifestyle
4. ID: 562 => Pet Products
*/
function getResourceCategory($post_id){
    //if resource category is specified in URL
    if(preg_match('/\/pet-planning\//',$_SERVER['REQUEST_URI'])){
        return "Pet Planning";
    }else if(preg_match('/\/health-and-safety\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
        return "Health and Safety";
    }else if(preg_match('/\/lifestyle\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
        return "Lifestyle";
    }else if(preg_match('/\/pet-products\//',$_SERVER['REQUEST_URI'])){ //health-and-safety
        return "Pet Products";
    }else{
        $catsArr=get_the_category($post_id);
        if(is_array($catsArr)&&sizeof($catsArr)){
            foreach($catsArr as $k=>$v){
                if($v->term_id==8||$v->term_id==17||$v->term_id==20||$v->term_id==562){
                    if($v->term_id==8){
                        return "Pet Planning";
                    }else if($v->term_id==17){
                        return "Health and Safety";
                    }else{
                        return $v->name;                
                    }
                }
            }
            return $catsArr[0]->name;
        }else{
            return 'No Category';
        }
    }
}
/* get category and tag from URL. Wordpress function gives all categories and tags,
which aren't as relevant when a category or a tag link was clicked.
URLs: /category/pet-planning/ and /tag/healthandwellness/
*/
function getCategoryTagFromUrl(){
    $arr=explode('/',$_SERVER['REQUEST_URI']);
    if(preg_match('/\/category\//',$_SERVER['REQUEST_URI'])){
        $type='category';
    }else if(preg_match('/\/tag\//',$_SERVER['REQUEST_URI'])){
        $type='post_tag';
    }else{
        return false;
    }
    $term = get_term_by('slug', $arr[sizeof($arr)-2], $type);
    $name = $term->name;
    if($name=='Pet Planning'){
        return "Pet Planning";
    }else if($name=='Pet Care'){
        return "Health and Safety";
    }else{
        return $name;                
    }
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();	
}

function getResourceLink( $id ) {
    $link = home_url() . '/' . strtolower(str_replace(' ', '-', getResourceCategory( $id )));
    return $link;
}

// Upload Files
function cc_mime_types($mimes) {
     // New allowed mime types.
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    
    // Optional. Remove a mime type.
    unset( $mimes['exe'] );

    return $mimes;
}

/* search pet shortcode (inserted in post) */
add_shortcode('petpetGoose_pet_search', 'petpetGoose_pet_search_shortcode');
function petpetGoose_pet_search_shortcode() {
    ob_start();
    get_template_part('/template-parts/search-pets-form', null);
    $output =  ob_get_clean();
    $shortcode = '<div class="pet-search" id="petpetGoose_pet_search_shortcode">';
    $shortcode .= '<div class="pet-search__container">';
    $shortcode .= '<img src="/wp-content/themes/ppg/img/cats-dogs-shortcode.png" alt="Dogs and cats peaking over a white bar." />';
    $shortcode .= '<h2 class="heading">Find your new best friend</h2>';
    $shortcode .= $output;
    $shortcode .= '</div>';
    $shortcode .= '</div>';
    return $shortcode;
}

add_shortcode('pet_search', function ($atts) {
    $form = '<div class="search-pets-secondary"><form class="form form--search-pets" action="' . home_url() .'/search-pets/?woof_text=">';
    $form .= '<input type="text" placeholder="Find your pet" value name="woof_text" id="woof_text">';
    $form .= '<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>';
    $form .= '</form></div>';
    return $form;
});


add_shortcode('divider', function ($atts) {
    $divider = '<div class="divider divider--small">';
    $divider .= '<img src="' . get_stylesheet_directory_uri() . '/img/divider.png" alt="" />';
    $divider .= '</div>';
    return $divider;
});

add_shortcode('add_listing', function ($atts) {
    $add_listing = '
        <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#createListing">
            Create New Listing
        </button>
        <div class="pet-listing__add-listing modal fade" id="createListing" tabindex="-1" role="dialog" aria-labelledby="createListingLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title screen-reader-text" id="createListingLabel">Create New Listing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ' . do_shortcode('[gravityform id="27" ajax="false" title="false" description="false"]') . '
                    </div>
                </div>
            </div>
        </div>
    ';
    return $add_listing;
});

add_shortcode('current_listings', function ($atts) {
    $user_id = get_current_user_id();
    $listings = get_posts( array(
        'post_type'   => 'listings',
        'author' => $user_id,
        'posts_per_page' => -1
    ));
    echo '<p>Total Listings: ' . count($listings) . '</p>' ;
    foreach( $listings as $listing ) :
        $pet_name = get_field('listing_pet_name', $listing->ID);
        $pet_age = get_field('listing_pet_age', $listing->ID);
        $pet_color = get_field('listing_pet_color', $listing->ID);
        $pet_weight = get_field('listing_pet_weight', $listing->ID);
        $pet_sex = get_field('listing_pet_sex', $listing->ID);
        $listing_title = get_field('listing_title', $listing->ID);
        $listing_content = get_field('listing_content', $listing->ID);
        $listing_price = get_field('listing_price', $listing->ID);
        $listing_pet_type = get_field('listing_pet_type', $listing->ID);
        $listing_pet_breed = '';
        switch($listing_pet_type) {
            case 'dogs':
                $listing_pet_breed = get_field('listing_dog_breed', $listing->ID);
                break;
            case 'cats':
                $listing_pet_breed = get_field('listing_cat_breed', $listing->ID);
                break;
            case 'birds':
                $listing_pet_breed = get_field('listing_bird_breed', $listing->ID);
                break;
            case 'horses':
                $listing_pet_breed = get_field('listing_horse_breed', $listing->ID);
                break;
            case 'reptiles':
                $listing_pet_breed = get_field('listing_reptile_breed', $listing->ID);
                break;
            case 'small-pets':
                $listing_pet_breed = get_field('listing_small_pet_breed', $listing->ID);
                break;
            case 'farm-life':
                $listing_pet_breed = get_field('listing_farm_life_breed', $listing->ID);
                break;
            case 'other':
                $listing_pet_breed = get_field('listing_other_breed', $listing->ID);
                break;
        }
        $list_date = get_the_date('', $listing->ID);
        $image_primary = get_field('listing_primary_image', $listing->ID) ? get_field('listing_primary_image', $listing->ID) : get_field('pets_placeholder_image', 'option');
        $images_additional = get_field('listing_additional_images', $listing->ID);
        $listing_awards = get_field('listing_additional_select', $listing->ID);
        $listing_text_champion_bloodline = get_field('listing_text_champion_bloodline', $listing->ID);
        $listing_text_certified_breeder = get_field('listing_text_certified_breeder', $listing->ID);
        $listing_text_free_shipping = get_field('listing_text_free_shipping', $listing->ID);
        $listing_text_guaranteed_health = get_field('listing_text_guaranteed_health', $listing->ID);

        $edit_listing = add_query_arg( 'listings', $listing->ID, get_permalink( 61 + $_POST['_wp_http_referer'] ) );
        var_dump($edit_listing);
        ?>
        <div class="pet-listing__current-listing" id="pl-<?= $listing->ID; ?>">
            <div class="pet-listing__current-listing-added">Date Added: <?= $list_date; ?></div>
            <div class="pet-listing__current-listing-col primary">
                <div class="pet-listing__current-listing-col-container">
                    <div class="pet-listing__row row">
                        <div class="pet-listing__column col-md-6">
                            <div class="pet-listing__edit-main-image">
                                <?php if(is_array($image_primary)): ?>
                                    <img src="<?= $image_primary['url']; ?>" />
                                <?php else: ?>
                                    <img src="<?= $image_primary; ?>" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pet-listing__column col-md-6">
                            <h2><?= $pet_name; ?></h2>
                            <?php if($listing_pet_breed): ?>
                                <p>Breed: <?= $listing_pet_breed; ?></p>
                            <?php endif; ?>
                            <?php if($pet_color): ?>
                                <p>Color: <?= $pet_color; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if( $images_additional ): ?>
                        <?php $exploded = explode(',', $images_additional); ?>
                        <div class="pet-listing__row row">
                            <div class="pet-listing__column col-md-12">
                                <h3>Additional Images</h3>
                            </div>
                            <?php foreach($exploded as $img): ?>
                            <div class="pet-listing__column pet-listing__column--additional col-md-4">
                                <img src="<?= $img; ?>" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pet-listing__current-listing-col">
                <div class="pet-listing__current-listing-col-container">
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <h3 class="heading-primary"><?= $listing_title; ?></h3>
                            <?= $listing_content ?>
                        </div>
                    </div>
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <h3 class="heading-secondary">Awards & Certification</h3>
                        </div>
                        <div class="pet-listing__trunc">
                            <?php
                                if( !is_array($listing_awards) ) {
                                    $la_expoded = explode(', ', $listing_awards);
                                } else {
                                    $la_expoded = $listing_awards;
                                } ?>
                            <div class="breeder-details__tab-card">
                                <div>
                                    <p><img src="<?= get_stylesheet_directory_uri(); ?>/img/icons-png/champion-bloodline.png" alt="" /> <strong>Champion Bloodline</strong>: <?= in_array('Champion Bloodline', $la_expoded) ? 'Yes' : 'No'; ?></p>
                                </div>
                                <?php if(in_array('Champion Bloodline', $la_expoded)) : ?>
                                    <p><?= $listing_text_champion_bloodline; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="breeder-details__tab-card">
                                <div>
                                    <p><img src="<?= get_stylesheet_directory_uri(); ?>/img/icons-png/certified-breeder.png" alt="" /> <strong>Certified Breeder</strong>: <?= in_array('Certified Breeder', $la_expoded) ? 'Yes' : 'No'; ?></p>
                                </div>
                                <?php if(in_array('Certified Breeder', $la_expoded)) : ?>
                                    <p><?= $listing_text_certified_breeder; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="breeder-details__tab-card">
                                <div>
                                    <p><img src="<?= get_stylesheet_directory_uri(); ?>/img/icons-png/free-shipping.png" alt="" /> <strong>Free Shipping</strong>: <?= in_array('Free Shipping', $la_expoded) ? 'Yes' : 'No'; ?></p>
                                </div>
                                <?php if(in_array('Free Shipping', $la_expoded)) : ?>
                                    <p><?= $listing_text_free_shipping; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="breeder-details__tab-card">
                                <div>
                                    <p><img src="<?= get_stylesheet_directory_uri(); ?>/img/icons-png/guaranteed-health.png" alt="" /> <strong>Guaranteed Health</strong>: <?= in_array('Guaranteed Health', $la_expoded) ? 'Yes' : 'No'; ?></p>
                                </div>
                                <?php if(in_array('Guaranteed Health', $la_expoded)) : ?>
                                    <p><?= $listing_text_guaranteed_health; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="breeder-details__tab-card-action">
                                <a href="#pl-<?= $listing->ID; ?>" class="breeder-details__tab-card-action-more">View More Awards &amp; Certifications</a>
                                <a href="#pl-<?= $listing->ID; ?>" class="breeder-details__tab-card-action-less">View Less</a>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            <div class="pet-listing__current-listing-col">
                <div class="pet-listing__current-listing-col-container">
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <div class="pet-listing__current-stats">
                                <?php if($pet_age): ?>
                                    <p>Age: <?= $pet_age; ?></p>
                                <?php endif; ?>
                                <?php if($pet_sex): ?>
                                    <p>Sex: <?= $pet_sex; ?></p>
                                <?php endif; ?>
                                <?php if($pet_weight): ?>
                                    <p>Weight: <?= $pet_weight; ?></p>
                                <?php endif; ?>
                                <?php if($listing_price ): ?>
                                    <p>Price: <?= $listing_price ; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <a href="<?= get_the_permalink($listing->ID); ?>" class="btn btn--primary">View Listing</a>
                        </div>
                    </div>
                    
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#updatedListing_<?= $listing->ID; ?>">
                                Edit Listing
                            </button>
                            <div class="pet-listing__add-listing modal fade" id="updatedListing_<?= $listing->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="updateListingLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title screen-reader-text" id="updatedListingLabel">Update Listing</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="postbox">
                                                <form id="new_post" name="new_post" method="post" action="">
                                                    <div class="form__row">
                                                        <label for="title">Listing Title</label><br />
                                                        <input type="text" id="title" value="<?= $listing_title; ?>" tabindex="1" size="20" name="title" />
                                                    </div>
                                                    <div class="form__row">
                                                        <label for="description">Listing Content</label><br />
                                                        <textarea id="description" tabindex="3" name="description" cols="50" rows="6"><?= $listing_content; ?></textarea>
                                                    </div>
                                                    <div class="form__row">
                                                        <input type="submit" value="Publish" tabindex="6" id="submit" name="submit" />
                                                    </div>
                                                    <input type="hidden" name="action" value="f_edit_post" />
                                                    <input type="hidden" name="pid" value="<?= $listing->ID; ?>" />
                                                    <?php wp_nonce_field( 'edit-post' ); ?>
                                                </form>
                                            </div>
                                            <?php //= do_shortcode('[gravityform id="27" ajax="false" title="false" description="false"]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pet-listing__row">
                        <div class="pet-listing__column">
                            <a onclick="return confirm('Are you sure you wish to delete listing: <?= get_the_title($listing->ID) ?>?')" href="<?= get_delete_post_link($listing->ID); ?>" class="btn btn--delete btn--large">Delete Listing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
    
});

add_shortcode( 'get_animal_type', function () {
    return get_the_term_list( get_the_ID(), 'animals');
});

add_shortcode( 'get_user_id', function () {
    $user_id = get_current_user_id();
    return $user_id;
});

function redirect_after_trashing_listing($id = 0, $deprecated = '', $force_delete = true){
    global $post;
    $action = ( $force_delete || !EMPTY_TRASH_DAYS ) ? 'delete' : 'trash';
    $qargs = array(
        'action' => $action,
        'post' => $post->ID,
        'user' => get_current_user_id()
    );
    $delete_link = add_query_arg( $qargs, home_url( sprintf( '/profile/?profiletab=listings' ) ) );
    return  wp_nonce_url( $delete_link, "$action-post_{$post->ID}" );
}

function um_remove_scripts_and_styles() {
	global $post, $um_load_assets, $wp_scripts, $wp_styles;

	// Set here IDs of the pages, that use Ultimate Member scripts and styles
	$um_posts = array(0);

	// Set here URLs of the pages, that use Ultimate Member scripts and styles
	$um_urls = array(
		'/account/',
		'/activity/',
		'/groups/',
		'/login/',
		'/logout/',
		'/members/',
		'/my-groups/',
		'/password-reset/',
		'/register/',
		'/user/',
		'/sign-up/',
        '/profile/',
        '/product/',
        '/listings/'
	);

	if ( is_admin() || is_ultimatemember() ) {
		return;
	}
	
	$REQUEST_URI = $_SERVER['REQUEST_URI'];
	if ( in_array( $REQUEST_URI, $um_urls ) ) {
		return;
	}
	foreach ( $um_urls as $key => $um_url ) {
		if ( strpos( $REQUEST_URI, $um_url ) !== FALSE ) {
			return;
		}
	}

	if ( !empty( $um_load_assets ) ) {
		return;
	}
	
	if ( isset( $post ) && is_a( $post, 'WP_Post' ) ) {
		if ( in_array( $post->ID, $um_posts ) ) {
			return;
		}
		if ( strpos( $post->post_content, '[ultimatemember_' ) !== FALSE ) {
			return;
		}
		if ( strpos( $post->post_content, '[ultimatemember form_id' ) !== FALSE ) {
			return;
		}
	}

	if ( empty( $wp_scripts->queue ) || empty( $wp_styles->queue ) ) {
		return;
	}

	foreach ( $wp_scripts->queue as $key => $script ) {
		if ( strpos( $script, 'um_' ) === 0 || strpos( $script, 'um-' ) === 0 || strpos( $wp_scripts->registered[$script]->src, '/ultimate-member/assets/' ) !== FALSE ) {
			unset( $wp_scripts->queue[$key] );
		}
	}

	foreach ( $wp_styles->queue as $key => $style ) {
		if ( strpos( $style, 'um_' ) === 0 || strpos( $style, 'um-' ) === 0 || strpos( $wp_styles->registered[$style]->src, '/ultimate-member/assets/' ) !== FALSE ) {
			unset( $wp_styles->queue[$key] );
		}
	}
}

/**
 * Check whether Ultimate Member widget was used
 * @param array $widget
 */
function um_remove_scripts_and_styles_widget( $widget ) {
	if ( strpos( $widget['id'], 'um_' ) === 0 || strpos( $widget['id'], 'um-' ) === 0 ) {
		$GLOBALS['um_load_assets'] = TRUE;
	}
}

// Gravity Forms Image + UM Member Profile
function iss_gf_after_submission($entry, $form) {
    
    //Walk through the form fields and find any file upload fields
    foreach ($form['fields'] as $field) {
        if ($field->type == 'fileupload') {
            // See if an image was submitted with this entry
            if ( isset( $entry[$field->id] ) ) {
                
                $fileurl = $entry[$field->id];
                // GFCommon::log_debug( 'fileurl => '. $fileurl);
                
                // The ID of the post this attachment is for. Use 0 for unattached.
                $parent_post_id = 0;
                
                // User submitting info
                $the_user = get_current_user_ID();
                // GFCommon::log_debug( 'user id => '. $the_user);

                // Check the type of file. We'll use this as the 'post_mime_type'.
                $filetype = wp_check_filetype( basename( $fileurl ), null );
                // GFCommon::log_debug( 'filetype => '. $filetype);
                
                // Get the path to the upload directory.
                $wp_upload_dir = wp_upload_dir();

                //Gravity forms often uses its own upload folder, so we're going to grab whatever location that is
                $parts = explode('/', $entry[$field->id]);
                $image_src = explode('.', end($parts) );
                $image_type = end($image_src);
                $filepath = $wp_upload_dir['basedir'] . '/' . $the_user . '/profile_photo.' . $image_type ;
                $fileurl = $wp_upload_dir['baseurl'] . '/' . $the_user . '/profile_photo.' . $image_type ;

                // file_put_contents( $file, $image_data );

                // GFCommon::log_debug( 'image_src => '. $image_src);
                // GFCommon::log_debug( 'image_type => '. $image_type);
                // GFCommon::log_debug( 'parts => '. $parts[2]);
                // GFCommon::log_debug( 'filepath => '. $filepath);
                // GFCommon::log_debug( 'fileurl => '. $fileurl);

                // Prepare an array of post data for the attachment.
                $attachment = array(
                    'guid' => $fileurl,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $fileurl) ),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                // GFCommon::log_debug( 'attachment => '. $attachment);

                // Insert the attachment.
                $attach_id = wp_insert_attachment( $attachment, $filepath, $parent_post_id );
                GFCommon::log_debug( 'attach_id => '. $attach_id);
                GFCommon::log_debug( 'attach_id => '. $attachment);
                GFCommon::log_debug( 'attach_id => '. $filepath);
                GFCommon::log_debug( 'attach_id => '. $parent_post_id);
                
                //Image manipulations are usually an admin side function. Since Gravity Forms is a front of house solution, we need to include the image manipulations here.
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                require_once( ABSPATH . 'wp-admin/includes/file.php' );

                require_once( ABSPATH . 'wp-admin/includes/media.php'  );

                // Generate the metadata for the attachment, and update the database record.
                // if ( $attach_data = wp_generate_attachment_metadata($attach_id, $filepath) ) {
                //     wp_update_attachment_metadata($attach_id, $attach_data);
                // } else {
                //     echo '
                //         <div id="message" class="error">
                //             <h1>Failed to create Meta-Data</h1>
                //         </div>
                //     ';
                // }

                wp_update_attachment_metadata( $attach_id, $attach_data );
                set_post_thumbnail( $parent_post_id, $attach_id );
            }
        }
    }
}

function acf_to_rest_api($response, $post, $request) {
    // var_dump($response, $post, $request);
    if (!function_exists('get_fields')) return $response;
    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['acf'] = $acf;
    }
    return $response;
}

function dw_show_confirmation_and_form( $form ) {
	$shortcode = '[gravityform id="' . $form['id'] . '" ajax="true" title="false" description="false"]';
	ob_start();
	echo do_shortcode($shortcode);
	$html = ob_get_clean();
    $script = '<script type="text/javascript">setTimeout(function(){jQuery("confirmation-message").removeClass("show");}, 5000);</script>';
	if ( array_key_exists( 'confirmations', $form ) ) {
		foreach ( $form['confirmations'] as $key => $confirmation ) {
			$form['confirmations'][ $key ]['message'] = $html . '<div class="confirmation-message show">' . $form['confirmations'][ $key ]['message'] . '</div>' . $script;
		}
	}
    // var_dump($form);
	return $form;
}