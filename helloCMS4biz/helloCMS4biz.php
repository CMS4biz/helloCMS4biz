<?php
<?php
/**
 * Plugin Name: HelleCMS4biz
 * Plugin URI: http://burozero.com/
 * Description: Calculator for quotation
 * Version: 1.0
 * Author: Gerard van Hattem
 * Author URI: http://gerardprogrammeert.nl
 * License: A "Slug" license name e.g. GPL12
 */
 
 
 
add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

	include_once 'updater.php';

	define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'github-updater',
			'api_url' => 'https://api.github.com/repos/jkudish/WordPress-GitHub-Plugin-Updater',
			'raw_url' => 'https://raw.github.com/jkudish/WordPress-GitHub-Plugin-Updater/master',
			'github_url' => 'https://github.com/jkudish/WordPress-GitHub-Plugin-Updater',
			'zip_url' => 'https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '3.3',
			'readme' => 'README.md',
			'access_token' => '',
		);

		new WP_GitHub_Updater( $config );

	}

}

//menu items
add_action('admin_menu','cms4bizmenu');
function cms4bizmenu() {
	
	//this is the main item for the menu
	add_menu_page('Trainingen', //page title
	'VCA Trainingen', //menu title
	'manage_options', //capabilities
	'course_list', //menu slug
	'course_list' //function
	);
	
	//this is a submenu
	add_submenu_page('trainigen_list', //parent slug
	'Nieuw training', //page title
	'Toevoegen', //menu title
	'manage_options', //capability
	'course_create', //menu slug
	'course_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Training', //page title
	'Update', //menu title
	'manage_options', //capability
	'course_update', //menu slug
	'course_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'course-list.php');
require_once(ROOTDIR . 'course-create.php');
require_once(ROOTDIR . 'course-update.php');


?>