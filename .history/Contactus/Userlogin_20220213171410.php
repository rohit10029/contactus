<?php
namespace Rozgarlogin;
class Userlogin {
    function init()
    {
        
        //   add_action('rest_api_init',array($this,'wp_rest_user_endpoints'));
          add_shortcode('contact_view', array($this,'contactview'));
         
           
         
    }

       function contactview()
       {
          Plugin::view("conactview");
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