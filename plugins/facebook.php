<?php
	// Shortcode Setup
		// Facebook
			if (!function_exists('facebook')) {
				function facebook($atts) {
					extract(
						shortcode_atts(
							array(
								'page' => '',
								'faces' => 'true',
								'width' => '300',
								'height' => '300',
								'small_header' => 'false',
								'hide_cover' => 'false',
							),
							$atts
						 )
					);
					
					if (!function_exists('add_fb_script')) {
						function add_fb_script() {
							echo '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=704644012938629";fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script>';
						}
						add_action('wp_footer', 'add_fb_script');
					}
					return '<div class="fanbox"><div class="fb-page" data-href="'.$page.'" data-tabs="timeline" data-small-header="'.$small_header.'" data-adapt-container-width="true" data-hide-cover="'.$hide_cover.'" data-width="'.$width.'" data-height="'.$height.'" data-show-facepile="'.$faces.'"></div></div>';
				}
				add_shortcode('facebook','facebook');
			}
			
	// Widget Set up
		if (function_exists('facebook')) {
			class Facebook_Fanbox extends WP_Widget {
				function __construct() {
					parent::WP_Widget('facebook_fanbox', 'Facebook Page Plugin', array( 'description' => 'Add a Facebook Page Plugin to your page.'));
				}
				
				function widget($args,$instance) {
					extract($args);
					$title = apply_filters('title',$instance['title']);
					$page = apply_filters('page',$instance['page']);
						if ($page) { $args = 'page="'.$page.'"'; }
					$width = apply_filters('width',$instance['width']);
						if ($width) { $args .= ' width="'.$width.'"'; }
					$height = apply_filters('height',$instance['height']);
						if ($height) { $args .= ' height="'.$height.'"'; }
					$faces = apply_filters('faces',$instance['faces']);
						if ($faces==1) { $args .= ' faces="true"'; } else { $args .= ' faces="false"'; }
					$small_header = apply_filters('small_header',$instance['small_header']);
						if ($small_header==1) { $args .= ' small_header="true"'; } else { $args .= ' small_header="false"'; }
					$hide_cover = apply_filters('hide_cover',$instance['hide_cover']);
						if ($hide_cover==1) { $args .= ' hide_cover="true"'; } else { $args .= ' hide_cover="false"'; }
						
					echo $before_widget;
					if ($title) { echo '<h3 class="widget-title">'.$title.'</h3>'; }
					echo do_shortcode('[facebook '.$args.']');
					echo $after_widget;
				}
				
				function update($new_instance,$old_instance) {
					$instance = $old_instance;
					$instance['title'] = strip_tags($new_instance['title']);
					$instance['page'] = strip_tags($new_instance['page']);
					$instance['width'] = strip_tags($new_instance['width']);
					$instance['height'] = strip_tags($new_instance['height']);
					$instance['faces'] = strip_tags($new_instance['faces']);
					$instance['small_header'] = strip_tags($new_instance['small_header']);
					$instance['hide_cover'] = strip_tags($new_instance['hide_cover']);
					return $instance;
				}
				
				function form($instance) {
					if ($instance) {
						$title = esc_attr($instance['title']);
						$page = esc_attr($instance['page']);
						$width = esc_attr($instance['width']);
						$height = esc_attr($instance['height']);
						$faces = esc_attr($instance['faces']);
						$small_header = esc_attr($instance['small_header']);
						$hide_cover = esc_attr($instance['hide_cover']);
					}
					?>
					<p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Sidebar Title'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Facebook Page URL'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('page'); ?>" name="<?php echo $this->get_field_name('page'); ?>" type="text" value="<?php echo $page; ?>">
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>">
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height'); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>">
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('faces'); ?>"><?php _e('Show Faces'); ?></label>
						<input class="" id="<?php echo $this->get_field_id('faces'); ?>" name="<?php echo $this->get_field_name('faces'); ?>" type="checkbox" value="1" <?php if ($faces) { echo 'checked="checked"'; } ?>>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('small_header'); ?>"><?php _e('Small Header'); ?></label>
						<input class="" id="<?php echo $this->get_field_id('small_header'); ?>" name="<?php echo $this->get_field_name('small_header'); ?>" type="checkbox" value="1" <?php if ($small_header) { echo 'checked="checked"'; } ?>>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('hide_cover'); ?>"><?php _e('Hide Cover'); ?></label>
						<input class="" id="<?php echo $this->get_field_id('hide_cover'); ?>" name="<?php echo $this->get_field_name('hide_cover'); ?>" type="checkbox" value="1" <?php if ($hide_cover) { echo 'checked="checked"'; } ?>>
					</p>
					<?php
				}
			}
			register_widget('Facebook_Fanbox');
		}