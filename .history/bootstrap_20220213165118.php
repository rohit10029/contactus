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
?>