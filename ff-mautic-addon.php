<?php
/**
 * Plugin Name: FluentForm Mautic add on
 * Plugin URI:  https://wpmanageninja.com/
 * Description: add form data on mautic by ff pro
 * Author: WPManageNinja LLC
 * Author URI:  https://wpmanageninja.com
 * Version: 1.9.3
 * Text Domain: ffmauticaddon
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright 2019 WPManageNinja LLC. All rights reserved.
 */


defined('ABSPATH') or die;

define('FFMAUTIC_DIR', plugin_dir_path(__FILE__));

include FFMAUTIC_DIR . 'autoload.php';
class FluentFormMautic
{
    protected $addOns = array(
        'FluentFormMautic\Integrations',
    );

    public function boot()
    {
        if (!defined('FLUENTFORM')) {
            return $this->injectDependency();
        }

        if (is_admin()) {
            $this->adminHooks();
        }
        if (function_exists('wpFluentForm')) {
            return $this->registerHooks(wpFluentForm());
        }
    }

   
    protected function registerHooks($fluentForm)
    {
        $this->registerAddOns($fluentForm);
    }
    public function registerAddOns($app)
    {
        foreach ($this->addOns as $addOn) {
            $class = "{$addOn}\Bootstrap";
            new $class($app);
        }
    }
    public function adminHooks()
    {
        require FFMAUTIC_DIR.'/autoload.php';
    }

      /**
         * Notify the user about the FluentForm dependency and instructs to install it.
         */
    protected function injectDependency()
    {
        add_action('admin_notices', function () {
            $pluginInfo = $this->getFluentFormInstallationDetails();

            $class = 'notice notice-error';

            $install_url_text = 'Click Here to Install the Plugin';

            if ($pluginInfo->action == 'activate') {
                $install_url_text = 'Click Here to Activate the Plugin';
            }

            $message = 'FluentForm Mautic Add-On Requires Fluent Forms Pro Add On Plugin, <b><a href="' . $pluginInfo->url
                . '">' . $install_url_text . '</a></b>';

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
        });
    }

    protected function getFluentFormInstallationDetails()
    {
        $activation = (object)[
            'action' => 'install',
            'url'    => ''
        ];

        $allPlugins = get_plugins();

        if (isset($allPlugins['fluentformpro/fluentformpro.php'])) {
            $url = wp_nonce_url(
                self_admin_url('plugins.php?action=activate&plugin=fluentformpro/fluentformpro.php'),
                'activate-plugin_fluentformpro/fluentformpro.php'
            );

            $activation->action = 'activate';
        } else {
            $api = (object)[
                'slug' => 'fluentformpro'
            ];

            $url = wp_nonce_url(
                self_admin_url('update.php?action=install-plugin&plugin=' . $api->slug),
                'install-plugin_' . $api->slug
            );
        }

        $activation->url = $url;

        return $activation;
    }
    
}
add_action('plugins_loaded', function () {
    (new FluentFormMautic())->boot();
});
