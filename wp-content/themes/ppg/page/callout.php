<?php
    $title = $structure['callout_title'];
    $reverse = $structure['callout_reverse'] ? 'flex-row-reverse' : null;
    $content = $structure['callout_content'];
    $bg_image = isset($structure['background_image']) ? $structure['background_image'] : null;
?>

<div class="callout" style="background-image:url(<?= $bg_image; ?>)">
    <div class="container">
        <div class="row align-items-center justify-content-center <?= $reverse; ?>">
            <div class="col-md-3">
                <div class="callout__title">
                    <h2 class="heading heading--lg"><?= $title; ?></h2>
                </div>
            </div>
            <div class="col-md-6 offset-md-1">
                <div class="callout__content">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>