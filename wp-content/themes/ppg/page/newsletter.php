<?php 
    $bg = $structure['newsletter_background_image'];
    $title = $structure['newsletter_title'];
    $content = $structure['newsletter_content'];
    $newsletter = $structure['newsletter_gravity_form'];
?>

<div class="newsletter" style="background-image:url(<?= $bg['url']; ?>);">
    <div class="container" id="join_our_newsletter">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="heading heading--lg heading--light text-center text-uppercase"><?= $title; ?></h2>
                <?= get_template_part('template-parts/divider', null, ['white']); ?>
                <?= $content; ?>
                <?php if($newsletter): ?>
                    <?= do_shortcode('[gravityform id="' . $newsletter . '" title="false" description="false" ajax="true"]'); ?>
                    <?php //var_dump($newsletter); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>