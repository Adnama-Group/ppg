<?php
/**
 * 
 *  Contact Bar
 * 
 */
    $email = get_field('contact_email', 'option');
?>

 <div class="contact-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-bar__email">
                    <p>Email Us: <a href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-bar__social">
                    Follow Us: <?= get_template_part('template-parts/social', null, ['primary']); ?>
                </div>
            </div>
        </div>
    </div>
 </div>