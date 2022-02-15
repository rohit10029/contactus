<?php
namespace Rozgarlogin;
class Userlogin {
    function init()
    {
        
          add_action('rest_api_init',array($this,'wp_rest_user_endpoints'));
          //add_shortcode('login_view', array($this,'loginview'));
          add_action('plugins_loaded', array($this,'loginview'));
           
         
    }

            function wp_rest_user_endpoints() {
            /**
             * Handle Register User request.
             */
            register_rest_route('api/v1', 'users/register', array(
                'methods' => 'POST',
                'callback' => array($this,'wc_rest_user_endpoint_handler'),
            ));
            }
           



  }
  class Plugin
{

    public static function view( $name, array $args = array() ) {


        foreach ( $args AS $key => $val ) {
            $$key = $val;
        }


        $file =   'views/'. $name . '.php';

        include( $file );
    }
}
    ?>