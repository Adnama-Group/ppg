<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <?php if( is_single() ): ?>
                <main id="primary" class="col-md-12">
                    <?php woocommerce_content(); ?>
                </main>
            <?php else: ?>
                <?= get_sidebar('products'); ?>
                <main id="primary" class="col-md-8">
                    <?php woocommerce_content(); ?>
                </main><!-- #primary -->
            <?php endif; ?>
        </div>
    </div>

<?php
get_footer();