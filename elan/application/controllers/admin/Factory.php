<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Factory extends CI_Controller {
    public function __construct(){
    parent::__construct();
    $this->load->model('Login_model','login');
  }
  public $changeStatus = '';
  // logout user account
  public function logoutFactory(){
      $this->session->unset_userdata('factoryData');
      $this->session->set_flashdata('message',generateAdminAlert('S',10));
      redirect('admin-login');
  }
  // admin dashboard
  public function dashboard(){
    is_not_logged_in_factory();
    $response['pageTitle']     = 'Manage dashboard';
    $response['pageIndex']     = 'dashboard';
    $response['totalJobs']     = count($this->login->getTotalJobsAssignFactory());
    $this->load->view('header/factory/header',$response);
    $this->load->view('header/factory/left-menu',$response);
    $this->load->view('factory/dashboard',$response);
    $this->load->view('header/factory/footer');
  }
  public function getDashboardLiveData(){
    $this->login->getFactoryProjectAllNewJobListDashboard();
  }
 public function assignJobList(){
    is_not_logged_in_factory();
    $response['pageTitle']     = 'Job List';
    $response['pageIndex']     = 'jobList';
    $response['result']        = $this->login->getTotalJobsAssignFactory();
    $this->load->view('header/factory/header',$response);
    $this->load->view('header/factory/left-menu',$response);
    $this->load->view('factory/job-list',$response);
    $this->load->view('header/factory/footer');
  }
  public function factoryJobsAssignView($getID){
    is_not_logged_in_factory();
    $response['pageTitle']     = 'Job List';
    $response['pageIndex']     = 'jobList';
    $this->login->updateJobsStatusFactory($getID);
     $response['result'] = $this->login->getProjectJobDetailsFactory($getID);
    $this->load->view('header/factory/header',$response);
    $this->load->view('header/factory/left-menu',$response);
    $this->load->view('factory/job-view',$response);
    $this->load->view('header/factory/footer');
  }
  public function changeJobsStatus(){
     is_not_logged_in_factory();
     $adminData = $this->session->userdata('factoryData');
     $getId = $this->input->post('getId');
     $status = $this->input->post('status');
     $this->db->where('job_id',$getId);
     $this->db->where('factory_id',$adminData['id']);
     $this->db->update('tbl_assign_jobs',array('job_status'=>$status));
     if($status == 2){
       $this->login->sendJobDoneNotofication($getId);
     }
     $this->session->set_flashdata('message',generateAdminAlert('S',13));
     echo 1;exit;
  }
  public function updateProfile(){
    is_not_logged_in_factory();
    $response['pageTitle'] = 'Manage Factory - '.ELAN;
    $response['pageIndex'] = '';
    $response['result'] = $this->login->factoryProfiles();
    $this->load->view('header/factory/header',$response);
    $this->load->view('header/factory/left-menu',$response);
    $this->load->view('factory/admin',$response);
    $this->load->view('header/factory/footer');
  }
  public function updateFactoryProfiles(){
       $data = $this->input->post();
       $adminData = $this->session->userdata('factoryData');
       $adminUpdate = array();
       $logo_file_name = '';
        if (!empty($_FILES['images']['name'])) {
            $path      = IMAGE_DIRECTORY;
            move_uploaded_file($_FILES['images']['tmp_name'],$path.$_FILES['images']['name']);
            $logo_file_name = $_FILES['images']['name'];
            }
        // if(!empty($data['name'])):
        //   $adminUpdate['name'] = $data['name'];
        // endif;
        //  if(!empty($data['email'])):
        //   $adminUpdate['email'] = $data['email'];
        // endif;
        if(!empty($data['password'])):
          $adminUpdate['password'] = base64_encode($data['password']);
        endif;
        if(!empty($logo_file_name)):
          $adminUpdate['profile'] = $logo_file_name;
        endif;
        if(!empty($adminUpdate)){
           $this->db->where('id',$adminData['id']);
           $this->db->update('factory_master',$adminUpdate);
        }
        
        $response = $this->db->get_where('factory_master',array('id'=>$adminData['id']))->row_array();
        $this->session->set_userdata('factoryData',$response);
        $this->session->set_flashdata('message',generateAdminAlert('S',13));
       redirect('factory-update-profile');
  }
}
