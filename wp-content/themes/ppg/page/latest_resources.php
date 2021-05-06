<?php
    $title = $structure['resources_title'];
    $content = $structure['resources_content'];
    $resources = $structure['resources'];
    $bg_url = $structure['background_image'];
?>

<div class="latest-resources" style="background-image:url(<?= $bg_url; ?>);">
	<div class="latest-resources__container container">
		<div class="row">
			<div class="col-12">
				<div class="latest-resources__description text-center">
					<h2 class="heading heading--lg heading--primary-light"><?= $title; ?></h2>
					<?= get_template_part('template-parts/divider', null); ?>
					<?= $content; ?>
				</div>
			</div>
		</div>
		<div class="row">
            <?php foreach($resources as $resource): ?>
			<div class="col-md-4">
				<article class="post post--condensed">
					<div class="post__image">
						<a href="<?= get_permalink($resource['resource']->ID); ?>">
							<?php 
								$main_image = get_field('main_image', $resource['resource']->ID);
								// var_dump($main_image);
								echo get_the_post_thumbnail($resource['resource']->ID, 'medium');
							?>
						</a>
					</div>
					<div class="post__cat">
						<a href="<?= getResourceLink($resource['resource']->ID); ?>" class="button button--category <?= strtolower(str_replace(' ', '_', getResourceCategory($resource['resource']->ID))); ?>"><?= getResourceCategory($resource['resource']->ID);?></a>
					</div>
					<div class="post__meta">
						<h2 class="post__title"><a href="<?= get_permalink($resource['resource']->ID); ?>"><?= get_the_title($resource['resource']->ID);?></a></h2>
						<div class="post__content">
							<p><?= wp_trim_words( get_the_content(null, false, $resource['resource']->ID), 22 ); ?></p>
							<p><a class="text--uppercase text--red" href="<?= get_permalink($resource['resource']->ID); ?>">Read More</a></p>
						</div>
					</div>
				</article>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="latest-resources__button">
					<p class="text-center"><a href="<?= home_url(); ?>/all-articles" class="button button--primary">Search Resource Library</a></p>
				</div>
			</div>
		</div>
	</div>
</div>