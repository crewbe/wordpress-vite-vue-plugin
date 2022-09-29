<?php

/*
 * Plugin Name: Plugin name
 * Description: Plugin description
 * Author: Crewbe
 * Version: 0.0.1
 * Author URI: http://crewbe.com/
 * Requires PHP: 8.1
 */

declare(strict_types = 1);

require 'backend/vendor/autoload.php';

use function Kucrut\Vite\enqueue_asset;

\define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));

// shortcode frontend
add_shortcode('vue-short', static fn () => '<div id="app-client"></div>');

// admin menu item
add_action('admin_menu', static function () : void {
    add_menu_page(
        'Page Title',
        'Menu Title',
        'manage_options',
        'settings',
        static fn () => require_once MY_PLUGIN_PATH . '/backend/src/settings.php'
        // icon
    );
});

// plugin actions
add_filter(
    'plugin_action_links_' . plugin_basename(__FILE__),
    static fn ($actions) => array_merge($actions, ['<a href="' . admin_url('admin.php?page=settings') . '">Impostazioni</a>'])
);

// client scripts
add_action('wp_enqueue_scripts', static function () : void {
    enqueue_asset(__DIR__ . '/frontend/dist', 'client/main.ts', ['in-footer' => true]);
});

// admin scripts
add_action('admin_enqueue_scripts', static function () : void {
    enqueue_asset(__DIR__ . '/frontend/dist', 'settings/main.ts', ['in-footer' => true]);
});
