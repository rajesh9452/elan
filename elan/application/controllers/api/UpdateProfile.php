<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class UpdateProfile extends CI_Controller{
    public function __construct(){
        parent::__construct();
       $this->load->model('api_model','request');
    }
    public function index(){
		if($_SERVER['REQUEST_METHOD']==POST){
			$this->get_UpdateProfile();
		} 
		if($_SERVER['REQUEST_METHOD']==GET){ 
		}  
    }
    public function get_UpdateProfile()
    {
      $requestData = getRequestJson(); 
      $check_request_keys = array('userId','name','mobile');
      $resultJson    = validateJson($requestData, $check_request_keys); 
      $headers       = apache_request_headers();
      $apiRequest = $this->request->checkApiRequest(@$headers['accessToken'],@$headers['accessId'],@$headers['packageName'],@$headers['deviceId']);
      if(!empty($apiRequest) && count($apiRequest) != 0):
      if($resultJson ==OK)
      {           
        $this->request->updateprofiles($requestData[APP_NAME]);
      }
      else{
        generateServerResponse('0', '100');
      }
    else:
         generateServerResponse('0', '163');
    endif;
    }
 
}
