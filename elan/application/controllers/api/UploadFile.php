<?php defined('BASEPATH') OR exit('No direct script access allowed');

    /**
    * @access public
    * @author Sitaram Shreevastava
    * @param 1- add agent related fields 
    * @return whole data base on user id
    * @method post
    */
    class UploadFile extends CI_Controller{
    	function __construct() {
            parent::__construct();
            $this->load->helper( 'api' );
        }
        public function index(){
            $request_data  = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents('php://input');
            $languageCode  = 'en';//currently set as default    
            $file_path = IMAGE_DIRECTORY.'pdf/';
            $file_path = $file_path . basename($_FILES['uploaded_file']['name']);
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
                echo "success";
            } else{
                echo "fail";
            }
        }
    }
?>