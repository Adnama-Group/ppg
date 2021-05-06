<?php
    $layout = $structure['layout'] ? $structure['layout'] : null;
    $container = $structure['layout_container'] ? 'container' : 'container-fluid';
    $layout_reverse = $structure['layout_reverse'] ? 'd-flex flex-row-reverse' : null;
    $bg_image = $structure['layout_background_image'];
    $bg_color = $structure['layout_background_color'] ? 'layout--' . $structure['layout_background_color'] : 'layout--default';
    $title = $structure['layout_title'];
    $title_size = $structure['layout_size'];
    $title_alignment = isset($structure['layout_title_alignment']) ? $structure['layout_title_alignment'] : null;
    $content = $structure['layout_content_block'];
    $button = $structure['layout_button'];
    $image = $structure['layout_image'];
    $image_title = $structure['layout_image_title'];
?>

<div class="layout layout--<?= $layout?> <?= $bg_color; ?>" style="background-image:url(<?= isset($bg_image['url']) ? $bg_image['url'] : null; ?>)">
    <div class="<?= $container; ?>">
        <div class="row <?= $layout_reverse; ?>">
            <div class="layout__content <?= $structure['layout_reverse'] ? 'layout__content--reverse': null ; ?>">
                <div class="layout__content-inner">
                    <?php if($title): ?>
                        <div class="layout__content-title layout__content-title--<?= $title_alignment; ?>">
                            <h2 class="heading heading--<?= $title_size; ?>"><?= $title; ?></h2>
                            <?= $layout === 'secondary' ? get_template_part('template-parts/divider', null, ['white']) : get_template_part('template-parts/divider', null); ?>
                        </div>
                    <?php endif; ?>
                                        
                    <?= $content; ?>

                    <?php if( !empty($button['url']) ): ?>
                        <a class="button button--primary button--white-border" href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"><?= $button['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="layout__image <?= isset($image_title) && $image_title ? 'layout__image--title' : null; ?>">
                <?= wp_get_attachment_image($image, 'full'); ?>
                <?php if (isset($image_title) && $image_title): ?>
                    <p><?= get_the_title($image); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>