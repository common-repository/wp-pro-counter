<?php
/*
Plugin Name: WP Pro Counter
Plugin URI: http://woorocks.com
Description: WP Pro Counter lets you add counters inside exiting plugins, editors and content.
Version: 1.1
Author: Andreas Kviby
Author URI: http://woorocks.com
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-pro-counter
*/

// Create a helper function for easy SDK access.
function wpc_fs() {
    global $wpc_fs;

    if ( ! isset( $wpc_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $wpc_fs = fs_dynamic_init( array(
            'id'                  => '726',
            'slug'                => 'wp-pro-counter',
            'type'                => 'plugin',
            'public_key'          => 'pk_dbf4eef094bed751b26a4dc0d8e47',
            'is_premium'          => false,
            'has_premium_version' => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'menu'                => array(
                'slug'       => 'wp-pro-counter-settings',
                'account'    => false,
            ),
        ) );
    }

    return $wpc_fs;
}

// Init Freemius.
wpc_fs();

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

// Create a helper function for easy SDK access.



load_plugin_textdomain('wp-pro-counter', false, basename( dirname( __FILE__ ) ) . '/languages' );
/*
function WPCounter_func( $atts ) {

    $count_posts = wp_count_posts($atts['type']);

    return intval($count_posts->publish);
}
add_shortcode( 'WPCounter', 'WPCounter_func' );
*/
function WPCounterMeta_func( $atts ) {

  $meta_key = $atts['metakey'];
  $meta_value = $atts['metavalue'];
  $post_type = $atts['type'];
  $post_status = $atts['status'];
  $tags = $atts['tags'];
  $taxonomy_name = $atts['taxonomyname'];
  $taxonomy_value = $atts['taxonomyvalue'];

  $args = array(
              'post_type' => $post_type,
              'cache_results' => false,
	            'fields' => 'ids',
              'posts_per_page' => -1,
          );

          /*if ( $tags ) {
            $args['argang'] = $tags;
          }*/
          if ( $post_status ) {
            $args['post_status'] = $post_status;
          } else {
              $args['post_status'] = 'any';
          }
          if ( $meta_key && $meta_value ) {
                  if ( is_array($meta_value) ) {
              $args['meta_query'][] = array(
                  'key' => $meta_key,
                  'value' => $meta_value,
                  'compare' => '=');
                }

          else {
              $args['meta_query'][] = array('key' => $meta_key, 'value' => $meta_value);
            }
          }
          if ( $taxonomy_name && $taxonomy_value ) {
                  if ( is_array($taxonomy_value) ) {
              $args['tax_query'][] = array(
                  'taxonomy' => $taxonomy_name,
                  'terms' => $taxonomy_value,
                  'field' => 'slug');
                }

          else {
              $args['tax_query'][] = array('taxonomy' => $taxonomy_name, 'terms' => $taxonomy_value, 'field' => 'slug');
            }
          }

          $posts = get_posts($args);

          $count = count($posts);
          if ($count < 0) { $count = 0; }

    return intval($count);
}
add_shortcode( 'WPCounter', 'WPCounterMeta_func' );

add_action('admin_menu', 'wp_pro_counter_plugin_menu');



function wp_pro_counter_plugin_menu() {
	add_menu_page('WP Pro Counter Guide', 'WP Pro Counter', 'administrator', 'wp-pro-counter-settings', 'wp_pro_counter_plugin_settings_page', 'dashicons-admin-generic');
}

function wp_pro_counter_plugin_settings_page() {
  //?>
<div class="wrap" style="padding:10px;background-color:#ffffff;-webkit-box-shadow: 2px 3px 6px 0px rgba(0,0,0,0.6);
-moz-box-shadow: 2px 3px 6px 0px rgba(0,0,0,0.1);
box-shadow: 2px 3px 6px 0px rgba(0,0,0,0.1);">
<h2><?php echo _e('WP Pro Counter Guide','wp-pro-counter')?></h2>
<p>
  <?php echo _e('Welcome to the guide for the plugin WP Pro Counter.','wp-pro-counter')?>
</p>
<hr>
<p><?php echo _e('Below you will find all kinds of samples of how to use the plugin in different ways.','wp-pro-counter')?></p>
<hr>
<h3><?php echo _e('Standard Shortcode Usage here:','wp-pro-counter')?></h3>
<ul>
  <li>Below usage will return number of records for the type you select.</li>
    <li>[WPCounter type='product']</li>
    <li>[WPCounter type='page']</li>
    <li>[WPCounter type='post']</li>
</ul>
<hr>
<h3>Below we learn to use metakey and metavalue </h3>
<ul>
  <li>Below usage will return number of records for the type and with the matching metakey and metavalues.
    <p>metakey = optional // metavalue = required if metakey is used. status is also optional.</p>
  </li>
  <li>[WPCounter type='product' metakey='testcounter' metavalue='1' status='any']</li>
  <li>[WPCounter type='page' metakey='featured' metavalue='1'  status='draft']</li>
  <li>[WPCounter type='product' metakey='onsale' metavalue='1' status='publish']</li>
  <li>[WPCounter type='product' status='publish']</li>
  <li>[WPCounter type='post' status='draft']</li>
  <li>[WPCounter type='product' metakey='country' metavalue='sweden']</li>

  <li>[WPCounter type='product']</li>


</ul>
<hr>
<h3>Below we learn how to use taxonomy in our counters.</h3>
<ul>
    <li>[WPCounter type='product' taxonomyname='product_cat' taxonomyvalue='bitter']</li>
</ul>
<hr>

</div>
  <?php
}
