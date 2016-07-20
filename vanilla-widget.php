<?php
/*
Plugin Name: Vanilla Widget
Plugin URI:  http://barkingpixels.com/vanilla-widget
Description: Just a widget.
Version:     0.1
Author:      Miles
Author URI:  http://barkingpixels.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: vanilla_widget
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Adds Vanilla_Widget widget.
 */
class Vanilla_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'vanilla_widget', // Base ID
			__( 'Vanilla Widget', 'vanilla_widget' ), // Name
			array( 'description' => __( 'A Vanilla Widget', 'vanilla_widget' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		wp_enqueue_style( 'vanilla_widget-style', plugins_url('assets/stylesheets/vanilla-plugin.css', __FILE__) );
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text vanilla_widget_box">';

		// Check if title is set
		if ( $title ) {
		echo $before_title . $title . $after_title;
		}
		echo '<div class="vanilla-widget-icon-wrap">';

		// Check if text is set
		if( $facebook ) {
			printf ('<a href="%s" target="_blank"><img src="' . plugins_url( 'assets/images/facebook.png', __FILE__ ) . '" ></a>', $facebook );
		}
		if( $twitter ) {
			printf ('<a href="%s" target="_blank"><img src="' . plugins_url( 'assets/images/twitter.png', __FILE__ ) . '" ></a>', $twitter );
		}
		if( $instagram ) {
			printf ('<a href="%s" target="_blank"><img src="' . plugins_url( 'assets/images/instagram.png', __FILE__ ) . '" ></a>', $instagram );
		}
		if( $youtube ) {
			printf ('<a href="%s" target="_blank"><img src="' . plugins_url( 'assets/images/facebook.png', __FILE__ ) . '" ></a>', $youtube );
		}
		echo '</div></div>';
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		if( $instance) {
		     $title = esc_attr($instance['title']);
		     $facebook = esc_url($instance['facebook']);
		     $twitter = esc_url($instance['twitter']);
		     $instagram = esc_url($instance['instagram']);
		     $youtube = esc_url($instance['youtube']);
		} else {
		     $title = '';
		     $facebook = '';
		     $twitter = '';
		     $instagram = '';
		     $youtube = '';
		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'vanilla_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'vanilla_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="url" value="<?php echo $facebook; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'vanilla_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="url" value="<?php echo $twitter; ?>" />
			</p>	

			<p>
				<label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram:', 'vanilla_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="url" value="<?php echo $instagram; ?>" />
			</p>	

			<p>
				<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube:', 'vanilla_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="url" value="<?php echo $youtube; ?>" />
			</p>

		<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook'] = esc_url($new_instance['facebook']);
		$instance['twitter'] = esc_url($new_instance['twitter']);
		$instance['instagram'] = esc_url($new_instance['instagram']);
		$instance['youtube'] = esc_url($new_instance['youtube']);
		return $instance;
	}

} // class Vanilla_Widget

// register Vanilla_Widget widget
function register_vanilla_widget() {
    register_widget( 'Vanilla_Widget' );
}
add_action( 'widgets_init', 'register_vanilla_widget' );