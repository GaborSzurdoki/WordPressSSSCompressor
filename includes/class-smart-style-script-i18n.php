<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.nightworldonline.com
 * @since      1.0.0
 *
 * @package    Smart_Style_Script
 * @subpackage Smart_Style_Script/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Smart_Style_Script
 * @subpackage Smart_Style_Script/includes
 * @author     Gábor Szurdoki <info@nightworlddesign.hu>
 */
class Smart_Style_Script_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'smart-style-script',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
