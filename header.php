<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container">
        <div class="logo">
            <?php the_custom_logo(); ?>
        </div>
        <nav class="nav-menu">
            <?php wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id' => 'primary-menu',
            )); ?>
        </nav>
        <button class="menu-toggle">Menu</button>
        <div class="profile-menu">
            <!-- Profile menu with user image -->
        </div>
    </div>
</header>
<div id="content" class="site-content">
