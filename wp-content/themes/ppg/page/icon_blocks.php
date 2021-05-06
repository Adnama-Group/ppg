<?php
    $blocks = $structure['blocks'];
    $offset = $structure['offset_top_margin'];
?>

<div class="icon-blocks <?= $offset ? 'icon-blocks--offset' : null; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach($blocks as $block): ?>
                <?php //var_dump($block); ?>
                <div class="col-md-4">
                    <div class="icon-blocks__block">
                        <div class="icon-blocks__image">
                            <img src="<?= $block['icon']['url']; ?>" />
                        </div>
                        <div class="icon-blocks__content">
                            <h2 class="heading heading--lg"><?= $block['title']; ?></h2>
                            <?= $block['content']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>