<?php
/**
 * Theme Functions
 */

function thebetterco_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array('primary' => 'Primary Menu'));
}
add_action('after_setup_theme', 'thebetterco_setup');

function thebetterco_styles() {
    wp_enqueue_style('thebetterco-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'thebetterco_styles');
