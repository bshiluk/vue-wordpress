<?php

function hybrid_vue_wp_scripts() {
    wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css');
    // Enable For Production - Disable for Development
    // wp_enqueue_style('hybrid_vue_wp.css', get_template_directory_uri() . '/dist/hybrid-vue-wp.css');
    // wp_enqueue_script('hybrid_vue_wp.js', get_template_directory_uri() . '/dist/hybrid-vue-wp.js', array(), null, true);
    // Enable For Development - Remove for Production
    wp_enqueue_script('hybrid_vue_wp.js', 'http://localhost:8080/hybrid-vue-wp.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'hybrid_vue_wp_scripts');
