<?php
	/* Template name: Sign Up */
    get_header('default');

    $breeder_sign_up_shortcode = get_field('breeder_sign_up_shortcode');
    $community_sign_up_shortcode = get_field('community_sign_up_shortcode');
?>

<div class="registration">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <header class="registration__header">
                    <h2 class="heading heading--lg">Welcome!</h2>
                    <p class="heading--lg">Let's create your free account</p>
                </header>
                <div class="registration__content">
                    <div class="registration__title">
                        <h2 class="heading--default">Choose what you would like to do</h2>
                        <div class="switch__buttons">
                            <button data-switch="breeder" class="btn btn--light active">I'm interested in listing pets</button>
                            <button data-switch="member" class="btn btn--light">I want to find a pet</button>
                        </div>
                    </div>
                    <div id="breeder" class="registration__form active">
                        <?= do_shortcode( $breeder_sign_up_shortcode ); ?>
                    </div>
                    <div id="member" class="registration__form">
                        <?= do_shortcode( $community_sign_up_shortcode ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('default'); ?>