=== Mautic For Fluent Forms  ===
Contributors: techjewel,,wpmanageninja,hasanuzzamanshamim
Tags: Integration, Mautic
Requires at least: 5.0
Tested up to: 5.3.2
Requires PHP: 5.6
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mautic Integration For FluentForms Plugin.

== Description ==
Connect your Mautic with FluentForms, and send form submission data to your Mautic.
 
== Mautic for FluentForms Features ==

- Secure connection with FluentForms
- Easy to integrate with your Mautic Api 
- oAuth2 with V3 implementation
- Custom fields mapping

== Awesome Support ==
Get dedicated support from our excellent happiness managers and developers. And Yes! It’s completely free.

If you have any suggestions or queries, feel free to open a ticket [here](https://wpmanageninja.com/support-tickets/).

== Installation ==
This section describes how to install the plugin(Mautic for FlentForms) and get it working.
Install From WordPress Admin Panel:

1. Login to your WordPress Admin Area
2. Go to Plugins -> Add New
3. Type "Mautic for FluentForms" into the Search and hit Enter.
4. Find this plugin Click "install now"
5. Activate The Plugin
6. Use Mautic on your site form the FluentForms module dashboard.


= Manual Installation =
1. Download the "Mautic for FluentForms" plugin from WordPress.org repository
2. On your WordPress admin dashboard, go to Plugins -> Add New -> Upload Plugin
3. Upload the downloaded plugin file (mautic-for-fluentforms.zip) and click Install Now
4. Be sure your FluentForms plugin is activated already.
5. Activate "Mautic for FluentForms" from your Plugins page.
6. Use Mautic on your site form the FluentForms module dashboard.

==Setup==
1. To Authenticate Mautic you have to enable your Mautic API first
2. Go to Your Mautic account dashboard, Click on the gear icon next to the username on top right corner. Click on Configuration settings >> Api settings and enable the Api
3. Then go to "Api Credentials" and create a new oAuth2 credentials with a redirect url which will available on your global settings page.(Your site dashboard url with this slug /?ff_mautic_auth=1)
4. If Mautic authentication done then map your form fields with Mautic from single form integration settings.

== Screenshots ==
1. Global Mautic module
2. Mautic authentication
3. Authenticated with FluentForms
4. Single form mapping with Mautic

== Changelog ==

= 1.0.0 =
* Init Release

