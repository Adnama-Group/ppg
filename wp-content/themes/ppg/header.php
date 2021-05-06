<?php
    // Fields
    $top_portion = get_field('top_portion', 'option');
    $logo = get_field('logo', 'option');
    // User
    $current_user_id = get_current_user_id();
    if( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $roles = ( array ) $user->roles;
    }
    $isMember = $current_user_id !== 0 ? 'member' : 'nam';
    $role = get_user_role($current_user_id);
    $userRole = strpos($role, 'breeder') ? 'breeder' : 'community';
    // var_dump($userRole );
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'logged-in--' . $userRole ); ?>>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ppg' ); ?></a>
    
<header class="site-header site-header--<?= $isMember; ?>" role="banner">
    <?php /*
    <section class="site-header__top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <?php if($menu = $top_portion['menu']): ?>
                    <nav>
                        <?php if( $current_user_id === 0): ?>
                            <?php foreach($menu as $menu_item): ?>
                                <a class="<?= $menu_item['is_button'] ? 'button button--primary' : 'link link--secondary'; ?>" href="<?= $menu_item['menu_links']['url']; ?>" target="<?= $menu_item['menu_links']['target']; ?>"><?= $menu_item['menu_links']['title']; ?></a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <button class="button-menu" data-target="#sim">
                                Hi, <?= get_user_meta( $current_user_id, 'first_name', true ); ?>
                            </button>
                            <div id="sim" class="signed-in-menu">
                                <a href="<?= home_url(); ?>/account">My Account</a>
                                <a href="<?= home_url(); ?>/profile">Profile</a>
                                <a href="<?= home_url(); ?>/logout">Logout</a>
                            </div>
                        <?php endif; ?>
                    </nav>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 order-md-1 d-flex align-items-center">
                    <?php if($link = $top_portion['link']): ?>
                        <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>" class="link link--primary text--uppercase"><?= $link['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="site-header__bottom">
        <div class="container">
            <nav class="navbar navbar-light <?= strpos($roles[0], 'breeder') == false ? 'navbar-expand-xl' : null; ?> ">
                <div class="navbar-brand">
                    <?php if ( $logo ): ?>
                        <a href="<?= home_url(); ?>">
                            <?= wp_get_attachment_image($logo, 'full'); ?>
                        </a>
                    <?php else : ?>
                        <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                    <?php endif; ?>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                    wp_nav_menu(array(
                        'container_id'    => 'main-nav',
                        'theme_location'  => 'header_menu',
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse justify-content-end',
                        'menu_class'      => 'navbar-nav',
                    ));
                ?>

                <div class="navbar__form">
                    <?= get_template_part('/template-parts/search-pets-form', null); ?>
                </div>
            </nav>
        </div>
    </section>*/ ?>

    <section class="site-header__container">
        <div class="site-header__link">
            <?php
                $link = $top_portion['link'];
                if($link && $current_user_id === 0): ?>
                <a href="<?= $link['url']; ?>" target="<?= $link['target']; ?>" class="link link--primary text--uppercase"><?= $link['title']; ?></a>
            <?php else: ?>
                <?php if($userRole === 'breeder'): ?>
                    <a href="<?= home_url(); ?>/list-your-pet"><i class="fas fa-dog"></i> List Your Pet</a>
                <?php else: ?>
                    <a href="<?= home_url(); ?>/choose-animal-type"><i class="fas fa-dog"></i> Find Your Pet</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if( $current_user_id !== 0): ?>
        <div class="site-header__user-menu-btn">
            <button class="button-menu navbar-toggler" type="button" data-toggle="collapse" data-target="#sim" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                Hi, <?= get_user_meta( $current_user_id, 'first_name', true ); ?>
            </button>
        </div>
        <?php endif; ?>

        <div class="site-header__user-menu">
            <?php if($menu = $top_portion['menu']): ?>
                <nav id="sim" class="collapse navbar-collapse">
                    <?php if( $current_user_id === 0): ?>
                        <?php foreach($menu as $menu_item): ?>
                            <a class="<?= $menu_item['is_button'] ? 'button button--primary' : 'button button--secondary'; ?>" href="<?= $menu_item['menu_links']['url']; ?>" target="<?= $menu_item['menu_links']['target']; ?>"><?= $menu_item['menu_links']['title']; ?></a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="signed-in-menu">
                            <a href="<?= home_url(); ?>/profile/?profiletab=messages">Inbox</a>
                            <a href="<?= home_url(); ?>/list-your-pet" class="d-md-block d-lg-none">List Your Pet</a>
                            <?php if($userRole === 'breeder'): ?>
                            <a href="<?= home_url(); ?>/profile/?profiletab=listings">Listings</a>
                            <a href="<?= home_url(); ?>/profile">Profile</a>
                            <?php endif; ?>
                            <a href="<?= home_url(); ?>/account">Settings</a>
                            <a href="<?= home_url(); ?>/logout">Logout</a>
                        </div>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>

            <div class="site-header__user-menu-search">
                <?= get_template_part('/template-parts/search-pets-form', null); ?>
            </div>
        </div>

        <div class="site-header__logo">
            <?php if ( $logo ): ?>
                <a href="<?= home_url(); ?>">
                    <?= wp_get_attachment_image($logo, 'full'); ?>
                </a>
            <?php else : ?>
                <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
            <?php endif; ?>
        </div>

        <div class="site-header__nav-btn">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
            </button>
        </div>

        <div class="site-header__nav">
            <nav class="navbar navbar-light <?= $current_user_id === 0 ? 'navbar-expand-lg' : null; ?> ">
                <?php
                    wp_nav_menu(array(
                        'container_id'    => 'main-nav',
                        'theme_location'  => 'header_menu',
                        'container'       => 'div',
                        'container_class' => 'collapse navbar-collapse justify-content-end',
                        'menu_class'      => 'navbar-nav',
                    ));
                ?>
            </nav>
        </div>

        <div class="site-header__form">
            <?= get_template_part('/template-parts/search-pets-form', null); ?>
        </div>
    </section>

</header>