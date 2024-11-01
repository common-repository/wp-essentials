<?php
	global $wpdb;
	global $licence;

	// Upgrade Fixes
		if (!get_option('wpe_total_user_roles')) { update_option('wpe_total_user_roles',1); }
		if (!get_option('wpe_twitter_accounts') || get_option('wpe_twitter_accounts') < 1) {
			update_option('wpe_twitter_accounts',1);
		}
		
	// Update Settings
		if (isset($_POST['submitted'])) {
			update_option('wpe_cleanup',$_POST['cleanup']);
			update_option('wpe_lowercase_filenames',$_POST['lowercase_filenames']);
			delete_option('wpe_user_role_1');
			$edit_dashboard = (isset($_POST['1_edit_dashboard'])) ? 1 : 0;
			$edit_files = (isset($_POST['1_edit_files'])) ? 1 : 0;
			$edit_theme = (isset($_POST['1_edit_theme'])) ? 1 : 0;
			$manage_others_pages = (isset($_POST['1_manage_others_pages'])) ? 1 : 0;
			$manage_others_posts = (isset($_POST['1_manage_others_posts'])) ? 1 : 0;
			$manage_pages = (isset($_POST['1_manage_pages'])) ? 1 : 0;
			$manage_posts = (isset($_POST['1_manage_posts'])) ? 1 : 0;
			$manage_users = (isset($_POST['1_manage_users'])) ? 1 : 0;
			$manage_categories = (isset($_POST['1_manage_categories'])) ? 1 : 0;
			$manage_links = (isset($_POST['1_manage_links'])) ? 1 : 0;
			$manage_options = (isset($_POST['1_manage_options'])) ? 1 : 0;
			$manage_comments = (isset($_POST['1_manage_comments'])) ? 1 : 0;
			$manage_plugins = (isset($_POST['1_manage_plugins'])) ? 1 : 0;
			$update_core = (isset($_POST['1_update_core'])) ? 1 : 0;
			add_option('wpe_user_role_1',$_POST['1_user_role'].';'.$edit_dashboard.';'.$edit_files.';'.$edit_theme.';'.$manage_others_pages.';'.$manage_others_posts.';'.$manage_pages.';'.$manage_posts.';'.$manage_users.';'.$manage_categories.';'.$manage_links.';'.$manage_options.';'.$manage_comments.';'.$manage_plugins.';'.$update_core);
				update_option('wpe_total_user_roles',$_POST['wpe_total_user_roles']);
				include("system/user-roles.php");
			update_option('wpe_error_reports_google_analytics',$_POST['error_reports_google_analytics']);
			update_option('wpe_error_reports_search_engines',$_POST['error_reports_search_engines']);
			update_option('wpe_error_reports_check_username',$_POST['wpe_error_reports_check_username']);
			update_option('wpe_error_reports_check_holding',$_POST['wpe_error_reports_check_holding']);
			update_option('wpe_error_reports_check_licence',$_POST['wpe_error_reports_check_licence']);
			update_option('wpe_google_analytics',$_POST['google_analytics']);
			update_option('wpe_google_link_tracking',$_POST['google_link_tracking']);
			update_option('wpe_footer_link',$_POST['footer_link']);
			update_option('wpe_php_date',$_POST['php_date']);
			update_option('wpe_debug_mode',$_POST['debug_mode']);
			for($wpe_s=1;$wpe_s<=get_option('wpe_custom_image_sizes');$wpe_s++) {
				delete_option('wpe_image_size_'.$wpe_s);
			}
			for($wpe_s=1;$wpe_s<=$_POST['wpe_total_image_sizes'];$wpe_s++) {
				add_option(
					'wpe_image_size_'.$wpe_s,
					$_POST[$wpe_s.'_image_name'].';'.
					$_POST[$wpe_s.'_image_width'].';'.
					$_POST[$wpe_s.'_image_height'].';'.
					$_POST[$wpe_s.'_image_crop']
				);
			}
			update_option('wpe_custom_image_sizes',$_POST['wpe_total_image_sizes']);
			update_option('wpe_image_quality',$_POST['image_quality']);
			update_option('wpe_facebook',$_POST['facebook']);
			update_option('wpe_flickr_username',$_POST['flickr_username']);
			update_option('wpe_flickr_api',$_POST['flickr_api']);
			update_option('wpe_google_maps',$_POST['google_maps']);
			delete_option('wpe_twitter_1');
			add_option('wpe_twitter_1',$_POST['1_twitter_username'].';'.$_POST['1_consumer_key'].';'.$_POST['1_consumer_secret'].';'.$_POST['1_oauth_access_token'].';'.$_POST['1_oauth_access_token_secret']);
			update_option('wpe_twitter_accounts',$_POST['wpe_twitter_accounts']);
			update_option('wpe_style',$_POST['style']);
			update_option('wpe_responsive',$_POST['responsive']);
			update_option('wpe_email',$_POST['email']);
			update_option('wpe_video',$_POST['video']);
			update_option('wpe_get',$_POST['get']);
			update_option('wpe_excerpt',$_POST['excerpt']);
			update_option('wpe_get_image_source',$_POST['get_image_source']);
			update_option('wpe_link_it',$_POST['link_it']);
			update_option('wpe_relative_time',$_POST['relative_time']);
			
			echo '<div class="updated"><p>Settings saved. <a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=wp-essentials">Refresh the page to see your changes.</a></p></div>';
		}
