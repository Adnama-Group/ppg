<?php
	$article = get_the_id();
?>

<article class="post post--condensed">
	<div class="post__image">
		<a href="<?= get_permalink($article); ?>">
			<?= get_the_post_thumbnail($article, 'medium'); ?>
		</a>
	</div>
	<div class="post__cat">
		<a href="<?= getResourceLink($article); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($article))); ?> post__cat-button'><?= getResourceCategory($article);?></a>
	</div>
	<div class="post__meta">
		<h2 class="post__title"><a href="<?= get_permalink($article); ?>"><?= get_the_title($article);?></a></h2>
		<div class="post__content">
			<p><?= wp_trim_words( get_the_content(null, false, $article), 22 ); ?></p>
			<p><a class="text--uppercase text--red" href="<?= get_permalink($article); ?>">Read More</a></p>
		</div>
	</div>
</article>
