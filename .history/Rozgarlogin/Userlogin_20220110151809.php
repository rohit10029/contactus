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
            function wc_rest_user_endpoint_handler() {
              
            $response = array();
            $return =[];
            // $body=file_get_contents('php://input');
            // $parameters = json_decode($body,true);
            $parameters = $_POST;
         
            $username = sanitize_text_field($parameters['username']);
            $email = sanitize_text_field($parameters['email']);
            $password = sanitize_text_field($parameters['password']);
            
            // $role = sanitize_text_field($parameters['role']);
            // $error = new WP_Error();
            $error = [];
            if (empty($username)) {
               array_push($error,"username is enmpty");
              
            }
            if (empty($email)) {
               array_push($error,"email is enmpty");
                
               
            }
            if (empty($password)) {
                array_push($error,"password is enmpty");
               
                
            }
            if (empty($role)) {
             $role = 'subscriber';
            } else {
                if ($GLOBALS['wp_roles']->is_role($role)) {
                 // Silence is gold
                } else {
               
               array_push($error,"Role field 'role' is not a valid. Check your User Roles from Dashboard.");
              
                }
            }
            if(count($error)==0)
            {
            $user_id = username_exists($username);
            
            if ($user_id==false && email_exists($email) == false) {
                $user_id = wp_create_user($username, $password, $email);
                if (!is_wp_error($user_id)) {
                // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
                $user = get_user_by('id', $user_id);
                // $user->set_role($role);
                $user->set_role('subscriber');
                // WooCommerce specific code
                if (class_exists('WooCommerce')) {
                    $user->set_role('customer');
                }
                // Ger User Data (Non-Sensitive, Pass to front end.)
                $response['code'] = 200;
                $response['message'] = __("User '" . $username . "' Registration was Successful", "wp-rest-user");
                $return= ["status"=>true,"message"=> $response['message'],"user"=>$user_id] ;    
            } else {
                $return =["status"=>false,"error"=>"error ".$user_id] ;
                }
            } else {
                array_push($error,"Email already exists, please try 'Reset Password'");
                $return=["status"=>false,"error"=>$error] ;
                
                
            }
           }
           else{
            $return=["status"=>false,"error"=>$error] ;  
           }
            //  return new WP_REST_Response($response, 123);
            return wp_send_json($return);
            }
           function initlogin()
           {

            }
            function loginview()
            {
               
                if($_GET["via"]=="campus")
                {
              if(isset($_GET["e"]) && isset($_GET["p"]))
              {
                $login_data = array();  
                $login_data['user_login'] =base64_decode($_GET["e"]) ;  
                $login_data['user_password'] = base64_decode($_GET["p"]);  
                $login_data['remember'] = true;  
                $user_verify = wp_signon($login_data, true );
               
                
             
                if(!is_user_logged_in() ) {
                    // $user = get_userdatabylogin ($user_verify->user_login );
                    // $user_id = $user->ID;
                    $user = get_user_by('id', $user_verify->ID );
                    if ( !is_wp_error( $user ) )
                    { 
                        
                        wp_clear_auth_cookie();
                        wp_set_current_user ( $user->ID ); // Set the current user detail
                        wp_set_auth_cookie  ($user->ID ,true); // Set auth details in cookie
                       

                    // if (wp_validate_auth_cookie()==false)
                    // {
                    //     wp_set_auth_cookie($user_id, false);
                        
                    // }
                    // $role = 'customer';
                    // if ($GLOBALS['wp_roles']->is_role($role)) {
                        
                    //     // wp_redirect('https://store.rozgar.com/my-account/');
                    //     header("location:https://store.rozgar.com/my-account/");
                    //    }
                   

                    //    header("location:https://store.rozgar.com/my-account/");
                         $message = "Logged in successfully";
                    } else {
                         $message = "Failed to log in";
                    }

                 
                    //  echo $message;
                      
                  }
                }
                }
                else{
                    // echo "not right";
                }
                  
           
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