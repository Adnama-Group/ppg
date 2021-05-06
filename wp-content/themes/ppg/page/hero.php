<?php
    $bg_image_url = $structure['background_image'];
    $show_text = $structure['display_text'];
    $text = $structure['text'];
?>

<div class="hero" style="background-image:url(<?= $bg_image_url; ?>)">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="hero__content text-center">
                    <?php if($show_text): ?>
                        <h1 class="heading heading--xl <?= !empty($bg_image_url) ? 'heading--white' : null; ?>"> <?= !empty($text) ? $text : get_the_title(); ?></h1>
                        <?= get_template_part('template-parts/divider', null, [ !empty($bg_image_url) ? 'white' : null] ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>