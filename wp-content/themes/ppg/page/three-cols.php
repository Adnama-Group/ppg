
<?php
    $three_columns = $structure['three_columns'];
    $color_mode = isset($structure['three_color_mode']) ? 'three-col--' . $structure['three_color_mode'] : '';
    if(count($three_columns) === 0) return null;
?>

<div class="three-col <?= $color_mode; ?>">
    <div class="container">
        <div class="row">
            <?php foreach($three_columns as $col): ?>
                <div class="col-md-4">
                    <div class="three-col__block" style="background-image:url(<?= $col['background_image']; ?>);">
                        <div class="three-col__block-inner">
                            <?= $col['content'] ? $col['content'] : null; ?>
                            <?php if($col['button']): ?>
                                <a class="button button--primary button--white-border" href="<?= $col['button']['url']; ?>" target="<?= $col['button']['target']; ?>"><?= $col['button']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>