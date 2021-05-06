<?php
    // Search Block Animal Component
    $search_style = $structure['search_style'] ? 'animals__search--' . $structure['search_style'] : null;
    $search_description = $structure['search_description'] ? $structure['search_description'] : null;
    $input_placeholder = $structure['input_placeholder'] ? $structure['input_placeholder'] : 'Search for ' . get_the_title() . 's for sale';
?>

<div class="animals__search <?= $search_style; ?>">
    <span class="triangle-edge triangle-edge--left"></span>
    <div class="row">
        <div class="<?= $search_style ? 'col-md-12' : 'col-md-6'; ?>">
            <div class="animals__search-description">
                <?= $search_description; ?>
            </div>
        </div>
        <div class="<?= $search_style ? 'col-md-12' : 'col-md-6'; ?>">
            <form class="form form--search-pets" action="<?= home_url(); ?>/search-pets/?woof_text=">
                <input type="text" placeholder="<?= $input_placeholder; ?>" value="" name="woof_text" id="s">
                <button type="submit">Search</button>
            </form> 
        </div>
    </div>
    <span class="triangle-edge triangle-edge--right"></span>
</div>