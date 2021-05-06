<?php
/* Template Name: Breeder Landing */
get_header('pets'); 

// SEO
$page_title = get_field('hidden_page_title');

// Hero
$hero_background_image = get_field('hero_background_image');
$hero_title = get_field('hero_title');
$hero_content = get_field('hero_content');
$hero_button = get_field('hero_button');

// Snippets
$snippets = get_field('snippets'); 

// Callout Primary
$callout_background = get_field('callout_background');
$callout_title = get_field('callout_title');
$callout_content = get_field('callout_content');

// Table
$table_title = get_field('table_title');
$table_content = get_field('table_content');

// Callout Secondary
$callout_background_secondary = get_field('callout_background_secondary');
$callout_title_secondary = get_field('callout_title_secondary');
$callout_content_secondary = get_field('callout_content_secondary');

// FAQ
$faq_title = get_field('faq_title');
$faq_content = get_field('faq_content');
$faq_image = get_field('faq_image');
$faqs = get_field('faqs');

?>

<div class="hero" style="background-image: url(<?= $hero_background_image['url']; ?>)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="hero__content text-center text-white">
                    <?php if( !empty($page_title) ): ?>
                        <h1 class="screen-reader-text"><?= $page_title; ?></h1>
                    <?php endif; ?>

                    <?php if( !empty($page_title) ): ?>
                        <h2 class="heading heading--xl heading--light"><?= $hero_title; ?></h2>
                    <?php endif; ?>

                    <?php if($hero_content): ?>
                        <p><?= $hero_content ?></p>
                    <?php endif; ?>

                    <?php if( !empty($hero_button['url'])): ?>
                        <p><a href="<?= $hero_button['url']; ?>" target="<?= $hero_button['target']; ?>" class="btn btn--primary btn--white-border"><?= $hero_button['title']; ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if( count($snippets) !== 0): ?>
<div class="snippets">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach($snippets as $snippet): ?>
            <div class="col-md-4">
                <div class="snippets__block text-center">
                    <img src="<?= $snippet['snippet_icon']['url']; ?>" />
                    <h2 class="heading heading--sm"><?= $snippet['snippet_title']; ?></h2>
                    <p><?= $snippet['snippet_content']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="callout" style="background-image: url(<?= $callout_background['url']; ?>)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="heading heading--lg"><?= $callout_title; ?></h2>
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                <?= $callout_content; ?>
            </div>
        </div>
    </div>
</div>

