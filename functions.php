<?php

function vue_wordpress_scripts() {
    wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css');
    // Enable For Production - Disable for Development
    // wp_enqueue_style('vue_wordpress.css', get_template_directory_uri() . '/dist/vue-wordpress.css');
    // wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), null, true);
    // Enable For Development - Remove for Production
    wp_enqueue_script('vue_wordpress.js', 'http://localhost:8080/vue-wordpress.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'vue_wordpress_scripts');
