<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.nightworldonline.com
 * @since      1.0.0
 *
 * @package    Smart_Style_Script
 * @subpackage Smart_Style_Script/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
*
* admin/partials/wp-cbf-admin-display.php - Don't add this comment
*
**/
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="cleanup_options" action="options.php">
 
        
        <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Cleanup
        $css = @$options['css'];
        $js = @$options['js'];
        
        //print_r($options);
    ?>

    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
    ?>
        
        
        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text"><span>Merge & Compress Styles</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-css">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-css" name="<?php echo $this->plugin_name; ?>[css]" value="1" <?php checked($css, 1); ?>/>
                <span><?php esc_attr_e('Merge CSS', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        
        <fieldset>
            <legend class="screen-reader-text"><span>Merge & Compress Scripts</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-js">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-js" name="<?php echo $this->plugin_name; ?>[js]" value="1" <?php checked($js, 1); ?>/>
                <span><?php esc_attr_e('Merge JS', $this->plugin_name); ?></span>
            </label>
        </fieldset>

      


        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
