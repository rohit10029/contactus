<?php
namespace Contactus;

use function WPMailSMTP\Vendor\GuzzleHttp\json_encode;

class Contact {
    function init()
    {
        
             add_action('rest_api_init',array($this,'wp_rest_user_endpoints'));
             add_shortcode('contact_view', array($this,'contactview'));
             add_shortcode('contact_list_view', array($this,'contactlisttview'));
            
         
    }

    function wp_rest_user_endpoints() {
        
        register_rest_route('api/v1', 'send/sms', array(
            'methods' => 'POST',
            'callback' => array($this,'formsubmit'),
        ));
        register_rest_route('api/v1', 'show/list', array(
            'methods' => 'GET',
            'callback' => array($this,'showlist'),
        ));
        }

      
    function emailAddress($d)
    {
        if(!empty($d))
        {
            $d=filter_var($d, FILTER_VALIDATE_EMAIL);
            if($d){
                return true;
            }
            else{
                return false;
            }
    
        }
        else{
            return false;
        }
    
    }

    function onlynumber($d,$n)
   {

    if(!empty($d))
    {
        $d=preg_match("/^[0-9]{1,".$n."}$/",$d);
        if($d){
            return true;
        }
        else{
            return false;
        }

    }
    else{
        return false;
    }
  
    }
    
       function contactview()
       {
          Plugin::view("contactview");
       }    
       
       function contactlisttview()
       {
          Plugin::view("contactlistview");
       }    
           
       function formsubmit()
       {
           
           
           if(isset($_POST))
           {
            
               $error=[];

               if(!$this->emailAddress($_POST["email"]))
               {
                   array_push($error,"email is not valid");

               }

               if(!$this->onlynumber($_POST["phone"],20))
               {
                   array_push($error,"only numbers are allowed in phone no");

               }

               if(count($error)==0)
               {

                global $wpdb;
                $tablename = $wpdb->prefix . "contactus";
                
                $name     =$_POST["name"] ; //string value use: %s
                $email    = $_POST["email"]; //string value use: %s
                $phone    =$_POST["phone"]; //numeric value use: %d
                $message  = $_POST["message"]; //string value use: %s
            
                
                $sql = $wpdb->prepare("INSERT INTO `$tablename` (`name`, `email`, `phone`, `message`) values (%s, %s, %s, %s)", $name, $email, $phone,$message);
               
                
                $wpdb->query($sql);
               
                if($wpdb->last_error=="")
               {
                  
                  $response['code'] = 200;
                $response['message'] = __("We will get back to you soon.", "wp-rest-user");
                $return= ["status"=>true,"message"=> $response['message']] ;
               }
               else{
                $dberror= $wpdb->print_error();
                $return =["status"=>false,"error"=>$dberror] ;
               }
                
            }
            else{
                $return=["status"=>false,"error"=>$error] ; 
            }
                
              return wp_send_json($return);  
            }
            else{
                $return=["status"=>false,"error"=>"All data required"]; 
                return wp_send_json($return);

            }
           
       }

       function showlist()
       {
        global $wpdb;
        global $jal_db_version;
    
        $table_name = $wpdb->prefix . 'contactus';
        
        $sql = "select * from  $table_name;";
        
    
         $results = $wpdb->get_results($sql) ;

         if($wpdb->last_error=="")
         {
         if(count($results)!=0)
         {
            $response['message'] = __("data found", "wp-rest-user");
            $return= ["status"=>true,"message"=> $response['message'],"data"=>$results] ;
            
         }
         else{
            $response['message'] = __("data not found", "wp-rest-user");
            $return= ["status"=>false,"message"=> $response['message']] ;
         }
        }else{
            $response['message'] = __("some sql error", "wp-rest-user");
            $return= ["status"=>true,"message"=> $response['message'],"data"=>$results] ;
        }
        
         return  $return;
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