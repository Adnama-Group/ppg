<?php
    /**
     * Styles to Choose From
     * expected @array[ string = style ]
     * Primary - Inline
     */
    if(empty($args[0])) return "Style Needed to Render";
    $style = $args[0];
    $facebook = get_field('facebook', 'option');
    $twitter = get_field('twitter', 'option');
    $instagram = get_field('instagram', 'option');
?>


<ul class="list-unstyled list--social list--social-<?= $style; ?>">
    <?php if($facebook): ?>
        <li><a href="<?= $facebook; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <?php endif; ?>
    <?php if($twitter): ?>
        <li><a href="<?= $twitter; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
    <?php endif; ?>
    <?php if($instagram): ?>
        <li><a href="<?= $instagram; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
    <?php endif; ?>
</ul>