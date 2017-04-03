<?php

/**
 * Plugin Name:       WP API Get Sites
 * Plugin URI:        
 * Description:       Adds an endpoint to the WP API for get_sites functionallity
 * Version:           1.0.0
 * Author:            Kristoffer Svanmark
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       wp-api-get-sites
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('WPAPIGETSITES_PATH', plugin_dir_path(__FILE__));
define('WPAPIGETSITES_URL', plugins_url('', __FILE__));
define('WPAPIGETSITES_TEMPLATE_PATH', WPAPIGETSITES_PATH . 'templates/');

load_plugin_textdomain('wp-api-get-sites', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once WPAPIGETSITES_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once WPAPIGETSITES_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new WpApiGetSites\Vendor\Psr4ClassLoader();
$loader->addPrefix('WpApiGetSites', WPAPIGETSITES_PATH);
$loader->addPrefix('WpApiGetSites', WPAPIGETSITES_PATH . 'source/php/');
$loader->register();

// Start application
new WpApiGetSites\App();
