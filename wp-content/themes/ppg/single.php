<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<?php 
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'post' );

			the_post_navigation();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

	<?= get_template_part('template-parts/newsletter', null); ?>	
<?php
get_footer();