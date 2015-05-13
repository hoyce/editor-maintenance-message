<?php
/*
Plugin Name: Editor Maintenance Message
Plugin URI: http://www.hoyce.com/wordpress-plugins
Description: A plugin that let you inform your editors before you set your blog platform in maintenance mode so they don't loose their work.
Version: 1.0.1
Author: Niklas Olsson
Author URI: http://www.hoyce.com
*/

add_action('admin_head', 'editor_maintenance_message_add_css');
add_action('admin_notices', 'editor_maintenance_message_add_message_block');
add_action('network_admin_notices', 'editor_maintenance_message_add_message_block');
add_action('admin_menu', 'add_editor_maintenance_message_options_admin_menu');

/**
 * Adds the css resource to the head tag.
 */
function editor_maintenance_message_add_css() {
  $css_path = plugins_url( 'css/editor-maintenance-message.css' , __FILE__ );
  echo '<link href="'.$css_path.'" rel="stylesheet" type="text/css" />';
}

/**
 * Adds the css resource to the head tag.
 */
function editor_maintenance_message_add_message_block() {
  if(get_option('editor_maintenance_message') != "") {
    echo '<div class="editorMaintenanceMessage">'.get_option('editor_maintenance_message').'</div>';
  }
}

/**
 * Add the plugin options page link to the dashboard menu.
 */
function add_editor_maintenance_message_options_admin_menu() {
  add_options_page(__('Maintenance Message', 'editor-maintenance-message'), __('Maintenance Message', 'editor-maintenance-message'), 'manage_options', basename(__FILE__), 'editor_maintenance_message_plugin_options_page');
}

/**
 * The main function that generate the options page for this plugin.
 */
function editor_maintenance_message_plugin_options_page() {
  // If not submited options, set update flag to false.
  if(!isset($_POST['update_editor_maintenance_message_plugin_options'])) {
    $_POST['update_editor_maintenance_message_plugin_options'] == 'false';
  }

  // If submited options, run update.
  if ($_POST['update_editor_maintenance_message_plugin_options'] == 'true') {
    editor_maintenance_message_plugin_options_update();
  }
  ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"><br /></div>
        <h2><?php echo __('Maintenance Message', 'editor-maintenance-message'); ?></h2>
        <form method="post" action="">
          <h4 style="margin-bottom: 0px;"><?php echo __('Maintenance message', 'editor-maintenance-message'); ?></h4>
          <input type="text" name="editor_maintenance_message" id="editor_maintenance_message" value="<?php echo get_option('editor_maintenance_message'); ?>" style="width:450px;"/>
          <input type="hidden" name="update_editor_maintenance_message_plugin_options" value="true" />
          <p><input type="submit" name="submit" value="<?php echo __('Update message', 'editor-maintenance-message'); ?>" class="button" /></p>
        </form>
    </div>
  <?php
}

/**
 * Update the editor maintenance message plugin options.
 */
function editor_maintenance_message_plugin_options_update() {
  if(isset($_POST['editor_maintenance_message'])) {
    update_option('editor_maintenance_message', $_POST['editor_maintenance_message']);
  }
}
?>
