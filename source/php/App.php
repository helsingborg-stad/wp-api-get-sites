<?php

namespace WpApiGetSites;

class App
{
    public function __construct()
    {
        if (!is_multisite()) {
            return;
        }

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
        $sites = get_sites();

        foreach ($sites as &$site) {
            $site->url = get_home_url($site->blog_id);
            $site->rest_api = get_rest_url($site->blog_id);
        }

        return $sites;
    }
}
