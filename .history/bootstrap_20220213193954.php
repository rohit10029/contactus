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

 require __DIR__ . '/Contactus/Userlogin.php';

 use Rozgarlogin\Userlogin;
 $d=new Userlogin();
 $d->init();

 global $jal_db_version;
 $jal_db_version = '1.0';

function on_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'contactus';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE" .$table_name." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		email varchar(255) NOT NULL,
		email varchar(255) NOT NULL,
		message text NOT NULL,
		PRIMARY KEY  (id)
	) ".$charset_collate;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}
function on_uninstall() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'contactus';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "DROP TABLE ".$table_name ;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'on_install' );
register_deactivation_hook( __FILE__, 'on_install' );
?>