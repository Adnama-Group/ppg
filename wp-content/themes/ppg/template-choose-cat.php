<?php
/*
Template name: Choose Animal Type
*/


get_header(); ?>

	<section id="primary" class="content-area col-sm-12">
		<div id="main" class="site-main" role="main">

            <div class="choose-pet">
                <div class="container">
                    <div class="choose-pet__heading text-center">
                        <h1 class="heading heading--xl">Find Your Perfect Pet</h1>
                        <h2 class="text--primary heading--sm">Select or search for your desired animal</h2>
                        <?= do_shortcode("[pet_search]"); ?>
                    </div>
                    <div class="choose-pet__body">
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-3 text-center align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=cats">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/cat@2x.png" alt="Small gray striped kitten playing" class='img-fluid' />
                                    <p>Cats</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=dogs">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/Dogs@2x.png" alt="Golden retriever smiling" class='img-fluid mb-5' />
                                    <p>Dogs</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center  align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=horses">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/Horses@2x.png" alt="Brown mustang galloping" class='img-fluid' />
                                    <p>Horses</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center  align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=small-pets">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/Small-Pets@2x.png" alt="Fluffy white hamster" class='img-fluid mb-5' />
                                    <p>Small Pets</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=farm-life">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/Farm-Life@2x.png" alt="Young gray goat" class='img-fluid mb-5' />
                                    <p>Farm Life</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center align-self-end">
                                <a href="<?= home_url(); ?>/search-pets/?_sfm_listing_pet_type=reptiles">
                                    <img src="<?= home_url(); ?>/wp-content/uploads/2020/11/Reptiles@2x.png" alt="Small curious gecko" class='img-fluid' />
                                    <p>Reptiles &amp; Amphibians</p>
                                </a>
                            </div>
                            <div class="col-md-3 text-center  align-self-end">
                                <a href="/search-pets/?_sfm_listing_pet_type=birds">
                                    <img src="<?= get_stylesheet_directory_uri(); ?>/img/choose-birds.png" alt="Green and yellow with black Budgerigar" class='img-fluid mb-5' />
                                    <p>Birds</p>
                                </a>
                            </div>                                        
                        </div>
                    </div>
                </div>
            </div>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