<div class="plans">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 text-center plans__content">
                <h2 class="heading heading--lg"><?= $table_title; ?></h2>
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                <?= $table_content; ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table--desktop">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="table__head-image">
                                    <img src="<?= get_stylesheet_directory_uri(); ?>/img/horse-head.png" alt="" />
                                </th>
                                <th></th>
                                <!-- <th class="table__head table__head--first">
                                    <span>Basic</span>
                                    FREE
                                </th>
                                <th class="table__head">
                                    <span>Plus</span>
                                    $9.99
                                </th> -->
                                <th class="table__head table__head--last">
                                    <!-- <span>Professional</span> -->
                                    <!-- $19.99 -->
                                    FREE
                                </th>
                            </tr>
                            <!-- One -->
                            <tr>
                                <td rowspan="4"><strong>Breeder Marketing</strong></td>
                                <td>Professional Breeder Profile Page</td>
                                <!-- <td>Included</td>
                                <td>Included</td> -->
                                <td>Included</td>
                            </tr>
                            <tr>
                                <td>SEO Links to Breeder Websites & Social Pages</td>
                                <!-- <td>Included</td>
                                <td>Included</td> -->
                                <td>Included</td>
                            </tr>
                            <tr>
                                <td>Connect with Community Members</td>
                                <!-- <td>Included</td>
                                <td>Included</td> -->
                                <td>Included</td>
                            </tr>
                            <tr>
                                <td>Breeder Messaging Box</td>
                                <!-- <td>Included</td>
                                <td>Included</td> -->
                                <td>Included</td>
                            </tr>
                            <!-- End One -->
                            <!-- Two -->
                            <tr>
                                <td class="cell-blue" rowspan="5"><strong>Pet Listings & Ads</strong></td>
                                <td class="cell-blue-dark">Listings</td>
                                <!-- <td class="cell-blue-dark">1</td>
                                <td class="cell-blue-dark">3</td> -->
                                <td class="cell-blue-dark">Unlimited</td>
                            </tr>
                            <tr>
                                <td class="cell-blue">Pictures Per Listing</td>
                                <!-- <td class="cell-blue">Up to 3</td>
                                <td class="cell-blue">Unlimited</td> -->
                                <td class="cell-blue">Unlimited</td>
                            </tr>
                            <tr>
                                <td class="cell-blue">Video</td>
                                <!-- <td class="cell-blue">X</td>
                                <td class="cell-blue">Included</td> -->
                                <td class="cell-blue">Included</td>
                            </tr>
                            <tr>
                                <td class="cell-blue">Coming Soon Listings</td>
                                <!-- <td class="cell-blue">X</td>
                                <td class="cell-blue">Included</td> -->
                                <td class="cell-blue">Included</td>
                            </tr>
                            <tr>
                                <td class="cell-blue">Social Media & Email Spotlights</td>
                                <!-- <td class="cell-blue">X</td>
                                <td class="cell-blue">X</td> -->
                                <td class="cell-blue">Included</td>
                            </tr>
                            <!-- End Two -->
                            <!-- Three -->
                            <tr>
                                <td class="cell-orange"><strong>Breeder Verification</strong></td>
                                <td class="cell-orange">Standout with Pet Pet Goose Verification Designation</td>
                                <!-- <td class="cell-orange">X</td>
                                <td class="cell-orange">X</td> -->
                                <td class="cell-orange">Included</td>
                            </tr>
                            <!-- End Three -->
                            <!-- Btns -->
                            <tr>
                                <td></td>
                                <td></td>
                                <!-- <td><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Start For Free</a></td>
                                <td><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Register Today</a></td> -->
                                <td><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">
                                    <!-- Become A Pro -->
                                    Register Today
                                </a></td>
                            </tr>
                            <!-- End Btns -->
                        </tbody>
                    </table>
                </div>
                <div class="table--mobile">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th colspan="2" class="table__head">
                                    <!-- <span>Professional</span>
                                    $19.99 -->
                                    FREE
                                </th>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Breeder Marketing</strong></td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li>Professional Breeder Profile Page</li>
                                        <li>SEO Links to Breeder Websites & Social Pages</li>
                                        <li>Connect with Community Members</li>
                                        <li>Breeder Messaging Box</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-blue text-left"><strong>Pet Listings & Ads</strong></td>
                                <td class="cell-blue text-left">
                                    <ul class="list-unstyled">
                                        <li>Listings: 3</li>
                                        <li>Pictures Per Listing: Unlimited</li>
                                        <li>Coming Soon Listings</li>
                                        <li>Social Media & Email Spotlights</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-orange"><strong>Breeder Verification</strong></td>
                                <td class="cell-orange text-left">
                                    <ul class="list-unstyled">
                                        <li>Standout with Pet Pet Goose Verification Designation</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td colspan="2" ><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Become A Pro</a></td> -->
                                <td colspan="2" ><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Register Today</a></td>
                            </tr>
                            <!-- End Btns -->
                        </tbody>
                    </table>
                <?php /*
                    <table class="table">
                        <tbody>
                            <tr>
                                <th colspan="2" class="table__head">
                                    <span>Plus</span>
                                    $9.99
                                </th>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Breeder Marketing</strong></td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li>Professional Breeder Profile Page</li>
                                        <li>SEO Links to Breeder Websites & Social Pages</li>
                                        <li>Connect with Community Members</li>
                                        <li>Breeder Messaging Box</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-blue text-left"><strong>Pet Listings & Ads</strong></td>
                                <td class="cell-blue text-left">
                                    <ul class="list-unstyled">
                                        <li>Listings: 3</li>
                                        <li>Pictures Per Listing: Unlimited</li>
                                        <li>Coming Soon Listings</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" ><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Register Today</a></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th colspan="2" class="table__head">
                                    <span>Basic</span>
                                    FREE
                                </th>
                            </tr>
                            <tr>
                                <td class="text-left"><strong>Breeder Marketing</strong></td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li>Professional Breeder Profile Page</li>
                                        <li>SEO Links to Breeder Websites & Social Pages</li>
                                        <li>Connect with Community Members</li>
                                        <li>Breeder Messaging Box</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-blue text-left"><strong>Pet Listings & Ads</strong></td>
                                <td class="cell-blue text-left">
                                    <ul class="list-unstyled">
                                        <li>Listings: 1</li>
                                        <li>Pictures Per Listing: 3</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" ><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary">Start For Free</a></td>
                            </tr>
                        </tbody>
                    </table>
                    */ ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="callout" style="background-image: url(<?= $callout_background_secondary['url']; ?>)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="heading heading--lg"><?= $callout_title_secondary; ?></h2>
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                <?= $callout_content_secondary; ?>
            </div>
        </div>
    </div>
</div>

<div class="faqs">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center faqs__content">
                <h2 class="heading heading--lg"><?= $faq_title; ?></h2>
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                <?= $faq_content; ?>
                <div class="faqs__image">
                    <img src="<?= $faq_image['url']; ?>" alt="<?= $faq_image['url']; ?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($faqs as $faq): ?>
                <div class="col-md-6">
                    <div class="faq">
                        <h2 class="heading heading--sm"><?= $faq['question']; ?></h2>
                        <p><?= $faq['answer']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row justify-content-center">
            <div class="col text-center">
                <div class="faqs__button">
                    <p><a href="<?= home_url(); ?>/sign-up" class="btn btn--primary btn--white-border">Register Now</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('pets'); ?>