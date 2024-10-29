<?php
/*
Plugin Name: Based On Post
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Display's content by page, in a widget on the sidebar. This content is set on Post or Page creation.
Version: 2.0
Author: Melvin Software
Author URI: http://www.melvinsoftware.com
License: GPL2
*/
/*  Copyright 2012  MelvinSoftware  (email : support@melvinsoftware.com)

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
/* Fire our meta box setup function on the post editor screen. */ 
/*add_action( 'load-post.php', 'msbop_boxes_setup' );  
add_action( 'load-post-new.php', 'msbop_boxes_setup' ); */
/* Meta box setup function. */ 

/*function msbop_boxes_setup() {  */

/* Add meta boxes on the 'add_meta_boxes' hook. */ 
add_action( 'add_meta_boxes', 'msbop_add_meta_boxes' );  
//} 

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'msbop_save_meta', 10, 2 );

/* Create one or more meta boxes to be displayed on the post editor screen. */ 

function msbop_add_meta_boxes() {  
	$post_types = get_post_types();
	foreach ( $post_types as $post_type )
		add_meta_box(  
		'msbop-box', // Unique ID  
		'Based On Post', // Title  
		'msbop_meta_box', // Callback function  
		$post_type, // Admin page (or post type)  
		'advanced', // Context  
		'default' // Priority  
		);  
		add_meta_box(  
		'msbop-box', // Unique ID  
		'Based On Post', // Title  
		'msbop_meta_box', // Callback function  
		'page', // Admin page (or post type)  
		'advanced', // Context  
		'default' // Priority  
		);  
} 

/* Display the post meta box. */
function msbop_meta_box( $object, $box ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'msbop_nonce' ); ?>

<p>
	<label for="msbop-title-box"><?php _e( 'Enter the Title for the Widget, or leave blank for no title.' ); ?></label>
	<br />
	<input class="widefat" type="text" name="msbop-title-box" id="msbop-title-box" value="<?php echo esc_attr( get_post_meta( $object->ID, '_msbop_title_key', true ) ); ?>" size="30" />
	<label for="msbop-box"><?php _e( 'Add Text or Code that you would like displayed in the Based On Post Widget' ); ?></label>
	<br />
	<textarea rows="10" cols="40" style="height: 4em;margin: 0;width: 98%;"name="msbop-box" id="msbop-box" ><?php echo esc_attr( get_post_meta( $object->ID, '_msbop_meta_key', true ) );  ?></textarea>
</p>
<p><?php _e('Based On Post is Brought to you by, <a href="http://www.melvinsoftware.com" target="_blank">Melvin Software.</a>'); ?></p>
<?php 
}

/* Save the meta box's post metadata. */
function msbop_save_meta( $post_id, $post ) {

/* Verify the nonce before proceeding. */
if ( !isset( $_POST['msbop_nonce'] ) || !wp_verify_nonce( $_POST['msbop_nonce'], basename( __FILE__ ) ) )
return $post_id;

/* Get the post type object. 
$post_type = get_post_type_object( $post->post_type );*/

/* Check if the current user has permission to edit the post. 
if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
return $post_id;*/

// Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

/* Get the posted data and sanitize it for use as an HTML class. */
$msbop_meta_value = $_POST['msbop-box'];
$msbop_title_meta_value = $_POST['msbop-title-box'];

/* Get the meta key. */
global $msbop_data_key;
global $msbop_title_key;
$msbop_data_key = '_msbop_meta_key';
$msbop_title_key = '_msbop_title_key';

/* Get the meta value of the custom field key. */
$msbop_data_value = get_post_meta( $post_id, $msbop_data_key, true );
$msbop_title_value = get_post_meta( $post_id, $msbop_title_key, true);

/* If a new data value was added and there was no previous value, add it. */
if ( $msbop_meta_value && '' == $msbop_data_value )
add_post_meta( $post_id, $msbop_data_key, $msbop_meta_value, true );
/* If the new meta value does not match the old value, update it. */
elseif ( $msbop_meta_value && $msbop_meta_value != $msbop_data_value )
update_post_meta( $post_id, $msbop_data_key, $msbop_meta_value );
/* If there is no new meta value but an old value exists, delete it. */
elseif ( '' == $msbop_meta_value && $msbop_data_value )
delete_post_meta( $post_id, $msbop_data_key, $msbop_data_value );

/* If a new title value was added and there was no previous value, add it. */
if ( $msbop_title_meta_value && '' == $msbop_title_value )
add_post_meta( $post_id, $msbop_title_key, $msbop_title_meta_value, true );
/* If the new meta value does not match the old value, update it. */
elseif ( $msbop_title_meta_value && $msbop_title_meta_value != $msbop_title_value )
update_post_meta( $post_id, $msbop_title_key, $msbop_title_meta_value );
/* If there is no new meta value but an old value exists, delete it. */
elseif ( '' == $msbop_title_meta_value && $msbop_title_value )
delete_post_meta( $post_id, $msbop_title_key, $msbop_title_meta_value );
}