?>
<div class="wrap">
	<h2 class="title"><i class="fa fa-fire" aria-hidden="true"></i> WP Essentials</h2>
	<div id="post-stuff">
	<form action="admin.php?page=wp-essentials" method="post" id="wpe-settings-form">
		<div id="post-body" class="metabox-holder wpe-settings-container columns-2 clearfix">
			<div id="wpe_left">
				<h2>System</h2>
				<div class="postbox" id="wpe_cleanup" data-url="cleanup">
					<h3 class="hndle"><span><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Cleanup</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="cleanup"><input type="checkbox" name="cleanup" id="cleanup" value="1" <?php if (get_option('wpe_cleanup')==1) { ?>checked="checked"<?php } ?>> Enable Cleanup</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_lowercase_filenames" data-url="case-sensitive">
					<h3 class="hndle"><span><i class="fa fa-text-height fa-fw" aria-hidden="true"></i> Case-sensitive Filenames</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="lowercase_filenames"><input type="checkbox" name="lowercase_filenames" id="lowercase_filenames" value="1" <?php if (get_option('wpe_lowercase_filenames')==1) { ?>checked="checked"<?php } ?>> Enable Case-sensitive Filenames</label></p>
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_user_roles" data-url="user-roles">
					<h3 class="hndle"><span><i class="fa fa-users fa-fw" aria-hidden="true"></i> User Roles</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<table id="user_role_table" cellpadding="0" cellspacing="0">
							<thead>
                            	<tr>
                                    <th>Role Name</th>
                                    <th class="center">View Dashboard</th>
                                    <th class="center">Edit Files</th>
                                    <th class="center">Edit Theme</th>
                                    <th class="center">Manage Others Pages</th>
                                    <th class="center">Manage Others Posts</th>
                                    <th class="center">Manage Pages</th>
                                    <th class="center">Manage Posts</th>
                                    <th class="center">Manage Users</th>
                                    <th class="center">Manage Categories</th>
                                    <th class="center">Manage Links</th>
                                    <th class="center">Manage Options</th>
                                    <th class="center">Manage Comments</th>
                                    <th class="center">Manage Plugins</th>
                                    <th class="center">Update Core</th>
                                    <th class="center">&nbsp;</th>
                                </tr>
							</thead>
							<tbody>
                            	<?php
									$role = get_option('wpe_user_role_1');
									$roles = explode(';',$role);
								?>
                                    <tr>
                                        <td><input type="text" class="medium-text" name="<?php echo $wpe_i; ?>_user_role" id="user_role" value="<?php echo $roles[0]; ?>"></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_edit_dashboard" <?php if ($roles[1]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_edit_files" <?php if ($roles[2]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_edit_theme" <?php if ($roles[3]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_others_pages" <?php if ($roles[4]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_others_posts" <?php if ($roles[5]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_pages" <?php if ($roles[6]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_posts" <?php if ($roles[7]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_users" <?php if ($roles[8]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_categories" <?php if ($roles[9]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_links" <?php if ($roles[10]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_options" <?php if ($roles[11]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_comments" <?php if ($roles[12]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_manage_plugins" <?php if ($roles[13]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><input type="checkbox" name="<?php echo $wpe_i; ?>_update_core" <?php if ($roles[14]==1) { echo 'checked'; } ?>></td>
                                        <td class="center"><button class="button button-secondary delete_user_role" <?php if ($wpe_i==1) { echo 'disabled="disabled"'; } ?>>Delete</button></td>
                                    </tr>
							</tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="16" class="center"><button id="add_user_role" class="button button-secondary">Add User Role</button></td>
                                </tr>
                            </tfoot>
						</table>
                        <input type="hidden" name="wpe_total_user_roles" id="wpe_total_user_roles" value="">
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_database_backups" data-url="database-backups">
					<h3 class="hndle"><span><i class="fa fa-download fa-fw" aria-hidden="true"></i> Database Backups</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><input type="text" class="regular-text" name="database_backup" id="database_backup" class="regular-text ltr" value="<?php if ($licence->error==1) { echo get_option('admin_email'); } ?>"> <a href="#" id="email_backup">Email a full database backup.</a></p>
						<p><label for="backup"><input type="checkbox" name="backup" id="backup" value="1" <?php if (get_option('wpe_backup')==1) { ?>checked="checked"<?php } ?>> Enable Weekly Backups</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_debug_mode" data-url="debug-mode">
					<h3 class="hndle"><span><i class="fa fa-cogs fa-fw" aria-hidden="true"></i> Debug Mode</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="debug_mode"><input type="checkbox" name="debug_mode" id="debug_mode" value="1" <?php if (get_option('wpe_debug_mode')==1) { ?>checked="checked"<?php } ?>> Enable Debug Mode</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_error_reporting" data-url="error-reporting">
					<h3 class="hndle"><span><i class="fa fa-exclamation-circle fa-fw" aria-hidden="true"></i> WordPress Error Reporting</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<label for="error_reports_google_analytics"><input type="checkbox" name="error_reports_google_analytics" id="error_reports_google_analytics" value="1" <?php if (get_option('wpe_error_reports_google_analytics')==1) { ?>checked="checked"<?php } ?>> Ensure Google Analytics is installed</label><br>
						<label for="error_reports_search_engines"><input type="checkbox" name="error_reports_search_engines" id="error_reports_search_engines" value="1" <?php if (get_option('wpe_error_reports_search_engines')==1) { ?>checked="checked"<?php } ?>> Ensure search engines aren&rsquo;t blocked</label><br>
						<label for="wpe_error_reports_check_username"><input type="checkbox" name="wpe_error_reports_check_username" id="wpe_error_reports_check_username" value="1" <?php if (get_option('wpe_error_reports_check_username')==1) { ?>checked="checked"<?php } ?>> Check for <code>admin</code> username</label><br>
						<label for="wpe_error_reports_check_holding"><input type="checkbox" name="wpe_error_reports_check_holding" id="wpe_error_reports_check_holding" value="1" <?php if (get_option('wpe_error_reports_check_holding')==1) { ?>checked="checked"<?php } ?>> Check to see if Holding Page is enabled.</label><br>
						<label for="wpe_error_reports_check_licence"><input type="checkbox" name="wpe_error_reports_check_licence" id="wpe_error_reports_check_licence" value="1" <?php if (get_option('wpe_error_reports_check_licence')==1) { ?>checked="checked"<?php } ?>> Prompt to enter WP Essentials Premium licence key</label>
					</div>
				</div>
				<div class="postbox" id="wpe_footer_link" data-url="footer-link">
					<h3 class="hndle"><span><i class="fa fa-link fa-fw" aria-hidden="true"></i> WP Essentials Footer Link</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<?php if ($licence->referral) { ?>
							<p>As a valid WP Essentials licence holder, your footer link will contain your referral code.</p>
						<?php } ?>
						<h4>Setup</h4>
						<p><label for="footer_link"><input type="checkbox" name="footer_link" id="footer_link" value="1" <?php if (get_option('wpe_footer_link')==1) { ?>checked="checked"<?php } ?>> Enable Footer Link</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_image_sizes" data-url="custom-image-sizes">
					<h3 class="hndle"><span><i class="fa fa-picture-o fa-fw" aria-hidden="true"></i> Custom Image Sizes</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<table id="image_size_table" cellpadding="0" cellspacing="0">
							<thead>
                            	<tr>
                                    <th class="center">Name</th>
                                    <th class="center">Width (px)</th>
                                    <th class="center">Height (px)</th>
                                    <th class="center">Crop</th>
                                    <th class="center">&nbsp;</th>
                                </tr>
							</thead>
							<tbody>
                            	<?php
									for($wpe_s=1;$wpe_s<=get_option('wpe_custom_image_sizes');$wpe_s++) {
										$size = get_option('wpe_image_size_'.$wpe_s);
										$sizes = explode(';',$size);
								?>
                                    <tr>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_s; ?>_image_name" id="custom_image_sizes" value="<?php echo $sizes[0]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_s; ?>_image_width" value="<?php echo $sizes[1]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_s; ?>_image_height" value="<?php echo $sizes[2]; ?>"></td>
                                        <td class="center">
											<select name="<?php echo $wpe_s; ?>_image_crop">
												<option value="99" <?php if ($sizes[3]==99) { echo 'selected="selected"'; } ?>>No cropping</option>
												<option value="1" <?php if ($sizes[3]==1) { echo 'selected="selected"'; } ?>>Top / Left</option>
												<option value="2" <?php if ($sizes[3]==2) { echo 'selected="selected"'; } ?>>Top / Center</option>
												<option value="3" <?php if ($sizes[3]==3) { echo 'selected="selected"'; } ?>>Top / Right</option>
												
												<option value="4" <?php if ($sizes[3]==4) { echo 'selected="selected"'; } ?>>Center / Left</option>
												<option value="5" <?php if ($sizes[3]==5 || !$sizes[3]) { echo 'selected="selected"'; } ?>>Center / Center</option>
												<option value="6" <?php if ($sizes[3]==6) { echo 'selected="selected"'; } ?>>Center / Right</option>
												
												<option value="7" <?php if ($sizes[3]==7) { echo 'selected="selected"'; } ?>>Bottom / Left</option>
												<option value="8" <?php if ($sizes[3]==8) { echo 'selected="selected"'; } ?>>Bottom / Center</option>
												<option value="9" <?php if ($sizes[3]==9) { echo 'selected="selected"'; } ?>>Bottom / Right</option>
											</select>
										</td>
                                        <td class="center"><button class="button button-secondary delete_image_size" <?php if ($wpe_s==1) { echo 'disabled="disabled"'; } ?>>Delete</button></td>
                                    </tr>
                                <?php } ?>
							</tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="16" class="center"><button id="add_image_size" class="button button-secondary">Add Image Size</button></td>
                                </tr>
                            </tfoot>
						</table>
                        <input type="hidden" name="wpe_total_image_sizes" id="wpe_total_image_sizes" value="">
					</div>
				</div>
				<div class="postbox" id="wpe_image_quality" data-url="image-quality">
					<h3 class="hndle"><span><i class="fa fa-picture-o fa-fw" aria-hidden="true"></i> Image Quality</span></h3>
					<div class="inside clearfix">
						<div id="wpe-image-content">
							<div class="ajax-content"></div>
							<h4>Setup</h4>
							<div class="clearfix">
								<div id="wpe-slider"></div> <span id="wpe-slider-label"><?php echo get_option('wpe_image_quality'); ?></span>%
							</div>
						</div>
						<input type="text" class="regular-text" name="image_quality" id="image_quality" value="<?php echo get_option('wpe_image_quality'); ?>">
						<div id="wpe-image-preview">
							<p>Preview</p>
							<div id="wpe-image-container">
								<img src="<?php echo ESSENTIALS_PATH; ?>/images/quality-1.jpg" class="image-1" style="opacity:<?php echo (get_option('wpe_image_quality')/100); ?>;">
								<img src="<?php echo ESSENTIALS_PATH; ?>/images/quality-2.jpg" class="image-2">
							</div>
						</div>
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_login_notification" data-url="login-notification">
					<h3 class="hndle"><span><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> Login Notification</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="login_notification"><input type="checkbox" name="login_notification" id="login_notification" value="1" <?php if (get_option('wpe_login_notification')==1) { ?>checked="checked"<?php } ?>> Enable Login Notifications</label></p>
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_holding_page" data-url="holding-page">
					<h3 class="hndle"><span><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> Holding Page</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<label for="holding_page"><input type="checkbox" name="holding_page" id="holding_page" value="1" <?php if (get_option('wpe_holding_page')==1) { ?>checked="checked"<?php } ?> <?php echo (get_option('wpe_holding_page_password')?'disabled="disabled"':''); ?>> Enable Holding Page</label>
						<p><label for="holding_page_header"><input type="text" class="regular-text" name="holding_page_header" id="holding_page_header" placeholder="Website Under Maintenance" value="<?php echo get_option('wpe_holding_page_header'); ?>" placeholder="" <?php echo (get_option('wpe_holding_page_password')?'disabled="disabled"':''); ?>> Header</label></p>
						<p><label for="holding_page_message"><input type="text" class="regular-text" name="holding_page_message" id="holding_page_message" placeholder="We will be back very soon." value="<?php echo get_option('wpe_holding_page_message'); ?>" placeholder="" <?php echo (get_option('wpe_holding_page_password')?'disabled="disabled"':''); ?>> Message</label></p>
						<p><label for="holding_page_password"><input type="password" class="regular-text" name="holding_page_password" id="holding_page_password" placeholder="<?php echo (get_option('wpe_holding_page_password')?'Enter password to turn off the holding page.':''); ?>" value="" placeholder=""> Password</label></p>
					</div>
				</div>
				<h2>Plugins</h2>
				<div class="postbox" id="wpe_google_analytics" data-url="google-analytics">
					<h3 class="hndle"><span><i class="fa fa-line-chart fa-fw" aria-hidden="true"></i> Google Analytics</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="google_analytics"><input type="text" class="regular-text" name="google_analytics" id="google_analytics" value="<?php echo get_option('wpe_google_analytics'); ?>" placeholder="UA-XXXXXXXX-X"> Google Analytics Tracking IDs</label></p>
						<p><em>Please note: you can add multiple tracking IDs by comma separating them.</em></p>
						<p><label for="google_link_tracking"><input type="checkbox" name="google_link_tracking" id="google_link_tracking" value="1" <?php if (get_option('wpe_google_link_tracking')==1) { ?>checked="checked"<?php } ?>> Track outbound links</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_facebook_page_plugin" data-url="facebook-page-plugin">
					<h3 class="hndle"><span><i class="fa fa-facebook fa-fw" aria-hidden="true"></i> Facebook Page Plugin</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<p><label for="facebook"><input type="checkbox" name="facebook" id="facebook" value="1" <?php if (get_option('wpe_facebook')==1) { ?>checked="checked"<?php } ?>> Enable Facebook Page Plugin</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_flickr_feed" data-url="flickr">
					<h3 class="hndle"><span><i class="fa fa-flickr fa-fw" aria-hidden="true"></i> Flickr Feed</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="flickr_username"><input type="text" class="regular-text" name="flickr_username" id="flickr_username" value="<?php echo get_option('wpe_flickr_username'); ?>"> Flickr Username</label></p>
						<p><label for="flickr_api"><input type="text" class="regular-text" name="flickr_api" id="flickr_api" value="<?php echo get_option('wpe_flickr_api'); ?>"> Flickr API Key (<a href="http://www.flickr.com/services/api/keys/apply/" target="_blank">Get it here</a>)</label></p>
						<h4>Cache</h4>
						<p><a href="#" id="wpe_cache_flickr">Click here to force a cache refresh.</a></p>
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_instagram_feed" data-url="instagram">
					<h3 class="hndle"><span><i class="fa fa-instagram fa-fw" aria-hidden="true"></i> Instagram Feed</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<label for="instagram_username"><input type="text" class="regular-text" name="instagram_username" id="instagram_username" value="<?php echo get_option('wpe_instagram_username'); ?>"> Instagram Username</label><br>
						<label for="instagram_client_id"><input type="text" class="regular-text" name="instagram_client_id" id="instagram_client_id" value="<?php echo get_option('wpe_instagram_client_id'); ?>"> Client ID (<a href="https://instagram.com/developer/clients/manage/" target="_blank">Get it here</a>)</label> <code>OAuth redirect_uri: <?php echo get_bloginfo('wpurl').'/wp-admin/index.php'; ?></code><br>
						<label for="instagram_client_secret"><input type="text" class="regular-text" name="instagram_client_secret" id="instagram_client_secret" value="<?php echo get_option('wpe_instagram_client_secret'); ?>"> Client Secret</label><br>
						<h4>Cache</h4>
						<p><a href="#" id="wpe_cache_instagram">Click here to force a cache refresh.</a></p>
					</div>
				</div>
				<div class="postbox" id="wpe_twitter_feed" data-url="twitter">
					<h3 class="hndle"><span><i class="fa fa-twitter fa-fw" aria-hidden="true"></i> Twitter Feed</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<table id="twitter_accounts_table" cellpadding="0" cellspacing="0">
							<thead>
                            	<tr>
                                    <th class="center">Username</th>
                                    <th class="center">Consumer Key (<a href="https://dev.twitter.com/apps/new" target="_blank">Get it here</a>)</th>
                                    <th class="center">Consumer Secret</th>
                                    <th class="center">OAuth Access Token</th>
                                    <th class="center">OAuth Access Token Secret</th>
                                    <th class="center">&nbsp;</th>
                                </tr>
							</thead>
							<tbody>
                            	<?php
									for($wpe_t=1;$wpe_t<=get_option('wpe_twitter_accounts');$wpe_t++) {
										$account = get_option('wpe_twitter_'.$wpe_t);
										$accounts = explode(';',$account);
								?>
                                    <tr>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_t; ?>_twitter_username" id="" value="<?php echo $accounts[0]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_t; ?>_consumer_key" value="<?php echo $accounts[1]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_t; ?>_consumer_secret" value="<?php echo $accounts[2]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_t; ?>_oauth_access_token" value="<?php echo $accounts[3]; ?>"></td>
                                        <td class="center"><input type="text" class="medium-text" name="<?php echo $wpe_t; ?>_oauth_access_token_secret" value="<?php echo $accounts[4]; ?>"></td>
                                        <td class="center"><button class="button button-secondary delete_twitter_account" <?php if ($wpe_t==1) { echo 'disabled="disabled"'; } ?>>Delete</button></td>
                                    </tr>
                                <?php } ?>
							</tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="6" class="center"><button id="add_twitter_account" class="button button-secondary" disabled="disabled">Add Twitter Account</button> <span class="pro_version"><a href="http://www.wp-essentials.net" target="_blank"><i class="fa fa-lock"></i> Licence Required</a></span></td>
                                </tr>
                            </tfoot>
						</table>
                        <input type="hidden" name="wpe_twitter_accounts" id="wpe_twitter_accounts" value="<?php echo get_option('wpe_twitter_accounts'); ?>">
					</div>
				</div>
				<div class="postbox pro_version" id="wpe_social_stream" data-url="social-stream">
					<h3 class="hndle"><span><i class="fa fa-share-alt fa-fw" aria-hidden="true"></i> Social Stream</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p>
							<label for="wpe_social_stream_label"><input type="text" class="regular-text" name="wpe_social_stream_label" id="wpe_social_stream_label" value="<?php echo get_option('wpe_social_stream_label'); ?>"> Load more text</label>
						</p>
						<p>
							<label for="wpe_social_stream_per_page"><input type="text" class="regular-text" name="wpe_social_stream_per_page" id="wpe_social_stream_per_page" value="<?php echo get_option('wpe_social_stream_per_page'); ?>"> Per Page</label>
						</p>
						<p>
							<label for="wpe_social_stream_twitter">
								<input type="checkbox" name="wpe_social_stream_twitter" id="wpe_social_stream_twitter" value="1" <?php if (get_option('wpe_social_stream_twitter')==1) { ?>checked="checked"<?php } ?>> Include Twitter</code>
							</label>
							<br>
							<label for="wpe_social_stream_instagram">
								<input type="checkbox" name="wpe_social_stream_instagram" id="wpe_social_stream_instagram" value="1" <?php if (get_option('wpe_social_stream_instagram')==1) { ?>checked="checked"<?php } ?>> Include Instagram</code>
							</label>
							<br>
							<label for="wpe_social_stream_flickr">
								<input type="checkbox" name="wpe_social_stream_flickr" id="wpe_social_stream_flickr" value="1" <?php if (get_option('wpe_social_stream_flickr')==1) { ?>checked="checked"<?php } ?>> Include Flickr</code>
							</label>
							<br>
							<label for="wpe_social_stream_infinite">
								<input type="checkbox" name="wpe_social_stream_infinite" id="wpe_social_stream_infinite" value="1" <?php if (get_option('wpe_social_stream_infinite')==1) { ?>checked="checked"<?php } ?>> Use infinite scrolling</code>
							</label>
						</p>
					</div>
				</div>
				<div class="postbox" id="wpe_google_maps" data-url="google-maps">
					<h3 class="hndle"><span><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> Google Maps</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>

						<label for="google_maps"><input type="text" name="google_maps" id="google_maps" value="<?php echo get_option('wpe_google_maps'); ?>"> Google Maps API (<a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">Get it here</a>)</label>
					</div>
				</div>
				<div class="postbox" id="wpe_styling" data-url="styling">
					<h3 class="hndle"><span><i class="fa fa-paint-brush fa-fw" aria-hidden="true"></i> Styling</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<label for="none"><input type="radio" name="style" id="none" value="none" <?php if (get_option('wpe_style')=='none') { ?>checked="checked"<?php } ?>>None</label> &nbsp;
						<label for="css"><input type="radio" name="style" id="css" value="css" <?php if (get_option('wpe_style')=='css') { ?>checked="checked"<?php } ?>>CSS</label> &nbsp;
						<label for="sass"><input type="radio" name="style" id="sass" value="sass" <?php if (get_option('wpe_style')=='sass') { ?>checked="checked"<?php } ?>>SASS</label> &nbsp;
						<label for="less"><input type="radio" name="style" id="less" value="less" <?php if (get_option('wpe_style')=='less') { ?>checked="checked"<?php } ?>>LESS</label>
						<p class="style_css" <?php if (get_option('wpe_style')!='css') { ?>style="display:none;"<?php } ?>>Please save your CSS file in <code><?php bloginfo('template_url'); ?>/css/style.css</code></p>
						<!--<p class="style_sass" <?php if (get_option('wpe_style')!='sass') { ?>style="display:none;"<?php } ?>>Requires <a href="https://wordpress.org/plugins/wordpress-sass/" target="_blank">WordPress SASS</a>.</p>-->
						<p class="style_sass" <?php if (get_option('wpe_style')!='sass') { ?>style="display:none;"<?php } ?>>Please save your SASS file to <code><?php bloginfo('template_url'); ?>/css/style.scss</code></p>
						<p class="style_sass" <?php if (get_option('wpe_style')!='sass') { ?>style="display:none;"<?php } ?>><em>Please note: an empty <code><?php bloginfo('template_url'); ?>/css/style_sass.css</code> file must also be saved.</em></p>
						<p class="style_less" <?php if (get_option('wpe_style')!='less') { ?>style="display:none;"<?php } ?>>Requires <a href="https://wordpress.org/plugins/wp-less/" target="_blank">WP-LESS</a>.</p>
						<p class="style_less" <?php if (get_option('wpe_style')!='less') { ?>style="display:none;"<?php } ?>>Please save your LESS file to <code><?php bloginfo('template_url'); ?>/css/style.less</code></p>
					</div>
				</div>
				<div class="postbox" id="wpe_responsive" data-url="responsive">
					<h3 class="hndle"><span><i class="fa fa-tablet fa-fw" aria-hidden="true"></i> Responsive</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="responsive"><input type="checkbox" name="responsive" id="responsive" value="1" <?php if (get_option('wpe_responsive')==1) { ?>checked="checked"<?php } ?>> Enable Responsive</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_email" data-url="email">
					<h3 class="hndle"><span><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> Email</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="email"><input type="checkbox" name="email" id="email" value="1" <?php if (get_option('wpe_email')==1) { ?>checked="checked"<?php } ?>> Enable Email Button</label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_date" data-url="date">
					<h3 class="hndle"><span><i class="fa fa-calendar fa-fw" aria-hidden="true"></i> Date</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="php_date"><input type="checkbox" name="php_date" id="php_date" value="1" <?php if (get_option('wpe_php_date')==1) { ?>checked="checked"<?php } ?>> Enable <code>[wpe_date]</code></label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_get" data-url="get-query">
					<h3 class="hndle"><span><i class="fa fa-question fa-fw" aria-hidden="true"></i> Get Query</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="get"><input type="checkbox" name="get" id="get" value="1" <?php if (get_option('wpe_get')==1) { ?>checked="checked"<?php } ?>> Enable <code>[wpe_get]</code></label></p>
					</div>
				</div>
				<h2>PHP Functions</h2>
				<div class="postbox" id="wpe_custom_excerpt" data-url="custom-excerpt">
					<h3 class="hndle"><span><i class="fa fa-code fa-fw" aria-hidden="true"></i> Custom Excerpt</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="custom_excerpt"><input type="checkbox" name="excerpt" id="custom_excerpt" value="1" <?php if (get_option('wpe_excerpt')==1) { ?>checked="checked"<?php } ?>> Enable <code>wpe_excerpt()</code></label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_get_image_source" data-url="get-image-source">
					<h3 class="hndle"><span><i class="fa fa-code fa-fw" aria-hidden="true"></i> Get Image Source</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="get_image_source"><input type="checkbox" name="get_image_source" id="get_image_source" value="1" <?php if (get_option('wpe_get_image_source')==1) { ?>checked="checked"<?php } ?>> Enable <code>wpe_get_image_source()</code></label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_link_it" data-url="link-it">
					<h3 class="hndle"><span><i class="fa fa-code fa-fw" aria-hidden="true"></i> Link It</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<h4>Setup</h4>
						<p><label for="link_it"><input type="checkbox" name="link_it" id="link_it" value="1" <?php if (get_option('wpe_link_it')==1) { ?>checked="checked"<?php } ?>> Enable <code>wpe_link_it()</code></label></p>
					</div>
				</div>
				<div class="postbox" id="wpe_relative_time" data-url="relative-time">
					<h3 class="hndle"><span><i class="fa fa-code fa-fw" aria-hidden="true"></i> Relative Time</span></h3>
					<div class="inside">
						<div class="ajax-content"></div>
						<p>Example: <code>wpe_relative_time("<?php echo strtotime("5 minutes ago"); ?>");</code></p>
						<p>Outout: <code><?php echo wpe_relative_time(strtotime("5 minutes ago")); ?></code></p>
						<p><label for="relative_time"><input type="checkbox" name="relative_time" id="relative_time" value="1" <?php if (get_option('wpe_relative_time')==1) { ?>checked="checked"<?php } ?>> Enable <code>wpe_relative_time()</code></label></p>
					</div>
				</div>
				<h2>Deprecated Functions</h2>
                <div class="warning">
                	<p>This is a list of old functions and shortcodes that will no longer recieve updates and will eventually be phased out.</p>
                	<ul>
                		<li><code>[wpe_video]</code> has been removed in favour of WordPress's built in <code>[video]</code> shortcode.</li>
                		<li><code>[twitter]</code> has been renamed <code>[wpe_twitter]</code> to avoid conflicts with other shortcodes.</li>
                		<li><code>[instagram]</code> has been renamed <code>[wpe_instagram]</code> to avoid conflicts with other shortcodes.</li>
                		<li><code>[social_stream]</code> has been renamed <code>[wpe_social_stream]</code> to avoid conflicts with other shortcodes.</li>
                	</ul>
                </div>
			</div>
			<div id="wpe_right">
				<input type="hidden" name="submitted" value="true">
				<div class="postbox">
					<h3 class="hndle"><span><i class="fa fa-refresh fa-fw" aria-hidden="true"></i> Update</span></h3>
					<div class="inside center">
						<?php submit_button(__( 'Update Settings','plugin_domain'),'primary large','submit'); ?>
					</div>
				</div>
				<div class="postbox">
					<h3 class="hndle"><span><i class="fa fa-star fa-fw" aria-hidden="true"></i> Review This Plugin</span></h3>
					<div class="inside">
						<p>If you like this plugin, please <a href="http://wordpress.org/support/view/plugin-reviews/wp-essentials#new-topic-0">write me a review</a>.</p>
					</div>
				</div>
				<div class="postbox">
					<h3 class="hndle"><span><i class="fa fa-fire fa-fw" aria-hidden="true"></i> WP Essentials Premium</span></h3>
					<div class="inside">
						<p>If you are interested in unlocking the Premium features, please visit <a href="https://www.wp-essentials.net">wp-essentials.net</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>