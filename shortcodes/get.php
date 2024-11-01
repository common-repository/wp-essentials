<?php
	// Shortcode Setup
		if (!function_exists('wpe_get')) {
			function wpe_get($atts,$content) {
				extract(
					shortcode_atts(
						array(
							'query' => NULL,
							'value' => NULL,
							'display' => NULL
						),
						$atts
					 )
				);
				if ($query && $value) {
					if ($_GET[$query] == $value) {
						return $content;
					}
				} else if ($query) {
					if ($_GET[$query]) {
						return $content;
					}
				} else if ($display) {
					return $_GET[$display];
				}
			}
			add_shortcode('wpe_get','wpe_get');
		}