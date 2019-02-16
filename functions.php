<?php

/**
 * Set up theme options on activation
 */

function vue_wordpress_setup()
{

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'custom-logo', array(
        'height' => 160,
        'width' => 160,
    ) );

    register_nav_menus( array(
        'main' => 'Main Menu',
    ) );

}

add_action( 'after_setup_theme', 'vue_wordpress_setup' );

/**
 * Load scripts and styles
 */

function vue_wordpress_scripts()
{
    wp_enqueue_style( 'style.css', get_template_directory_uri() . '/style.css' );
    // Enable For Production - Disable for Development
    // wp_enqueue_style('vue_wordpress.css', get_template_directory_uri() . '/dist/vue-wordpress.css');
    // wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), null, true);
    // Enable For Development - Remove for Production
    wp_enqueue_script( 'vue_wordpress.js', 'http://localhost:8080/vue-wordpress.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'vue_wordpress_scripts' );

/**
 * Declare REST API Data Localizer dependency
 */

if ( !class_exists( 'RADL' ) ) {
    add_action( 'admin_notices', function () {
        echo '<div class="error"><p>REST API Data Localizer not activated. To use this theme go to <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">plugins</a> to download and/or activate REST API Data Localizer.</p></div>';
    } );
    return;
}

/**
 * Initialize REST API Data Localizer
 */

new RADL( '__VUE_WORDPRESS__', 'vue_wordpress.js', array(
    'state' => array(
        'site' => RADL::callback( 'vue_wordpress_site' ),
    ),
) );

/**
 * REST API Data Localizer callbacks
 */

function vue_wordpress_site()
{
    return array(
        'description' => get_bloginfo( 'description' ),
        'logo' => get_theme_mod( 'custom_logo' ),
        'name' => get_bloginfo( 'name' ),
        'posts_per_page' => get_option( 'posts_per_page' ),
    );

}
