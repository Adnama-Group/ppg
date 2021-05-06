<?php
    get_header();
    $page_id = get_the_ID();
    $page_structure = get_field('page_structure');
    $photo_gallery = get_field('photo_gallery');
    $modal = get_field('modal');
    $taxonomies = get_the_term_list($page_id, 'animals');
    $taxonomy = get_the_terms($page_id, 'animals');
    $page_animal = strtolower( $taxonomy[0]->name );
    $global_options = get_field( str_replace(' ', '-', $page_animal), 'option');
    $overwrite = get_field('overwrite');
    // var_dump($overwrite['attention_lovers']['title']);
?>

<div class="animals <?= $page_animal ? 'animals--' . str_replace(' ', '-', $page_animal) : null; ?>">

    <div class="animals__main">

        <div class="container">
            <div class="animals__breadcrumbs">
                <ul>
                    <li><a href="<?= home_url(); ?>">Home</a></li>
                    <li>Animals</li>
                    <li><?= $page_animal; ?></li>
                    <li class="current"><?= get_the_title(); ?></li>
                </ul>
            </div>
        </div>

        <div class="container">
        <?php
            if($page_structure):
                foreach($page_structure as $i => $structure){
                    // var_dump($structure);
                    switch($structure['acf_fc_layout']) {
                        case 'hero':
                            include( locate_template( '/template-parts/animals/hero.php', false, false ) );
                            break;
                        case 'content_block':
                            include( locate_template( '/template-parts/animals/content_block.php', false, false ) );
                            break;
                        case 'evaluation_block':
                            include( locate_template( '/template-parts/animals/evaluation_block.php', false, false ) );
                            break;
                        case 'search_block':
                            include( locate_template( '/template-parts/animals/search_block.php', false, false ) );
                            break;
                    }
                    // switch($structure['acf_fc_layout']) {
                    //     case 'carousel':
                    //         include( locate_template( '/page/carousel.php', false, false ) );
                    //         break;
                    // }
                }
            endif;
        ?>
        </div>
    </div>

    <div class="animals__photo-cta">
        <div class="container" aria-hidden="true">
            <div class="row"><div class="col-12"><div class="spacer spacer--4x"></div></div></div>
        </div>
        <div class="animals__photo-cta-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="animals__photo-cta-content">
                            <div class="animals__photo-cta-icon">
                                <?= file_get_contents(get_template_directory() . '/img/icons/camera.svg'); ?>
                            </div>
                            <h2 class="heading heading--lg"><?= !empty($overwrite['attention_lovers']['title']) ? $overwrite['attention_lovers']['title'] : 'Attention ' . rtrim($page_animal, 's') . ' Lovers!'; ?></h2>
                            <?php if( !empty($overwrite['attention_lovers']['content']) ) : ?>
                                <?= $overwrite['attention_lovers']['content']; ?>
                            <?php else: ?>
                                <p>Have an amazing picture of you with your <?= get_the_title(); ?> that you'd like to send us - upload it here and get famous!</p>
                            <?php endif; ?>
                            <p><button class="button button--primary button--white-border" data-toggle="modal" data-target="#submitImage">Upload Your Image</button></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="animals__photo-cta-image">
                            <img src="<?= get_stylesheet_directory_uri() . '/img/ppg-photographer.png'; ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if( count($photo_gallery) > 6 ) : ?>
        <div class="animals__grid-images">
            <?php foreach( $photo_gallery as $photo): ?>
                <div class="animals__grid-image">
                    <?= wp_get_attachment_image($photo, 'full'); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <div class="animals__footer <?= $global_options['footer_page_style'] ? 'animals__footer--' . $global_options['footer_page_style'] : null; ?>" <?= $global_options['footer_page_style'] ? 'style="background-color: ' . $global_options['footer_background_color'] . ' "' : null; ?>>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="animals__footer-box">
                        <div class="animals__footer-content">
                            <p class="heading--lg text--white"><?= !empty($overwrite['bottom_cta']['content']) ? $overwrite['bottom_cta']['content'] : 'Done enough research and ready to search for the perfect ' . get_the_title() . ' for sale?'; ?></p>
                            <form class="form form--search-pets" action="<?= home_url(); ?>/search-pets/?woof_text=">
                                <input type="text" placeholder="Search for <?= $page_animal ? $page_animal : get_the_title(); ?>" value="" name="woof_text" id="s">
                                <button type="submit">Search</button>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($global_options['footer_form_background']) : ?>
        <div class="animals__footer-bg">
            <?= wp_get_attachment_image($global_options['footer_form_background'], 'full'); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="animals__bg">
        <div id="top" class="animals__bg-top">
            <?= file_get_contents(get_template_directory() . '/img/animals/birds-flying-2.svg'); ?>
        </div>
        <div class="animals__bg-btm">
            <?= file_get_contents(get_template_directory() . '/img/animals/desert-background.svg'); ?>
        </div>
    </div>

</div>

<?php /* Modal */ ?>
<div class="animals__modal modal fade" id="submitImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-close">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header screen-reader-text">
                <h2 class="modal-title" id="exampleModalLongTitle">Submit Your Image </h2>
            </div>
            <div class="modal-body">
                <?= $modal['content'] ? $modal['content'] : null; ?>
                <?= do_shortcode('[gravityform id="26" title="true" description="true"]'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();