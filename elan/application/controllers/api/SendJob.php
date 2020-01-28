<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class SendJob extends CI_Controller{
    public function __construct(){
        parent::__construct();
       $this->load->model('api_model','request');
       $this->load->library('M_pdf'); 
       //$this->load->library('PDF_HTML'); 
    }
    public function index(){
		if($_SERVER['REQUEST_METHOD']==POST){
			$this->get_Jobs();
		} 
		if($_SERVER['REQUEST_METHOD']==GET){ 
		}  
    }
    public function get_Jobs()
    {
      $requestData = getRequestJson(); 
      $check_request_keys = array('job_id','user_id','delivery_date');
      $resultJson    =  validateJson($requestData, $check_request_keys); 
      $headers       = apache_request_headers();
      $apiRequest = $this->request->checkApiRequest(@$headers['accessToken'],@$headers['accessId'],@$headers['packageName'],@$headers['deviceId']);
      if(!empty($apiRequest) && count($apiRequest) != 0 || $apiRequest ==0):
      if($resultJson ==OK)
      {           
        $this->request->sendjobs($requestData[APP_NAME]);
      }
      else{
        generateServerResponse('0', '100');
      }
    else:
         generateServerResponse('0', '163');
    endif;
    }
 
}
