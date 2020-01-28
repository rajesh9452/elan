<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ForgotPassword extends CI_Controller{
    public function __construct(){
        parent::__construct();
       $this->load->model('api_model','request');
    }
    public function index(){
		if($_SERVER['REQUEST_METHOD']==POST){
			$this->get_ForgotPassword();
		} 
		if($_SERVER['REQUEST_METHOD']==GET){ 
		}  
    }
    public function get_ForgotPassword()
    {
      $requestData = getRequestJson(); 
      $check_request_keys = array('email');
      $resultJson    =  validateJson($requestData, $check_request_keys); 
      $headers       = apache_request_headers();
      if(@$headers['packageName'] == md5(PACKAGENAME) || 1==1):
      if($resultJson ==OK)
      {           
        $this->request->forgotuserpassword($requestData[APP_NAME]);
      }
      else{
        generateServerResponse('0', '100');
      }
    else:
         generateServerResponse('0', '163');
    endif;
    }
 
}
