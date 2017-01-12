<?php
/*
Plugin Name: Auto Maintenance Mode
Version: 1.0.1
Plugin URI: https://github.com/pothi/auto-maintenance-mode
Author: pothi
Author URI: https://www.tinywp.in
Description: A plugin to enable maintenance mode automatically upon lack of activity on development / staging / test sites.
Text Domain: auto-maintenance-mode
Domain Path: /languages
*/

// disable executing this script directly
if(!defined('ABSPATH')) exit;

if(!class_exists('AUTO_MAINTENANCE_MODE'))
{
    class AUTO_MAINTENANCE_MODE
    {
        var $plugin_version = '1.0.3';
        var $plugin_url;
        var $plugin_path;
        function __construct()
        {
            define('AUTO_MAINTENANCE_MODE_VERSION', $this->plugin_version);
            define('AUTO_MAINTENANCE_MODE_SITE_URL',site_url());
            define('AUTO_MAINTENANCE_MODE_URL', $this->plugin_url());
            define('AUTO_MAINTENANCE_MODE_PATH', $this->plugin_path());
            $this->plugin_includes();
        }
        function plugin_includes()
        {
            add_action('plugins_loaded', array($this, 'plugins_loaded_handler'));
            add_action('template_redirect', array($this, 'amm_template_redirect'));

            // clear transient on logout and create upon login
            add_action('wp_login', array($this, 'amm_create_transient'));
            add_action('init', array($this, 'amm_create_transient'));
            add_action('wp_logout', array($this, 'amm_clear_transient'));
        }
        function amm_create_transient() {
            if( is_user_logged_in() ) {
                if ( false === ( $tmp_value = get_transient( 'amm_is_any_user_logged_in' ) ) ) {
                    $value = true;
                    set_transient( 'amm_is_any_user_logged_in', $value, 60*60 );
                }
            }
        }
        function amm_clear_transient() {
            delete_transient('amm_is_any_user_logged_in');
        }
        function plugins_loaded_handler()
        {
            load_plugin_textdomain('auto-maintenance-mode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
        }
        function plugin_url()
        {
            if($this->plugin_url) return $this->plugin_url;
            return $this->plugin_url = plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
        }
        function plugin_path(){ 	
            if ( $this->plugin_path ) return $this->plugin_path;		
            return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
        }
        function is_valid_page() {
            return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
        }
        function amm_template_redirect()
        {
            if(is_user_logged_in()){
                //do not display maintenance page
                // $this->amm_create_transient_on_login();
            }
            else
            {
                if( !is_admin() && !$this->is_valid_page()){  //show maintenance page
                    if ( false === ( $tmp_value = get_transient( 'amm_is_any_user_logged_in' ) ) ) {
                        $this->load_amm_page();
                    }
                }
            }
        }
        function load_amm_page()
        {
            header('HTTP/1.0 503 Service Unavailable');
            include_once("amm-template.php");
            exit();
        }
    }
    $GLOBALS['auto_maintenance_mode'] = new AUTO_MAINTENANCE_MODE();
}
