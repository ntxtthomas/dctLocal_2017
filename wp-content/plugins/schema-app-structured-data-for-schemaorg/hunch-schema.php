<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/*
 * Plugin Name: Schema App Structured Data
 * Plugin URI: http://www.schemaapp.com
 * Description: This plugin adds http://schema.org structured data to your website
 * Version: 1.3.3
 * Author: Hunch Manifest
 * Author URI: https://www.hunchmanifest.com
 */

require_once plugin_dir_path(__FILE__) . '/lib/classmap.php';

if (is_admin()) {
    // Settings -> Schema App
    $schema_settings_page = new SchemaSettings();
    // Page & Post Editor
    $editor = new SchemaEditor();
    add_action('load-post.php', array($editor, 'hunch_schema_edit'));
    add_action('load-post-new.php', array($editor, 'hunch_schema_edit'));
} else {

    $SchemaFront = new SchemaFront();

    add_action('wp_head', array($SchemaFront, 'hunch_schema_add'));

	if ( ! empty( $SchemaFront->Settings['ToolbarShowTestSchema'] ) )
	{
		add_action( 'admin_bar_menu', array( $SchemaFront, 'AdminBarMenu' ), 999 );
	}

}
