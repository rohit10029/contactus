<?php
/**
 * Plugin Name: Rohit-contact-api
 * Plugin URI: 
 * Description: Rohit-contact-api
 * Version: 0.1.0
 * Author: Rohit saha
 * Author URI: https://github.com/rohit10029/
 * License: GPL2
 */

 require __DIR__ . '/Contactus/Contact.php';

 use Contactus\Contact;
 $d=new Contact();
 $d->init();

 global $jal_db_version;
 $jal_db_version = '1.0';

function on_install() {
	
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'contactus';
	
	
	$charset_collate = $wpdb->get_charset_collate();
	

	$sql = "CREATE TABLE IF NOT EXISTS ". $table_name ."(
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		email varchar(255) NOT NULL,
		phone varchar(255) NOT NULL,
		message text NOT NULL,
		PRIMARY KEY  (id)
		) ".$charset_collate;

	// 	var_dump($sql);
	// die;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta($sql);

	add_option( 'jal_db_version', $jal_db_version );
	$success = empty($wpdb->last_error);
    return $success;
}
function on_uninstall() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'contactus';
	
	$sql = "DROP TABLE IF EXISTS $table_name;";
     $wpdb->query($sql);
     delete_option("my_plugin_db_version");

}

register_activation_hook( __FILE__, 'on_install' );
register_deactivation_hook( __FILE__, 'on_uninstall' );
?>