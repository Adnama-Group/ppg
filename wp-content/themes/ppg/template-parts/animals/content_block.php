<?php
    // Content Block Animal Component
    $title = isset($structure['title']) ? $structure['title'] : null;
    $content = isset($structure['content']) ? $structure['content'] : null;
    $image = isset($structure['image']) ? $structure['image'] : null;
    $style = isset($structure['style']) ? $structure['style'] : null;
    $include_fun_facts = isset($structure['include_fun_facts']) ? $structure['include_fun_facts'] : null;
    $fun_facts = isset($structure['fun_facts']) ? $structure['fun_facts'] : null;
?>

<div class="row">
    <div class="col-12">
        <div class="animals__content-block <?= $style ? 'animals__content-block--' . $style : null; ?>">
            <?= $style === '3d' ? '<span class="triangle-edge triangle-edge--left"></span>' : null; ?>

            <?php if($title): ?>
            <div class="animals__content-block-title">
                <h2 class="heading"><?= $title; ?></h2>
                <?= get_template_part('template-parts/divider', null, $style === '3d' ? ['white'] : null ); ?>
            </div>
            <?php endif; ?>

            <?php if($content): ?>
            <div class="animals__content-block-content">
                <?= $content; ?>
            </div>
            <?php endif; ?>

            <?php if($image): ?>
            <div class="animals__content-block-image">
                <?= wp_get_attachment_image($image, 'large'); ?>
            </div>
            <?php endif; ?>

            <?php if($include_fun_facts): ?>
            <div class="animals__fun-facts">
                <div class="animals__fun-facts-title">
                    <h2 class="screen-reader-text">Fun Facts</h2>
                    <?= file_get_contents(get_template_directory() . '/img/fun-facts.svg'); ?>
                </div>
                <?php if($fun_facts): ?>
                    <ol>
                        <?php foreach($fun_facts as $fact): ?>
                        <li><?= $fact['fun_fact']; ?></li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?= $style === '3d' ? '<span class="triangle-edge triangle-edge--right"></span>' : null; ?>
        </div>
    </div>
</div>