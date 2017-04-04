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

namespace WpApiGetSites;

class App
{
    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register'));
    }

    public function register()
    {
        register_rest_route('wp/v2', '/sites', array(
            'methods' => 'GET',
            'callback' => array($this, 'getSites')
        ));
    }

    public function getSites()
    {
        if (!is_multisite()) {
            return wp_send_json_error('This site is not in a multisite network.');
        }

        $sites = get_sites();

        foreach ($sites as &$site) {
            $site->url = get_home_url($site->blog_id);
            $site->rest_api = get_rest_url($site->blog_id);
        }

        return $sites;
    }
}

// Start application
new \WpApiGetSites\App();
