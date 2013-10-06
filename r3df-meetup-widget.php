<?php
/*
Plugin Name: 	R3DF Meetup Widget
Description:	Displays meetup group link in a widget
Plugin URI:		http://r3df.com/
Version: 		1.0.6
Author:         R3DF
Author URI:     http://r3df.com/
Author email:   plugin-support@r3df.com
Copyright: 		R-Cubed Design Forge
*/

/*  Copyright 2012  R-Cubed Design Forge

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Class definition, creates a widget using the WordPress widget class
class widget_r3dfmeetup extends WP_Widget {

	// Constructor function - sets up the widget
	function __construct() {

		// Define the widget: ID, name and description
		parent::__construct(
			'r3dfmeetup', // Base ID
			__('R3DF: Meetup Group Widget', 'r3df-mw'), // Name
			array(
				'description' => __( 'Displays Meetup group link in a widget.', 'r3df-mw' ),
			) // Args
		);
		
		// load plugin css
		// TODO: can we figure out if widget is actually being displayed?
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
			if ( file_exists( __DIR__ . '/inc/r3df-mw.css' )) {
				add_action('wp_enqueue_scripts', array(get_class($this), 'add_style'), 1025);
			}
		}
		
		// Add text domain hook
		add_action( 'init', array( &$this, 'text_domain' ));	
	}
	
	// Function that displays the widget content on the site frontend.
	function widget($args, $instance) {
		// Expand the passed in args into the function space - creates $before_widget, $after_widget, $before_title, $after_title
		extract($args);

		 // display anything passed in the $before_widget parameter
		echo $before_widget;

		// let other plugins or themes change the title
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		// Display the title if it is set, include the passed in $before_title and $after_title
		if ( !empty($title) ) {
			echo $before_title  . $title . $after_title;
		}

		// Set $middle to ' middle if it is set, or blank otherwise'
		$middle = ! empty( $instance['middle'] ) ? ' middle' : '';
		
		// Display the provided text and link, include the meetup logo
		?>
		<div class="r3dfmeetupcontainer">
			<a class="r3dfmeetup" href="<?php echo $instance['url']; ?>"><img class="r3dfmeetup" alt="Meetup" src="<?php echo plugins_url( 'images/meetup_logo_49.png', __FILE__ )?>">
			<span class="r3dfmeetup<?php echo $middle; ?>"><?php echo $instance['display_text']; ?></span></a>
		</div>

		<?php
		// display anything passed in the $after_widget parameter
		echo $after_widget;
	}
	
	// Displays the widget options in the WordPress admin
	function form($instance) {
		// strip (clean) any saved values (from the database, passed in $instance), set them to variables in the function 
        $title = esc_attr($instance['title']);
        $display_text = esc_attr($instance['display_text']);
		$url = esc_attr($instance['url']);
		$middle = $instance['middle'] ? 'checked="checked"' : '';

		// HTML for widget display in admin
        ?>
            <!-- Title input box -->
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label></p>

			<!-- Display text input box -->
            <p><label for="<?php echo $this->get_field_id('display_text'); ?>"><?php _e('Text to display:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('display_text'); ?>" name="<?php echo $this->get_field_name('display_text'); ?>" type="text" value="<?php echo $display_text; ?>" />
			</label></p>

			<!-- URL input box -->
			<p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
			</label></p>

			<!-- Middle selector checkbox -->
			<p><input class="checkbox" type="checkbox" <?php echo $middle; ?> id="<?php echo $this->get_field_id('middle'); ?>" name="<?php echo $this->get_field_name('middle'); ?>" /> <label for="<?php echo $this->get_field_id('middle'); ?>"><?php _e('Postion text in middle vertically', 'r3df-mw'); ?></label></p>
       <?php 
    }
	
	// Updates the database with user values from the admin form
	function update($new_instance, $old_instance) {
		$instance = array();

		// set defaults
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'display_text' => '', 'url' => '', 'middle' => 0) );

		// set all the new values from the admin form, while striping out HTML tags, and other "bad stuff"
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['display_text'] = strip_tags($new_instance['display_text']);
		$instance['url'] = strip_tags($new_instance['url']);
		
		// make sure middle is a sane value if it is set.
		$instance['middle'] = $new_instance['middle'] ? 1 : 0;

        return $instance;
	}
	
	// Language file loader
	function text_domain() {
		// Load language files - files must be r3df-mw-xx_XX.mo
		load_plugin_textdomain( 'r3df-mw', false, dirname(plugin_basename(__FILE__)) . '/lang');
	}
	
	// Style Sheet loader
	function add_style() {
		// Get the plugin version (added to css file loaded to clear browser caches on change)
        $plugin = get_file_data( __FILE__, array('Version' => 'Version') );

        // Register and enqueue the css file
		wp_register_style('r3df-mw', plugins_url('inc/r3df-mw.css', __FILE__), false, $plugin['Version'] );
		wp_enqueue_style('r3df-mw');
	}
}
// Register the widget on the widgets_init hook: 
add_action( 'widgets_init', function(){ register_widget( 'widget_r3dfmeetup' ); });

