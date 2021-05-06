<?php

    get_header('pets');

    $background_type = get_field('background_type');

    $hero_image = get_field('hero_image');
    $hero_content = get_field('hero_content');

    $gs_title = get_field('gs_title');
    $gs_image = get_field('gs_image');
    $gs_content = get_field('gs_content');

    $db_title = get_field('db_title');
    $db_image = get_field('db_image');
    $db_content = get_field('db_content');

    $bs_white_bg = get_field('white_background');
    $bs_blue_bg = get_field('blue_background');

    $start_now = get_field('start_now');
    $additional_top_description = get_field('additional_top_description');
    $additional_descriptions = get_field('additional_descriptions');
    $additional_bottom_description = get_field('additional_bottom_description');

    $newsletter_bg = is_int(get_field('newsletter_background_image')) ? wp_get_attachment_url(get_field('newsletter_background_image')) : get_home_url() . '/wp-content/uploads/2020/11/dog-cat-touch.png' ;
    $newsletter_content = get_field('newsletter_content');

    $facts = get_field('facts');

    $contract_image = get_field('contract_image');
    $contract_content = get_field('contract_content');

    $conclusion_image = get_field('conclusion_image');
    $conclusion_content = get_field('conclusion_content');

    $articles = get_posts(array(
        'numberposts'   => 3,
        'orderby'        => 'rand'
    ));

?>

