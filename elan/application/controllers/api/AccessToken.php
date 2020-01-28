<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class AccessToken extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('api_model','request');
    }
    public function index(){ 
          if($_SERVER['REQUEST_METHOD']== POST){
            $this->getAccess();
          } 
          if($_SERVER['REQUEST_METHOD']==GET){ 
          }  
    }
    /*
    # CALL THE FUNCTION IF REQUEST IS POST 
    */
    public function getAccess(){
      $requestData = getRequestJson(); 
      $check_request_keys = array('0' =>'deviceId');
      $resultJson    =  validateJson($requestData, $check_request_keys); 
      if($resultJson==OK){ 
          $this->request->getAccessToken($requestData[APP_NAME]);
      }
      else {
        generateServerResponse('0', '100');
      }
    }
 
}
