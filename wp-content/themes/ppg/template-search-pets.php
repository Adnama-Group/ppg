<?php
/*
Template name: Search Pets
*/

get_header();
$sidebar = get_field('sidebar');
$main = get_field('main'); ?>

<div class="search-pets">
    <div class="container">
        <!-- <div id="search-pets"></div> -->
        <div class="row">
            <aside class="col-md-3">
                <?php //= do_shortcode('[searchandfilter id="2624"]'); ?>
                <?= do_shortcode($sidebar); ?>
            </aside>
            <div class="col-md-9">
                <?php //= do_shortcode('[searchandfilter id="2624" show="results"]'); ?>
                <?= do_shortcode($main); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
