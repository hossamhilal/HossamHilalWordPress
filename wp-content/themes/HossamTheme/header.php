<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php $theme_data = get_option('theme_setting_data', true); ?>
    <link rel="icon" href="<?php echo $theme_data['favIcon']; ?>" type="image/x-icon" />
    <title> <?= $theme_data['title']; ?> </title>

    <?php wp_head(); ?>
</head>

<body>

<!-- MAIN HEADER  -->
<div class="mainHeader<?php if ( !is_home() ) : echo (' internalHeader'); endif; ?>">
    <div class="container">

        <div class="mainNav">
            <a href="<?php echo home_url(); ?>" class="logo">
                <img src="<?php echo $theme_data['headerLogo']; ?>" alt="logo" class="img-fluid">
            </a>
            <div class="mainMenu">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'header-menu',
                        'container' => '',
                        'container_class' => false,
                        'menu_class' => '',
                        'menu_id' => '',
                        'depth' => 3,
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                        'walker' => new WP_Bootstrap_Navwalker(),
                    )
                );
                ?>
            </div>
            <div class="mainBtns">
                <div class="searchBtn">  <i class="icofont-search-1"></i> </div>
                <a class="orangeBtn contactBtn" href="contact.html"> <span> contact us </span> </a>
                <div class="mainMenuBtn"> <span></span> <span></span> <span></span> </div>
            </div>
        </div>

        <?php
            if ( is_front_page() && is_home() ) {
                get_template_part('templateParts/mainHeaderData');
            } else {
                get_template_part('templateParts/internalHeaderData');
            }
        ?>

        <div class="navOverlay"></div>
    </div>
</div>


<!-- Search  -->
<?php get_template_part('templates-parts/shared/search'); ?>

<!-- Loader  -->
<?php get_template_part('templates-parts/loader'); ?>
