<?php
    $quote_image = $structure['quote_image'];
    $quote = $structure['quote'];
    $cite = $structure['cite'];
?>

<div class="quote-block">
    <div class="container">
        <div class="row">
            <?php if($quote_image): ?>
            <div class="col-md-6">
                <div class="quote-block__image">
                    <?= wp_get_attachment_image($quote_image, 'full'); ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-md-6">
                <div class="quote-block__inner">
                    <div class="quote-block__quote">
                        <blockquote>
                            <?= $quote; ?>
                        </blockquote>
                    </div>
                    <div class="quote-block__cite">
                        <cite>- <?= $cite; ?></cite>
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>