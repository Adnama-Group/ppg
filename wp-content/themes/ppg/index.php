<?php get_header(); ?>

	<section class="post-archive">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
					<?php if ( have_posts() ) : ?>
						<div class="posts">
							<?php
								while ( have_posts() ) :
									the_post();
									get_template_part('template-parts/excerpt');
								endwhile;
							?>
						</div>
					<?php else : ?>
						<p>No posts found</p>
					<?php endif; ?>
				</div>
				<div class="col-md-4">
				
				</div>
			</div>

		</div>
	</section>

<?php
get_footer();
