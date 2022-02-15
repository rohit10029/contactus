<?php
/**
 * Plugin Name: Rozgar-login-api
 * Plugin URI: 
 * Description: Rozgar-login-api
 * Version: 0.1.0
 * Author: Rohit saha
 * Author URI: https://github.com/rohit10029/
 * License: GPL2
 */
//  require __DIR__ . '/vendor/autoload.php';
 require __DIR__ . '/Rozgarlogin/Userlogin.php';

 use Rozgarlogin\Userlogin;
 $d=new Userlogin();
 $d->init();
?>