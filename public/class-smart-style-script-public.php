<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.nightworldonline.com
 * @since      1.0.0
 *
 * @package    Smart_Style_Script
 * @subpackage Smart_Style_Script/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Smart_Style_Script
 * @subpackage Smart_Style_Script/public
 * @author     Gábor Szurdoki <info@nightworlddesign.hu>
 */
function containing_str($full) {
    $c = false;
    if (strpos($full, 'elementor') !== false) {
        $c = true;
    }
    if (strpos($full, 'dashicons') !== false) {
        $c = true;
    }
    if (strpos($full, 'sablon') !== false) {
        $c = true;
    }
    return $c;
}

class Smart_Style_Script_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->smart_style_script_options = get_option($this->plugin_name);
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Smart_Style_Script_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Smart_Style_Script_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/smart-style-script-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Smart_Style_Script_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Smart_Style_Script_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/smart-style-script-public.js', array('jquery'), $this->version, false);
    }

    // Cleanup head
    public function smart_style_script_css($headers) {
        if ((!empty($this->smart_style_script_options['css'])) && (!(is_admin()))) {
            global $wp_styles;
            $blog_name = get_bloginfo('name');
            $blog_slug = urlencode($blog_name);
            $blog_css = 'compressed.css';
            $wp_url = get_bloginfo('url');

            if (file_exists($blog_css)) {
                $last_update = filemtime($blog_css);
            } else {
                $last_update = 0;
            }

            $latest = 0;
            foreach ($wp_styles->queue as $handle) {

                $src = $wp_styles->registered[$handle]->src;

                if (!(containing_str($handle))) {
                    $src = str_replace($wp_url, '', $src);
                    $modified = filemtime(arServerUrl() . $src);
                    //echo '*****'.$modified=filemtime('index.php');
                    if ($modified > $latest) {
                        $latest = $modified;
                    }
                }
                //echo $handle.'<br>';
            }

            //   echo $last_update.'---'.$latest;
            // we need to generate a new one
            if ($latest > $last_update) {
                $fp1 = fopen($blog_css, 'w');
                fwrite($fp1, '/*' . date("Y-m-d H:i:s") . '*/'
                        . '');
                foreach ($wp_styles->queue as $handle) {
                    $src = $wp_styles->registered[$handle]->src;
                    //echo $handle.'<br>';
                    if (!(containing_str($handle))) {
                        //echo 'in<br>';
                        $src = str_replace($wp_url, '', $src);
                        $file2 = file_get_contents(arServerUrl() . $src);
                        $file2 = preg_replace("/\r|\n/", "", $file2);
                        $file2 = $file2 . '
';
                        fwrite($fp1, '/* ' . $src . ' */' . $file2);
                    }
                }
            }
            
            foreach ($wp_styles->queue as $handle) {
                if (!(containing_str($handle))) {
                    wp_deregister_style($handle);
                }
            }


            wp_enqueue_style('SSS Compressed Style', get_bloginfo('url') . '/' . $blog_css);
        }
    }

    public function smart_style_script_js($headers) {
        if (!empty($this->smart_style_script_options['js'])) {
            global $wp_scripts;
            $blog_name = get_bloginfo('name');
            $blog_slug = urlencode($blog_name);
            $blog_css = 'compressed.js';
            $wp_url = get_bloginfo('url');

            if (file_exists($blog_css)) {
                $last_update = filemtime($blog_css);
            } else {
                $last_update = 0;
            }

            $latest = 0;
            foreach ($wp_scripts->queue as $handle) {

                $src = $wp_scripts->registered[$handle]->src;



                $src = str_replace($wp_url, '', $src);
                $modified = filemtime(arServerUrl() . $src);
                //echo '*****'.$modified=filemtime('index.php');
                if ($modified > $latest) {
                    $latest = $modified;
                }
            }


            // we need to generate a new one
            if ($latest > $last_update) {
                $fp1 = fopen($blog_css, 'w');

                foreach ($wp_scripts->queue as $handle) {
                    $src = $wp_scripts->registered[$handle]->src;
                    $src = str_replace($wp_url, '', $src);
                    $file2 = file_get_contents(arServerUrl() . $src);
                    // $file2=preg_replace( "/\r|\n/", "", $file2 );

                    fwrite($fp1, $file2);
                }
            }


            foreach ($wp_scripts->queue as $handle) {

                if ($handle != 'jquery') {
                    wp_deregister_script($handle);
                }
            }

            // wp_enqueue_script('SSS Compressed Script',get_bloginfo('url').'/'.$blog_css);
        }
    }

}
