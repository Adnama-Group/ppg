<?php
    get_header();
    $page_structure = get_field('page_structure');
    // var_dump($page_structure);
?>

<?php if($page_structure): ?>
    <?php
        foreach($page_structure as $i => $structure){
            switch($structure['acf_fc_layout']) {
                case 'callout':
                    include( locate_template( '/page/callout.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'carousel':
                    include( locate_template( '/page/carousel.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'contact_bar':
                    include( locate_template( '/page/contact_bar.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'content':
                    include( locate_template( '/page/content.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'columns_layout':
                    include( locate_template( '/page/columns_layout.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'hero':
                    include( locate_template( '/page/hero.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'icon_blocks':
                    include( locate_template( '/page/icon_blocks.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'latest_resources':
                    include( locate_template( '/page/latest_resources.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'newsletter':
                    include( locate_template( '/page/newsletter.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'spacer':
                    include( locate_template( '/page/spacer.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'three-cols':
                    include( locate_template( '/page/three-cols.php', false, false ) );
                    break;
            }
            switch($structure['acf_fc_layout']) {
                case 'quote_block':
                    include( locate_template( '/page/quote_block.php', false, false ) );
                    break;
            }
        }
    ?>
<?php else: ?>
    <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
    ?>
<?php endif; ?>

<?php get_footer(); ?>
