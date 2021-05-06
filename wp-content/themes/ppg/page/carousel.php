<?php
    $slides = $structure['carousel_slides'];
    $nav = $structure['navigation'];
    // var_dump($nav);
?>

<div id="carousel_<?= $i; ?>" class="carousel slide" data-ride="carousel" data-pause="hover" >
    <?php if( $nav['dots'] && count($slides) > 1 ): ?>
        <ol class="carousel-indicators">
            <?php foreach($slides as $idx_dot => $s): ?>
                <li data-target="#carousel_<?= $i; ?>" data-slide-to="<?= $idx_dot; ?>" class="<?= $idx_dot === 0 ? 'active' : null; ?>"></li>                
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

	<div class="carousel-inner">
        <?php foreach($slides as $idx_slide => $s): ?>
            <div class="carousel-item <?= $idx_slide === 0 ? 'active' : null; ?>">
                <div class="carousel__item-container">
                    <div class="carousel__item-inner">
                        <div class="carousel__item-content">
                            <?php if( $s['slide_title'] ): ?>
                                <h2 class="heading"><?= $s['slide_title']; ?></h2>
                            <?php endif; ?>
                            <?= $s['slide_content']; ?>
                            <?php if( $s['slide_button']['url'] ): ?>
                                <a target="<?= $s['slide_button']['target']; ?>" class="button button--primary button--white-border" href="<?= $s['slide_button']['url']; ?>"><?= $s['slide_button']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <picture>
                        <source media="(max-width:465px)" srcset="<?= $s['slide_image_mobile']['url']; ?>">
                        <img src="<?= $s['slide_image']['url']; ?>" />
                    </picture>
                </div>
            </div>
        <?php endforeach; ?>
	</div>

    <?php if($nav['arrows'] && count($slides) > 1): ?>
        <div class="carousel__nav-container">
            <a class="carousel-control-prev" href="#carousel_<?= $i; ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel_<?= $i; ?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php endif; ?>
</div>