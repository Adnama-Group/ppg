<?php get_header(); ?>

<div class="container">
    <div class="row align-items-center text-uppercase" id="main-404-content">
        <div class="col-lg-6">
            <h1 class="screen-reader-text">Page Does Not Exist</h1>
            <p class="heading heading--xxl heading--red">hmmm...</p>
            <h2 class="heading heading--red">404 - Page Not Found</h2>
            <p class="heading heading--lg">Are you lost? You need to go <a class="text--red" href="<?= home_url(); ?>">home</a> my friend.</p>
        </div>
        <div class="col-lg-6">
            <img src="<?= get_stylesheet_directory_uri(); ?>/img/confused-german-sheperd.png" />
        </div>
    </div>

</div>

<?php
get_footer();
