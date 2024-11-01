<?php
	if (current_user_can('administrator') && !is_admin()) {
		function maintenance_mode() {
			ini_set('display_errors',1); 
			error_reporting(E_ALL);
			include('php-error.php');
			\php_error\reportErrors(array(
				'wordpress' => true
			));
			echo '<div id="debug_mode" style="position:fixed;z-index:999;bottom:20px;right:20px;padding:10px;background:#0c3;color:#fff;font-size:14px;line-height:14px;border-radius:3px;">Debug Mode: No errors found. <a href="/wp-admin/admin.php?page=wp-essentials#wpe_debug_mode" style="color:#fff;text-decoration:underline;">Disable</a></div>';
		}
		add_action('wp_footer', 'maintenance_mode');
	}