/* Template Tag */

add_action( 'msbop_template_tag', 'msbop_template_tag' );

function msbop_template_tag() {
	global $post;
    $msbop_display = get_post_meta( $post->ID, '_msbop_meta_key', true );
    $msbop_display_title = get_post_meta( $post->ID, '_msbop_title_key', true);
    $msbop_display = do_shortcode( $msbop_display );
	if ( is_single() || is_page() ) {	
		if ( $msbop_display ) {
		//extract($args);
			echo $before_widget.$before_title;
    			$use_post_title = (int) get_option('msbop_widget_use_post_title');
    		if($use_post_title) {
       	    	the_title();
       		} else {
           		echo $msbop_display_title;
       		}
       		echo "<br/>";
       		echo $after_title;
    	echo $msbop_display;
    	echo $after_widget;
		} else {
		return;
		}
	}
}



/* Widget Functions Below This Line
*********************************/

function msbop_widget($args) {
	global $post;
    $msbop_display = get_post_meta( $post->ID, '_msbop_meta_key', true );
    $msbop_display_title = get_post_meta( $post->ID, '_msbop_title_key', true);
    $msbop_display = do_shortcode( $msbop_display );
	if ( is_single() || is_page() ) {	
		if ( $msbop_display ) {
		extract($args);
			echo $before_widget.$before_title;
    			$use_post_title = (int) get_option('msbop_widget_use_post_title');
    		if($use_post_title) {
       	    	the_title();
       		} else {
           		echo $msbop_display_title;
       		}
       		echo $after_title;
    	echo $msbop_display;
    	echo $after_widget;
		} else {
		return;
		}
	}
}
wp_register_sidebar_widget('msbop_widget_id', 'Based On Post Widget', 'msbop_widget');

function msbop_widget_control(){

        if (isset($_POST['msbop_widget_use_post_title'])) {
            $use_post_title = (int) $_POST['msbop_widget_use_post_title'];
            update_option('msbop_widget_use_post_title', $use_post_title);
        } else {
            $use_post_title = (int) get_option('msbop_widget_use_post_title');
        }
        ?>
        <p>
            <input name="msbop_widget_use_post_title" type="hidden" value="0" />
            <input id="msbop_widget_use_post_title" name="msbop_widget_use_post_title" type="checkbox" value="1" <?php if($use_post_title) echo 'checked="checked" '; ?>/>
            <label for="msbop_widget_use_post_title">Use Post Title as Widget Title</label>
        </p>
        <p>
        	If you find this plugin useful, please consider donating any amount to the continuing development of it and plugins like it. Thank you, <a href="http://www.melvinsoftware.com">Melvin Software</a>.
        	<br />
        </p>
        <p>
        	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSRMH3GCX7LD8"><img style="float: right;" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="" border="0" /></a>
        	<br />
        	<br />
		</p>
        <?php
    }
wp_register_widget_control('msbop_widget_id', 'my Based On Post', 'msbop_widget_control');

/* On Plugin uninstall, delete all keys from posts and pages */
register_uninstall_hook( __FILE__, 'msbop_uninstall' );
function msbop_uninstall(){
  $allposts = get_posts('numberposts=-1&post_type=any&post_status=any');

  foreach( $allposts as $postinfo) {
    delete_post_meta($postinfo->ID, '_msbop_meta_key');
    delete_post_meta($postinfo->ID, '_msbop_title_key');
  }
  delete_option('msbop_widget_use_post_title');
  wp_unregister_sidebar_widget('msbop_widget_id');
  wp_unregister_widget_control('msbop_widget_id');
  
}
?>