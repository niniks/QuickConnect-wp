<?php
/*
Plugin Name: QuickConnect
Plugin URI: http://skycode.nl/
Description: Quickly add connected websites and information in a nice fixed widget
Author: Tim Makor
Author URI: http://www.skycode.nl/
Version: 1.0.0
*/

/*  Copyright 2015 Tim Makor (email: tim at skycode .nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
function my_init() {
if (!is_admin()) {
wp_enqueue_script('the_js', plugins_url('includes/js/connect-websites.js',__FILE__),array('jquery'), true );
wp_enqueue_style('the_css', plugins_url('includes/css/style.php',__FILE__) );
wp_enqueue_style('the_icons', plugins_url('includes/css/fontawesome.min.css',__FILE__) );
wp_enqueue_style('the_effects', plugins_url('includes/css/animate.css',__FILE__) );
} else {
	wp_enqueue_script('the_recopy', plugins_url('includes/js/reCopy.js',__FILE__),array('jquery'), false );
	wp_enqueue_script('the_color', plugins_url('includes/js/rgbacolorpicker.min.js',__FILE__),array('jquery'), false );
	wp_enqueue_script('the_connect', plugins_url('includes/js/connect-admin.js',__FILE__),array('jquery'), false );
	wp_enqueue_style('the_color_css', plugins_url('includes/css/rgbacolorpicker.css',__FILE__), false );
	wp_enqueue_style('the_admin', plugins_url('includes/css/admin.css',__FILE__), false );
		
}
}
add_action('init', 'my_init');
function add_websitesConnected() {
echo '<?php global $options; ?>';
echo '<div class="connect-websites"><a class="connect-button"><i class="fa fa-info"></i></a>';
echo '<ul>';
echo '<h4>Informatie</h4>';
echo '<p>'.get_option('connect-description').'</p>';
echo '<h4>Onze webwinkels</h4>';
$urls = get_option('web_one');
$names = get_option('web_two');
$length = count($urls);
				for ($i = 0; $i < $length; $i++) {
echo '<li><a href="'.$urls[$i].'" target="_blank">'.$names[$i].'</a></li>';
}
echo '</ul></div>';
}
add_action('wp_footer', 'add_websitesConnected');
?>
<?php
// create custom plugin settings menu
add_action('admin_menu', 'connect_websites_plugin_create_menu');
function connect_websites_plugin_create_menu() {
	//create new top-level menu
	add_menu_page('QuickConnect settings', 'QuickConnect', 'administrator', __FILE__, 'connect_websites_plugin_settings_page' , plugins_url('includes/images/icon.png', __FILE__) );
	//call register settings function
	add_action( 'admin_init', 'register_connect_websites_plugin_settings' );
}
function register_connect_websites_plugin_settings() {
	//register our settings
	register_setting( 'connect-websites-plugin-settings-group', 'connect-description' );
	register_setting( 'connect-websites-plugin-settings-group', 'web_one' );
	register_setting( 'connect-websites-plugin-settings-group', 'web_two' );
	register_setting( 'connect-websites-plugin-settings-group', 'background_color' );
	register_setting( 'connect-websites-plugin-settings-group', 'button_color' );

}
function connect_websites_plugin_settings_page() {
?>
<div class="wrap">
<h2>QuickConnect settings</h2>
<form method="post" action="options.php">
	<?php settings_fields( 'connect-websites-plugin-settings-group' ); ?>

			<p><strong>Website URLS</strong></p>

				<?php //var_dump(get_option('web_one'));
				// var_dump(get_option('web_two'));
				 //echo '<p>'.esc_attr(get_option('web_one')).'</p>'; 
				$urls = get_option('web_one');  $names = get_option('web_two');
				if ($urls == '') :
				?>
				<p class="clone"> <input type="text" name="web_one[]" value="" class='input'/>
				 <input type="text" name="web_two[]" value="" class='input'/><a class="remove" href="#" onclick="jQuery(this).parent('.clone').slideUp(function(){ jQuery(this).remove() }); return false">remove</a></p>
				<?php
				else : ?>
				<?php $length = count($urls);
				for ($i = 0; $i < $length; $i++) : ?>
				<p class="clone">
					<label>Url</label>
				 <input type="text" name="web_one[]" value="<?php echo esc_attr( $urls[$i] ); ?>" class='input'/>
				<label>Naam</label>
				 <input type="text" name="web_two[]" value="<?php echo esc_attr( $names[$i] ); ?>" class='input'/>
				 <a class="remove" href="#" onclick="jQuery(this).parent('.clone').slideUp(function(){ jQuery(this).remove() }); return false">remove</a></p>
				 <?php
			 endfor;
				 endif; ?>				
				<p><a href="#" class="add" rel=".clone">Add More</a></p></td>

			<p><strong>Website omschrijving</strong></p><textarea name="connect-description" id="" cols="30" rows="10"><?php echo esc_attr( get_option('connect-description') );  ?></textarea>
<p><strong>Knop kleur</strong></p>
<input type="text" class="rainbowpick" value="<?php echo get_option('button_color') ?>" name="button_color" />
<p><strong>Slideout achtergrond kleur</strong></p>
<input type="text" class="rainbowpick" value="<?php echo get_option('background_color') ?>" name="background_color" />
		
		<?php submit_button(); ?>
	</form>
</div>
<?php } ?>