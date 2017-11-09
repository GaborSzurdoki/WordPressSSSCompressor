<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.nightworldonline.com
 * @since             1.0.0
 * @package           Smart_Style_Script
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Style & Script Compressor
 * Plugin URI:        http://www.nightworldonline.com/smart-style-script
 * Description:       Combines and minifies styles, scripts, and detects changes automatically, so you don't have to manually empty cache!
 * Version:           1.0.0
 * Author:            Gábor Szurdoki
 * Author URI:        http://www.nightworldonline.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-style-script
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smart-style-script-activator.php
 */
function activate_smart_style_script() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-style-script-activator.php';
	Smart_Style_Script_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smart-style-script-deactivator.php
 */
function deactivate_smart_style_script() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-style-script-deactivator.php';
	Smart_Style_Script_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smart_style_script' );
register_deactivation_hook( __FILE__, 'deactivate_smart_style_script' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smart-style-script.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_smart_style_script() {

	$plugin = new Smart_Style_Script();
	$plugin->run();

}
run_smart_style_script();
