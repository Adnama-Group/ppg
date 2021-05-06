<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <section class="container">
        <div class="row">
            <header class="col-12 search-results__header">
                <h1 class="heading heading--xl">
                    <?php printf(
                        esc_html__( 'Results for "%s"', 'ppg' ),
                        '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                    ); ?>
                </h1>
                <p><?php
                    printf(
                        esc_html(
                            /* translators: %d: The number of search results. */
                            _n(
                                'We found %d result for your search.',
                                'We found %d results for your search.',
                                (int) $wp_query->found_posts,
                                'twentytwentyone'
                            )
                        ),
                        (int) $wp_query->found_posts
                    );
                ?></p>
            </header>
        </div>
        <div class="row">
            <main class="col-md-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?= get_template_part( 'template-parts/excerpt', null ); ?>
                <?php endwhile; ?>
                <?= the_posts_pagination(); ?>
            </main>
            <aside class="col-md-4">
                    <?= get_sidebar('resources'); ?>
            </aside>
        </div>
    </section>
<?php endif; ?>

<?php get_footer();