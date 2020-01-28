<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProjectDetails extends CI_Controller{
    public function __construct(){
        parent::__construct();
       $this->load->model('api_model','request');
    }
    public function index(){
		if($_SERVER['REQUEST_METHOD']==POST){
			$this->getProject();
		} 
		if($_SERVER['REQUEST_METHOD']==GET){ 
		}  
    }
    public function getProject()
    {
      $requestData = getRequestJson(); 
      $check_request_keys = array('projectid');
      $resultJson    = validateJson($requestData, $check_request_keys); 
      $headers       = apache_request_headers();
      $apiRequest = $this->request->checkApiRequest(@$headers['accessToken'],@$headers['accessId'],@$headers['packageName'],@$headers['deviceId']);
      if(!empty($apiRequest) && count($apiRequest) != 0):
      if($resultJson ==OK)
      {           
        $this->request->getProjectDetails($requestData[APP_NAME]);
      }
      else{
        generateServerResponse('0', '100');
      }
    else:
         generateServerResponse('0', '163');
    endif;
    }
 
}
