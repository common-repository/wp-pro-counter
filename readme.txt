=== WP Pro Counter ===
Contributors: andreaskviby
Donate link: http://woorocks.com/
Tags: counter, elementor, shortcode, woocommerce
Requires at least: 4.6
Tested up to: 4.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WP Pro Counter lets you add counters inside exiting plugins, editors and content.

== Description ==

** Due to loads of work I will have no time updating this plugin until october **

With this plugin you can create dynamic counters together with page builder Elementor. See our demo page at woorocks.com.

* You can count posts of any kind, full support for Custom Post Types.
* You can count posts of any kind matching metakey values.
* You can count posts of any kind matching status like draft, published and more.
* You can count posts of any kind matching taxonomies of any kind.

For example you can count number of products inside a certain category or with certain tags. You can count orders shipped or total amount of orders sold. You can count products on sale and more. Your imagination on the only thing keeping you away.

### Standard Shortcode Usage here:

Below usage will return number of records for the type you select.

<blockquote>
[WPCounter type='product']

[WPCounter type='page']

[WPCounter type='post']
</blockquote>

### How to use metakey, metavalue and status.

Below usage will return number of records for the type and with the matching metakey and metavalues.
metakey = optional // metavalue = required if metakey is used. status is also optional.

<blockquote>
[WPCounter type='product' metakey='testcounter' metavalue='1' status='any']
[WPCounter type='page' metakey='featured' metavalue='1' status='draft']
[WPCounter type='product' metakey='onsale' metavalue='1' status='publish']
[WPCounter type='product' status='publish']
[WPCounter type='post' status='draft']
[WPCounter type='product' metakey='country' metavalue='sweden']
</blockquote>

### How to use taxonomy in our counters.

<blockquote>
[WPCounter type='product' taxonomyname='product_cat' taxonomyvalue='tshirts']
</blockquote>

== Installation ==

It is easy to install this plugin.

1. Upload the plugin files to the `/wp-content/plugins/wp-pro-counter` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the WP Pro Counter menu item to learn about all options.

== Frequently Asked Questions ==

= What format does the plugin return? =

In this version it only returns integers.

== Screenshots ==
1. Here we use Elementor Slides to create very cool slides with dynamic data from our WooCommerce system.

2. Here we use different Elementor widgets to create live dynamic counters which look good and make your site fly.

== Changelog ==

= 1.0 =
* First version published

= 1.1 =
Freemius services added to make it easier to continue user requested development for us.
