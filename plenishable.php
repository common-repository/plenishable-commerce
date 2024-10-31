<?php
/*
Plugin Name: Plenishable Products Widget
Description: Adds the Plenishable dynamic product carousel to blog post and pages.  The widget automatically displays products contextually matched to the content that readers can discover and purchase on-site.
Version: 2.13
Author: Plenishable Inc.
*/


//Add Scripts To Head Of Wordpress
function add_script_code_to_head()
{
 ?>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'http://assets.plenishable.com/product_plugin.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(po, s);
  })();
</script>
<?php

}


//Add Div Block To Each Post with default value of data-count
function add_div_block_to_post($content)
{
global $post ;
$permalink = get_permalink($post->ID);
$dc = get_option('data_count');

if(isset($dc)&&($dc!=""))
{
$data_count =$dc;
}
else
{
$data_count = 4 ;
}

$every_page = get_option('every_page');

// Add div block to the end of each post and page, excluding the homepage
  if((($every_page == true && (!is_page() || is_home())) || is_single()) && ( $post->post_status == 'publish') )
  {
        $content = sprintf(
            '%s<div class="plenishable-products" data-count="'.$data_count.'" data-permalink="'.$permalink.'"></div>',$content);
  }

    // Returns the content.
    return $content;


}

//Settings Portion of Scripts Inserter
function script_inserter_menu()

{

add_options_page( 'Plenishable Settings', 'Plenishable', 'manage_options', 'plenishable-settings', 'script_inserter_menu_callback' );

}



function  script_inserter_menu_callback() {

require_once(dirname(__FILE__) . '/plenishable_settings.php');

}


// Add settings link on plugin page
function your_plugin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=plenishable-settings">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );

function set_option_default() {
  update_option('every_page', 1);
}
register_activation_hook(__FILE__, 'set_option_default');

add_action("wp_head","add_script_code_to_head");

add_filter("the_content","add_div_block_to_post");

add_action( 'admin_menu', 'script_inserter_menu');

?>
