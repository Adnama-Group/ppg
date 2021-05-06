<?php
    // Hero Animal Component
    $hero_image = isset($structure['hero_image']) ? $structure['hero_image'] : null;
?>


<div class="row">
    <div class="col-12">
        <div class="animals__hero">
            <div class="animals__hero-content">
                <h1 class="heading" data-reflection="<?= get_the_title(); ?>"><?= get_the_title(); ?></h1>
            </div>
            <div class="animals__hero-image">
                <?= wp_get_attachment_image($hero_image, 'large'); ?>
            </div>
        </div>
    </div>
</div>