<?php
	if (!is_admin()) {
		if (get_option('wpe_style')=="css") {
			add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
			function theme_enqueue_styles() {
				wp_enqueue_style('theme-main', get_stylesheet_directory_uri().'/css/style.css');
			}
		} else if (get_option('wpe_style')=="sass") {
			if (!file_exists(get_stylesheet_directory().'/css/style.scss')) {
				fopen(get_stylesheet_directory().'/css/style.scss', 'w');
			}
			if (!file_exists(get_stylesheet_directory().'/css/style_sass.css')) {
				fopen(get_stylesheet_directory().'/css/style_sass.css', 'w');
			}
			require('sass/sass.php');
			function generate_css() {
				if(function_exists('wpsass_define_stylesheet')) {
					wpsass_define_stylesheet('style.scss');
				}
			}
			add_action('wp_enqueue_scripts', 'generate_css');
		} else if (get_option('wpe_style')=="less") {
			if (!file_exists(get_stylesheet_directory().'/css/style.less')) {
				fopen(get_stylesheet_directory().'/css/style.less', 'w');
			}
			add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
			function theme_enqueue_styles() {
				wp_enqueue_style('theme-main', get_stylesheet_directory_uri().'/css/style.less');
			}
		}
	}