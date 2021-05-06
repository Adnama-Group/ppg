<?php
    $logo = get_field('logo_white', 'option');
    $about_content = get_field('about_content', 'option');
    $overview_menu = get_field('overview_menu', 'option');
    $notices_menu = get_field('notices_menu', 'option');
    $newsletter = get_field('newsletter_footer', 'option');
    $copyright = get_field('copyright', 'option');
?>

<?php /*
<div class="bug-report">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bug">
        <span class="screen-reader-text">Launch Bug Report Form</span> <i class="fas fa-bug"></i> <div class="bug-report__text">Submit Bug Report</div>
    </button>
</div> */ ?>

<div class="footer-list-pet">
    <button type="button" class="footer-list-pet__close" aria-label="Close List Pet Button"><span aria-hidden="true"><i class="far fa-times-circle"></i></span></button>
    <a href="<?= home_url(); ?>/list-your-pet"><i class="fas fa-dog"></i> List Your Pet</a>
</div>

<div class="modal fade" id="bug" tabindex="-1" role="dialog" aria-labelledby="bugLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="align-items: center;">
                <h2 class="heading heading--sm" style="margin:0;" id="bugLabel">Bug Report Form</h2>
                <button type="button" class="btn btn--primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <?= do_shortcode('[gravityform id="25" title="false" description="false" ajax="true"]'); ?>
            </div>
        </div>
    </div>
</div>

<footer class="site-footer" role="contentinfo">
    <div class="site-footer__top">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="site-footer__about">
                        <?php if ( $logo ): ?>
                            <a href="<?= home_url(); ?>">
                                <?= wp_get_attachment_image($logo, 'full'); ?>
                            </a>
                        <?php endif; ?>
                        <?= $about_content; ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="site-footer__overview">
                        <h2 class="text--uppercase heading heading--sm">Overview</h2>
                        <ul class="list-unstyled">
                            <?php foreach($overview_menu as $menu_item): ?>
                                <li><a href="<?= $menu_item['item']['url']; ?>" target="<?= $menu_item['item']['target']; ?>"><?= $menu_item['item']['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="site-footer__notices">
                        <h2 class="text--uppercase heading heading--sm">Notices</h2>
                        <ul class="list-unstyled">
                            <?php foreach($notices_menu as $menu_item): ?>
                                <li><a href="<?= $menu_item['item']['url']; ?>" target="<?= $menu_item['item']['target']; ?>"><?= $menu_item['item']['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="site-footer__social">
                        <h2 class="text--uppercase heading heading--sm">Social</h2>
                        <?= get_template_part('template-parts/social', null, ['primary']); ?>
                    </div>

                    <?php if($newsletter['content']): ?>
                    <div class="site-footer__newsletter">
                        <h2 class="text--uppercase heading heading--sm">Newsletter</h2>
                        <?= $newsletter['content']; ?>
                        <?php if($newsletter['form']): ?>
                            <?= do_shortcode('[gravityform id="' . $newsletter['form'] . '" title="false" description="false" ajax="true"]'); ?>
                            <?php //var_dump($newsletter); ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="site-info">
                        <p>&copy; <?= date('Y'); ?> <?= '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?> <?= $copyright; ?></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="harbor">
                        <p>Made with <i class="fas fa-heart"><span class="screen-reader-text">Harbor Social</span></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>