<div class="pets pets--bg-<?= $background_type; ?>">
    
    <div class="pets__hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="pets__content-block pets__content-block--2x">
                        <div class="pets__content-block-inner">
                            <h1 class="heading"><?= get_the_title(); ?> <br /> Puppies For Sale</h1>
                            <?= $hero_content['content']; ?>
                            <?php if($hero_content['button']): ?>
                                <a class="btn btn--primary btn--white-border btn--large" href="<?= $hero_content['button']['url']; ?>" target="<?= $hero_content['button']['target']; ?>"><?= $hero_content['button']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <?php if($hero_image): ?>
                        <?= wp_get_attachment_image($hero_image, 'full'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if( !empty($gs_content['content']) ): ?>
    <div class="pets__about">
        <div class="container">
            <div class="row">
                <div class="col-md-5 d-none d-md-block">
                    <?php if($gs_image): ?>
                        <?= wp_get_attachment_image($gs_image, 'full'); ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    <div class="pets__content-block">
                        <h2 class="heading heading--light"><?= $gs_title ? $gs_title : 'Getting Started' ; ?></h2>
                        <div class="divider">
                            <img src="<?= get_stylesheet_directory_uri(); ?>/img/Seperator.png" alt="" />
                        </div>
                        <?= $gs_content['content']; ?>
                        <?php if($gs_content['button']): ?>
                            <a class="btn btn--primary btn--white-border btn--large" href="<?= $gs_content['button']['url']; ?>" target="<?= $gs_content['button']['target']; ?>"><?= $gs_content['button']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if( !empty($db_content['content']) ): ?>
    <div class="pets__decisions">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="pets__content-block">
                        <h2 class="heading"><?= $db_title ? $db_title : 'A Life-Changing Decision' ; ?></h2>
                        <div class="divider">
                                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                            </div>
                        <?= $db_content['content']; ?>
                        <?php if($db_content['button']): ?>
                            <a class="btn btn--primary btn--white-border btn--large" href="<?= $db_content['button']['url']; ?>" target="<?= $db_content['button']['target']; ?>"><?= $db_content['button']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-5 d-none d-md-flex align-items-center">
                    <?php if($db_image): ?>
                        <?= wp_get_attachment_image($db_image, 'full'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if( !empty($bs_white_bg['bs_content']) ) : ?>
    <div class="pets__selection">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="pets__content-block pets__content-block--gray">
                        <div class="pets__content-block-inner">
                            <h2 class="heading"><?= !empty($bs_white_bg['bs_content']['title']) ? $bs_white_bg['bs_content']['title'] : 'Select the Right Breeder'; ?></h2>
                            <div class="divider">
                                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                            </div>
                            <?= $bs_white_bg['bs_content']['content']; ?>
                            <?php if(!empty($bs_white_bg['bs_content']['button'])): ?>
                                <div class="pets__btn text-center">
                                    <a class="btn btn--primary btn--white-border btn--large" href="<?= $bs_white_bg['bs_content']['button']['url']; ?>" target="<?= $bs_white_bg['bs_content']['button']['target']; ?>"><?= $bs_white_bg['bs_content']['button']['title']; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($bs_white_bg['bs_image'])): ?>
                            <div class="pets__selection-img d-none d-md-block">
                                <?= wp_get_attachment_image($bs_white_bg['bs_image'], 'medium-large'); ?>
                            </div> 
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if( !empty($bs_blue_bg['blue_content']['content']) ): ?>
    <div class="pets__selection pets__selection--secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-5 d-none d-md-block">
                    <?php if(!empty($bs_blue_bg['blue_image'])): ?>
                        <div class="pets__selection-img d-none d-md-block">
                            <?= wp_get_attachment_image($bs_blue_bg['blue_image'], 'medium-large'); ?>
                        </div> 
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    <div class="pets__content-block">
                        <h2 class="heading heading--light"><?= $bs_blue_bg['blue_content']['title'] ? $bs_blue_bg['blue_content']['title'] : 'Find an Excellent Breeder' ; ?></h2>
                        <div class="divider">
                            <img src="<?= get_stylesheet_directory_uri(); ?>/img/Seperator.png" alt="" />
                        </div>
                        <?= $bs_blue_bg['blue_content']['content']; ?>
                        <?php if($bs_blue_bg['blue_content']['button']): ?>
                            <a class="btn btn--primary btn--white-border btn--large" href="<?= $bs_blue_bg['blue_content']['button']['url']; ?>" target="<?= $bs_blue_bg['blue_content']['button']['target']; ?>"><?= $bs_blue_bg['blue_content']['button']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="pets__start">

        <div class="container">
            <div class="row d-flex align-items-center <?= $start_now['reverse'] ? 'flex-row-reverse' : ''; ?>">
                <div class="col-md-6 order-md-2">
                    <div class="pets__content-block">
                        <div class="pets__content-block-inner">
                            <h2><?= $start_now['title'] ? $start_now['title'] : 'Start Now - Search for Puppies'; ?></h2>
                            <div class="divider">
                                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                            </div>
                            <?= $start_now['content']; ?>
                            <?php if($start_now['button']): ?>
                                <a class="btn btn--primary btn--white-border" href="<?= $start_now['button']['url']; ?>" target="<?= $start_now['button']['target']; ?>"><?= $start_now['button']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?= wp_get_attachment_image($start_now['image'], 'large');?>
                </div>
            </div>
        </div>

        

        <?php if( !empty($additional_descriptions) || !empty($additional_top_description) || !empty($additional_bottom_description) ): ?>
        <div class="container">
            <div class="divider divider--large">
                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider-large.png" alt="" />
            </div>
        </div>

            <div class="pets__descriptions">
                <div class="container">
                    <?php if( !empty($additional_top_description) ): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pets__content-block">
                                <?= $additional_top_description; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if( !empty($additional_descriptions) ): ?>
                    <div class="row">
                        <div class="col-md-12">
                            
                                <div class="pets__descriptions-inner">
                                    <?php foreach( $additional_descriptions as $description ) : ?>
                                    <div class="pets__description">
                                        <h2 class="heading"><?= $description['title']; ?></h2>
                                        <?= $description['content']; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if( !empty($additional_bottom_description) ): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pets__content-block">
                                <?= $additional_bottom_description; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            

        <?php endif; ?>
    </div>
    
    <div class="pets__newsletter" style="background-image: url(<?= $newsletter_bg; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="pets__content-block">
                        <h2 class="heading heading--light">Newsletter</h2>
                        <div class="divider">
                            <img src="<?= get_stylesheet_directory_uri(); ?>/img/Seperator.png" alt="" />
                        </div>
                        <p><?= $newsletter_content; ?></p>
                        <form class="form form--newsletter homepage">
                            <input type='text' placeholder='Enter Your Email' class='input input--text' />
                            <button class="btn btn--primary btn--white-border" type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if( !empty($facts) ): ?>
    <div class="pets__facts">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="heading text-center">Did you know? <?= count($facts); ?> Fun Facts</h2>
                    <div class="divider">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <?php foreach($facts as $i => $fact): ?>
                <?php $number = $i  +1; ?>
                <div class="col-md-4">
                    <div class="fact">
                        <div class="fact__number">
                            <?= $number; ?>
                        </div>
                        <div class="fact__content">
                            <?php if($fact['title']): ?>
                                <h3 class="heading heading--sm"><?= $fact['title']; ?></h3>
                            <?php endif; ?>
                            <?php if($fact['content']): ?>
                                <p><?= $fact['content']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="two-columns two-columns--bg-primary">
        <div class="container-fluid">
            <div class="row just-content-center">
                <div class="two-columns__content col-md-6">
                    <div class="two-columns__content-inner">
                        <h2 class="heading heading--contrast">Contract</h2>
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/Seperator.png" />
                        <?= $contract_content['content']; ?>
                        <?php if($contract_content['button']): ?>
                            <a class="btn btn--primary btn--white-border btn--large" href="<?= $contract_content['button']['url']; ?>" target="<?= $contract_content['button']['target']; ?>"><?= $contract_content['button']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="two-columns__image col-md-6  d-none d-md-flex align-items-center">
                    <figure>
                        <?php if( is_int($contract_image) ): ?>
                            <?= wp_get_attachment_image($contract_image, 'full');?>
                        <?php else: ?>
                            <img src="<?= get_stylesheet_directory_uri(); ?>/img/contract.png" alt="Image of a signed contract" />
                        <?php endif; ?>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div class="pets__conclusion">
        <div class="container">
            <div class="row">
                <?php if($conclusion_content): ?>
                    <div class="col-md-5 d-none d-md-flex d-md-block">
                        <div class="pets__conclusion-img">
                            <?= wp_get_attachment_image($conclusion_image, 'medium-large'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-7">
                    <div class="pets__content-block pets__content-block--gray">
                        <div class="pets__content-block-inner">
                            <h2 class="heading">Conclusion</h2>
                            <div class="divider">
                                <img src="<?= get_stylesheet_directory_uri(); ?>/img/divider.png" alt="" />
                            </div>
                            <?= $conclusion_content['content']; ?>
                            <?php if($conclusion_content['button']): ?>
                                <div class="pets__btn">
                                    <a class="btn btn--primary btn--white-border btn--large" href="<?= $conclusion_content['button']['url']; ?>" target="<?= $conclusion_content['button']['target']; ?>"><?= $conclusion_content['button']['title']; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest-resources latest-resources--primary">
        <div class="latest-resources__container container">
            <div class="row">
                <div class="col-12">
                    <div class="latest-resources__description text-center">
                        <h2 class="heading heading--md heading--light text-center">More articles that may interest you</h2>
                        <div class="divider">
                            <img src="<?= get_stylesheet_directory_uri(); ?>/img/Seperator.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if($articles): foreach($articles as $article): ?>
                <div class="col-md-4">
                    <article class="post post--condensed">
                        <div class="post__image">
                            <a href="<?= get_permalink($article); ?>">
                                <?php 
                                    $main_image = get_field('main_image', $article);
                                    // var_dump($main_image);
                                    if( $main_image['url'] ) {
                                        echo "<img src='" . $main_image['url'] . "' />";
                                    } else {
                                        echo get_the_post_thumbnail($article, 'medium');
                                    }
                                ?>
                            </a>
                        </div>
                        <div class="post__cat">
                            <a href="<?= getResourceLink($article); ?>" class='<?= strtolower(str_replace(' ', '_', getResourceCategory($article))); ?> post__cat-button'><?= getResourceCategory($article);?></a>
                        </div>
                        <div class="post__meta">
                            <h2 class="post__title"><a href="<?= get_permalink($article); ?>"><?= get_the_title($article);?></a></h2>
                            <div class="post__content">
                                <p><?= wp_trim_words( get_the_content(null, false, $article), 22 ); ?></p>
                                <p><a class="text--uppercase text--red" href="<?= get_permalink($article); ?>">Read More</a></p>
                            </div>
                        </div>
                    </article>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>

</div>

<?php get_footer('pets');

