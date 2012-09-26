<?php
/*
Plugin Name: 	R3DF Meetup Widget
Description:	Displays meetup group link in a widget
Plugin URI:		http://r3df.com/
Version: 		1.0.4
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


class widget_r3dfmeetup extends WP_Widget {

	function __construct() {
		$widget_options = array(
			'description' => 'Displays Meetup group link in a widget.',
		);
		
		$this->WP_Widget(false, $name = 'R3DF: Meetup Group Widget', $widget_options);	
		
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
	
	function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		if ( !empty($title) ) {
			echo $before_title  . $title . $after_title;
		}
		$middle = ! empty( $instance['middle'] ) ? ' middle' : '';
		?>
		<div class="r3dfmeetupcontainer">
			<a class="r3dfmeetup" href="<?php echo $instance['url']; ?>"><img class="r3dfmeetup" alt="Meetup" src="<?php echo plugins_url( 'images/meetup_logo_49.png', __FILE__ )?>">
			<span class="r3dfmeetup<?php echo $middle; ?>"><?php echo $instance['display_text']; ?></span></a>
		</div>
		<?php echo $after_widget;
	}
	
	function form($instance) {
        $title = esc_attr($instance['title']);
        $display_text = esc_attr($instance['display_text']);
		$url = esc_attr($instance['url']);
		$middle = $instance['middle'] ? 'checked="checked"' : '';
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label></p>
            <p><label for="<?php echo $this->get_field_id('display_text'); ?>"><?php _e('Text to display:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('display_text'); ?>" name="<?php echo $this->get_field_name('display_text'); ?>" type="text" value="<?php echo $display_text; ?>" />
			</label></p>
			<p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'r3df-mw'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
			</label></p>
			<p><input class="checkbox" type="checkbox" <?php echo $middle; ?> id="<?php echo $this->get_field_id('middle'); ?>" name="<?php echo $this->get_field_name('middle'); ?>" /> <label for="<?php echo $this->get_field_id('middle'); ?>"><?php _e('Postion text in middle vertically', 'r3df-mw'); ?></label></p>
       <?php 
    }
	
	function update($new_instance, $old_instance) {
		$instance = array();
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'display_text' => '', 'url' => '', 'middle' => 0) );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['display_text'] = strip_tags($new_instance['display_text']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['middle'] = $new_instance['middle'] ? 1 : 0;

        return $instance;
	}
	
	// Language file loader
	function text_domain() {
		// load language files - files must be r3df-mw-xx_XX.mo
		load_plugin_textdomain( 'r3df-mw', false, dirname(plugin_basename(__FILE__)) . '/lang');
	}
	
	// Style Sheet loader
	function add_style() {
        $plugin = get_file_data( __FILE__, array('Version' => 'Version') );
		wp_register_style('r3df-mw', plugins_url('inc/r3df-mw.css', __FILE__), false, $plugin['Version'] );
		wp_enqueue_style('r3df-mw');
	}
}
add_action('widgets_init', create_function('', 'return register_widget("widget_r3dfmeetup");'));

?>
