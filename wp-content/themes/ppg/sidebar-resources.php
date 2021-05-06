<?php
    $articles = get_posts(array(
        'numberposts'   => 4
    ));
?>

<aside class="sidebar sidebar--resources">
    <div class="sidebar__inner">
        <div class="sidebar__search">
            <?= do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
        </div>

        <?php if( !empty($articles) ): ?>
        <div class="sidebar__articles">
            <div class="sidebar__title">
                <h2 class="heading">Articles</h2>
            </div>
            <?php foreach($articles as $article): ?>
                <div class="sidebar__article">
                    <article class="post post--inline">
                        <a class="post__image" href="<?= get_permalink($article); ?>">
                            <?php
                                $main_image = get_field('main_image', $article);
                                if( !empty($main_image['url']) ) {
                                    echo "<img src='" . $main_image['sizes']['thumbnail'] . "' />";
                                } else {
                                    echo get_the_post_thumbnail($article, 'thumbnail');
                                };
                            ?>
                        </a>
                        <div class="post__meta">
                            <div class="post__cat">
                                <a href="<?= getResourceLink($article); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($article))); ?> post__cat-link'><?= getResourceCategory($article);?></a>
                            </div>
                            <h2 class="post__title"><a href="<?= get_permalink($article); ?>"><?= get_the_title($article);?></a></h2>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="sidebar__cats">
            <div class="sidebar__title">
                <h2 class="heading">Categories</h2>
            </div>
            <div class="list-cat">
            <?php
            $cats = get_categories(array(
                'orderby' => 'name',
                'parent'  => 0
            ));
            foreach ( $cats as $cat ): ?>
                <div class="list-cat__container">
                    <div class="list-cat__name">
                        <a href="<?= home_url(); ?>/<?= strtolower(str_replace(' ', '-', $cat->cat_name)); ?>"><?= $cat->cat_name; ?></a>
                    </div>
                    <div class="list-cat__count list-cat__count--<?= strtolower(str_replace(' ', '_', $cat->cat_name)); ?>">
                        <?= $cat->category_count; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>


        <div class="sidebar__cloud">
            <div class="sidebar__title">
                <h2 class="heading">Tags</h2>
            </div>
            <?= wp_tag_cloud(array(
                'number'    => 50
            )); ?>
        </div>

        <div class="sidebar__newsletter">
            <div class="sidebar__newsletter-content">
                <div class="sidebar__title">
                    <h2 class="heading">Newsletter</h2>
                </div>
                <p>Subscribe to our newsletter to get notification about new updates, information, etc..</p>
                <?= do_shortcode('[gravityform id="20" title="false" description="false" ajax="true"]'); ?>
            </div>
        </div>

        <div class="sidebar__social">
            <div class="sidebar__title">
                <h2 class="heading">Get Social</h2>
            </div>
            <?= get_template_part('template-parts/social', null, ['primary']); ?>
        </div>

    </div>
</aside>