<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
    public function __construct(){
    parent::__construct();
    $this->load->model('Login_model','login');
  }
  public $changeStatus = '';
  public function index(){
    is_logged_in();
    $this->load->view('login');
  }
  // Post admin login data 
  public function loginPost(){
    is_logged_in();
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('userType', 'Login Type', 'required');
        if ($this->form_validation->run() == FALSE):
          $this->index();
        else:
          $userType = $this->input->post('userType');
            if($userType == 1):
                $response = $this->login->loginAccount();
                if(!empty($response)):
                  $name = $this->session->set_userdata('adminData',$response);
                  redirect('admin-dashboard');
                else:
                  $this->session->set_flashdata('message',generateAdminAlert('D',1));
                  redirect('admin-login');
                endif;
              elseif($userType == 2):
                 $response = $this->login->loginFactoryAccount();
                 if(!empty($response)):
                    $name = $this->session->set_userdata('factoryData',$response);
                    redirect('factory-dashboard');
                else:
                  $this->session->set_flashdata('message',generateAdminAlert('D',1));
                  redirect('admin-login');
                endif;
              endif;

          // close account login 
        endif;
        // close 
  }
  // logout user account
  public function logoutAccount(){
      $this->session->unset_userdata('adminData');
      $this->session->set_flashdata('message',generateAdminAlert('S',10));
      redirect('admin-login');
  }
  // admin dashboard
  public function dashboard(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage dashboard';
    $response['pageIndex'] = 'dashboard';
    $response['totalProjects'] = $this->db->get_where('project_master',array('status !='=>3))->num_rows();
    $response['totalJobs'] = $this->db->get_where('jobs_master',array('status !='=>3))->num_rows();
    $response['totalUsers'] = $this->db->get_where('user_master',array('status !='=>3))->num_rows();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('dashboard',$response);
    $this->load->view('header/footer');
  }
  public function getDashboardLiveData(){
    $this->login->getProjectAllNewJobListDashboard();
  }
  // public function getDashboardLiveDataGet(){
  //   $this->login->projectAllNewJobListDashboardGet();
  // }
  // Manage of the information 
  public function manageUsers(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage users - '.ELAN;
    $response['pageIndex'] = 'usersList';
    $response['result'] = $this->login->getUsersList();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('manage-usersList',$response);
    $this->load->view('header/footer');
  }
  // Manage of the information 
  public function addNewUsers($id=FALSE){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage users - '.ELAN;
    $response['pageIndex'] = 'usersList';
    if(!empty($id))
    $response['result'] = $this->login->getUsersDetails($id);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('user-details',$response);
    $this->load->view('header/footer');
  }
  public function registerAccount(){
        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_emailValidate_check');
        $this->form_validation->set_rules('number', 'number', 'required|callback_number_check');
            if ($this->form_validation->run() == FALSE){
                  $response['pageTitle'] = 'Manage users - '.ELAN;
                  $response['pageIndex'] = 'usersList';
                  if(!empty($id)){
                     $response['result'] = $this->login->getUsersDetails(base64_encode($id));
                  }
                  $this->load->view('header/header',$response);
                  $this->load->view('header/left-menu',$response);
                  $this->load->view('user-details',$response);
                  $this->load->view('header/footer');
            }else{
              $check = $this->login->registerAccount();
               if(!empty($id)):
                $this->session->set_flashdata('message',generateAdminAlert('S',13));
            else:
                $this->session->set_flashdata('message',generateAdminAlert('S',11));
            endif;
              redirect('manage-users');
            }
  }
  public function emailValidate_check($email){
     $id = $this->input->post('id');
     if(!empty($id)){
      $check = $this->db->get_where('user_master',array('email'=>$email,'status !='=>3,'id !='=>$id))->num_rows();
    }else{
      $check = $this->db->get_where('user_master',array('email'=>$email,'status !='=>3))->num_rows();
    }
     if($check > 0){
          $this->form_validation->set_message('emailValidate_check', '!Oops this email id already exist.');
            return FALSE;
     }else{
        return true;
     }
  }
  public function number_check($number){
     $id = $this->input->post('id');
     if(!empty($id)){
       $check = $this->db->get_where('user_master',array('mobileNumber'=>$number,'status !='=>3,'id !='=>$id))->num_rows();
     }else{
      $check = $this->db->get_where('user_master',array('mobileNumber'=>$number,'status !='=>3))->num_rows();
    }
     if($check > 0){
          $this->form_validation->set_message('number_check', '!Oops this mobile number already exist.');
            return FALSE;
     }else{
        return true;
     }
  }
  public function usersdelete($id){
     is_not_logged_in();
     $check = $this->login->updateUserStatus($id,'3');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',16));
      redirect('manage-users');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-users');
     endif;
          
  }
  public function usersactivate($id){
     is_not_logged_in();
     $check = $this->login->updateUserStatus($id,'1');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',15));
      redirect('manage-users');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-users');
     endif;
          
  }
  public function usersDeactivate($id){
     is_not_logged_in();
     $check = $this->login->updateUserStatus($id,'2');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',14));
      redirect('manage-users');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-users');
     endif;
          
  }
  public function adminUpdateProfile(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Admin - '.ELAN;
    $response['pageIndex'] = '';
    $response['result'] = $this->login->adminProfiles();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('admin',$response);
    $this->load->view('header/footer');
  }
  public function updateAdminProfiles(){
       $data = $this->input->post();
       $adminUpdate = array();
       $logo_file_name = '';
        if (!empty($_FILES['images']['name'])) {
            $path      = IMAGE_DIRECTORY;
            move_uploaded_file($_FILES['images']['tmp_name'],$path.$_FILES['images']['name']);
            $logo_file_name = $_FILES['images']['name'];
            }
        if(!empty($data['name'])):
          $adminUpdate['name'] = $data['name'];
        endif;
         if(!empty($data['email'])):
          $adminUpdate['email'] = $data['email'];
        endif;
        if(!empty($data['password'])):
          $adminUpdate['password'] = base64_encode($data['password']);
        endif;
        if(!empty($logo_file_name)):
          $adminUpdate['profile'] = $logo_file_name;
        endif;
        if(!empty($adminUpdate)){
           $this->db->where('id',1);
           $this->db->update(ADMIN,$adminUpdate);
        }
        $response = $this->db->get_where(ADMIN,array('id'=>1))->row_array();
        $this->session->set_userdata('adminData',$response);
        $this->session->set_flashdata('message',generateAdminAlert('S',13));
       redirect('admin-profile-update');
  }
    // Manage projects 
  public function manageProjects(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Projects - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['result'] = $this->login->getProjectList();
    $response['search'] = $this->input->get();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('manage-project',$response);
    $this->load->view('header/footer');
  }
  public function addProjects(){
    is_not_logged_in();
    $response['pageTitle'] = 'Add Project - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['companyResult'] = $this->db->get_where('manage_company',array('status'=>1))->result_array();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('add-project',$response);
    $this->load->view('header/footer');
  }
   public function addProjectsPost(){
        $id = $this->input->post('id');
        $this->form_validation->set_rules('name', 'Project Name', 'required');
        $this->form_validation->set_rules('number', 'Project Number', 'required|callback_projectNumber'); 
            if ($this->form_validation->run() == FALSE){
                  $response['pageTitle'] = 'Add Project - '.ELAN;
                  $response['pageIndex'] = 'projects';
                  $response['companyResult'] = $this->db->get_where('manage_company',array('status'=>1))->result_array();
                  if(!empty($id)){
                     $response['result'] = $this->login->getProjectListUpdate(base64_encode($id));
                  }
                  $this->load->view('header/header',$response);
                  $this->load->view('header/left-menu',$response);
                  $this->load->view('add-project',$response);
                  $this->load->view('header/footer');
            }else{
              $check = $this->login->addNewProjects();
               if(!empty($id)):
                $this->session->set_flashdata('message',generateAdminAlert('S',13));
            else:
                $this->session->set_flashdata('message',generateAdminAlert('S',11));
            endif;
              redirect('manage-projects-list');
            }
  }
  public function projectNumber($project){
      $id = $this->input->post('id');
      if(empty($id)){
        $check = $this->db->get_where('project_master',array('projetc_number'=>$project))->row_array();
        if(!empty($check)){
         $this->form_validation->set_message('projectNumber', '!Oops project number already exist in database.');
          return FALSE;
        }
           return true;   
      }else{
         $check = $this->db->get_where('project_master',array('projetc_number'=>$project,'id'=>base64_decode($id)))->row_array();
        if(!empty($check)){
         $this->form_validation->set_message('projectNumber', '!Oops project number already exist in database.');
          return FALSE;
        }
           return true;   
      }
  }
    public function updateProjects($id=FALSE){
      is_not_logged_in();
      $response['pageTitle'] = 'Add Project - '.ELAN;
      $response['pageIndex'] = 'projects';
      $response['companyResult'] = $this->db->get_where('manage_company',array('status'=>1))->result_array();
      if(!empty($id)):
        $response['document'] = $this->db->get_where('project_document',array('project_id'=>base64_decode($id)))->result_array();
      endif;
      $response['result'] = $this->login->getProjectListUpdate($id);
      $this->load->view('header/header',$response);
      $this->load->view('header/left-menu',$response);
      $this->load->view('add-project',$response);
      $this->load->view('header/footer');
    }

    public function projectsdelete($id){
     is_not_logged_in();
     $check = $this->login->updateProjectStatus($id,'3');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',16));
     redirect('manage-projects-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
    redirect('manage-projects-list');
     endif;
          
  }
  public function projectsctivate($id){
     is_not_logged_in();
     $check = $this->login->updateProjectStatus($id,'1');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',15));
      redirect('manage-projects-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-projects-list');
     endif;
          
  }
  public function projectsDeactivate($id){
     is_not_logged_in();
     $check = $this->login->updateProjectStatus($id,'2');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',14));
      redirect('manage-projects-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
     redirect('manage-projects-list');
     endif;   
  }
  //  public function projectAsignUsers($getID){
  //   is_not_logged_in();
  //   $response['pageTitle'] = 'Projects Asign List - '.ELAN;
  //   $response['pageIndex'] = 'projects';
  //   $response['result'] = $this->login->getProjectList();
  //   $this->load->view('header/header',$response);
  //   $this->load->view('header/left-menu',$response);
  //   $this->load->view('manage-project',$response);
  //   $this->load->view('header/footer');
  // }
  public function projectJobsList($getID){
    is_not_logged_in();
    $response['pageTitle'] = 'Projects Asign List - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['result'] = $this->login->getjobsList($getID);
    $response['projectsID'] = $getID;
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('job-list',$response);
    $this->load->view('header/footer');
  }
   public function projectAssignUserList($getID){
    is_not_logged_in();
    $response['pageTitle'] = 'Projects Asign List - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['projetcID'] = $getID;
    $response['result'] = $this->login->getActiveUsersList($getID);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('manage-assign-users-List',$response);
    $this->load->view('header/footer');
  }
  public function projectAssignList($projetcID){
    is_not_logged_in();
    $response['pageTitle'] = 'Projects Asign List - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['projetcID'] = $projetcID;
    $response['result'] = $this->login->getUsersActiveList($projetcID);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('project-asign-user-list',$response);
    $this->load->view('header/footer');
  }
  public function addProjectAssignUsers(){
     $data = $this->input->post();
     $this->db->insert('user_assign_project',array('user_id'=>$data['getId'],'project_id'=>base64_decode($data['projetcID']),'add_date'=>time()));
     $this->login->sendPushNotification($data['getId'],$data['projetcID']);
     echo 1;exit;
  }
  public function projectAssignDelete($getId,$getProjectId,$type=0){
   $this->db->where('id',base64_decode($getId));
   $this->db->delete('user_assign_project');
   $this->session->set_flashdata('message',generateAdminAlert('S',25));
   if($type == 0){
      redirect('project-assign-user-list/'.$getProjectId);
    }else{
      redirect('project-view/'.$getProjectId);
    }
 
  }
    // Manage Company 
  public function manageCompany(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Company - '.ELAN;
    $response['pageIndex'] = 'company';
    $response['result'] = $this->login->getCompanyList();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('manage-companyList',$response);
    $this->load->view('header/footer');
  }
   public function companydelete($id){
     is_not_logged_in();
     $check = $this->login->updateCompanyStatus($id,'3');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',16));
     redirect('manage-company-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
    redirect('manage-company-list');
     endif;
          
  }
  public function companyactivate($id){
     is_not_logged_in();
     $check = $this->login->updateCompanyStatus($id,'1');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',15));
      redirect('manage-company-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-company-list');
     endif;
          
  }
  public function companyDeactivate($id){
     is_not_logged_in();
     $check = $this->login->updateCompanyStatus($id,'2');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',14));
      redirect('manage-company-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
     redirect('manage-company-list');
     endif;   
  }
   // Manage of the information 
  public function addNewcompany($id=FALSE){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage company - '.ELAN;
    $response['pageIndex'] = 'company';
    if(!empty($id))
    $response['result'] = $this->login->getCompanyDetails($id);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('company-details',$response);
    $this->load->view('header/footer');
  }
   public function registerCompanyAccount(){
        $id = $this->input->post('id');
        $check = $this->login->registerCompanyAccount();
        if(!empty($id)):
           $this->session->set_flashdata('message',generateAdminAlert('S',13));
        else:
           $this->session->set_flashdata('message',generateAdminAlert('S',11));
        endif;
         redirect('manage-company-list');
  }
   public function projectJobsListDelete($id,$project,$type=0){
     is_not_logged_in();
     $check = $this->login->updateProjectJobsStatus($id,'3');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',16));
         if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
        
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
       if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
     endif;   
  }
  public function projectJobsListactive($id,$project,$type=0){
     is_not_logged_in();
     $check = $this->login->updateProjectJobsStatus($id,'1');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',15));
        if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
       if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
     endif;
          
  }
  public function projectJobsListDeactive($id,$project,$type=0){
     is_not_logged_in();
     $check = $this->login->updateProjectJobsStatus($id,'2');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',14));
        if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
       if($type == 1):
           redirect('project-view/'.base64_encode($project));
         else:
           redirect('jobs-list/'.$project);
         endif;
     endif;   
  }
  public function projectView($id){
    is_not_logged_in();
    $response['pageTitle'] = 'Project Detail - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['companyResult'] = $this->db->get_where('manage_company',array('status'=>1))->result_array();
    if(!empty($id)):
       $response['document'] = $this->db->get_where('project_document',array('project_id'=>base64_decode($id)))->result_array();
    endif;
    $response['result']  = $this->login->getProjectListUpdate($id);
    $response['jobList'] = $this->login->getjobsListProjectDetails($id);
    $response['users']   = $this->login->getActiveUsersList($id);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('project-view',$response);
    $this->load->view('header/footer');
  }
  /* Manage Factory*/
   // Manage Factory 
  public function manageFactory(){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Factory - '.ELAN;
    $response['pageIndex'] = 'factory';
    $response['result'] = $this->login->getFactoryList();
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('manage-factoryList',$response);
    $this->load->view('header/footer');
  }
   // Manage of the information 
  public function addNewFactory($id=FALSE){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Factory - '.ELAN;
    $response['pageIndex'] = 'factory';
    if(!empty($id))
    $response['result'] = $this->login->getFactoryDetails($id);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('factory-details',$response);
    $this->load->view('header/footer');
  }
  public function registerFactoryAccount(){
        $id = $this->input->post('id');
        $check = $this->login->registerFactoryAccount();
      if(!empty($id)):
         $this->session->set_flashdata('message',generateAdminAlert('S',13));
      else:
         $this->session->set_flashdata('message',generateAdminAlert('S',11));
      endif;
       redirect('manage-factory-list');
  }
  public function factorydelete($id){
     is_not_logged_in();
     $check = $this->login->updateFactoryStatus($id,'3');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',16));
     redirect('manage-factory-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
    redirect('manage-factory-list');
     endif;    
  }
  public function factoryactivate($id){
     is_not_logged_in();
     $check = $this->login->updateFactoryStatus($id,'1');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',15));
      redirect('manage-factory-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
      redirect('manage-factory-list');
     endif;    
  }
  public function factoryDeactivate($id){
     is_not_logged_in();
     $check = $this->login->updateFactoryStatus($id,'2');
     if($check > 0):
       $this->session->set_flashdata('message',generateAdminAlert('S',14));
      redirect('manage-factory-list');
     else:
       $this->session->set_flashdata('message',generateAdminAlert('D',12));
     redirect('manage-factory-list');
     endif;   
  }
  public function factoryJobsAssign($getID){
    is_not_logged_in();
    $response['pageTitle'] = 'Factory Asign Job- '.ELAN;
    $response['pageIndex'] = 'projects';
    $this->login->updateJobsStatus($getID);
    $response['result'] = $this->login->getProjectJobDetails($getID);
    $response['factory'] = $this->login->getFactoryListDetails();
    $response['projectsID'] = $getID;
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('factory-job-assign',$response);
    $this->load->view('header/footer');
  }
  // public function factoryJobsAssignPost(){
  //    $factoryId = $this->input->post('factoryId');
  //    $jobId     = $this->input->post('jobId');
  //    $check = $this->db->get_where('tbl_assign_jobs',array('factory_id'=>$factoryId,'job_id'=>$jobId))->row_array();
  //    if(empty($check)){
  //         $insert = array();
  //         $insert['factory_id']      = $factoryId;
  //         $insert['job_id']          = $jobId;
  //         $insert['add_date']        = time();
  //         $insert['modify_date']     = time();
  //         $insert['status']          = 1;
  //         $insert['job_seen_status'] = 1;
  //         $insert['job_status']      = 1;
  //         $this->db->insert('tbl_assign_jobs',$insert);
  //         echo 1;exit;
  //    }else{
  //     echo 1;exit;
  //    }
  // }
  public function changeJobsStatus(){
     $getId = $this->input->post('getId');
     $status = $this->input->post('status');
     $this->db->where('id',$getId);
     $this->db->update('jobs_master',array('job_status'=>$status));
     if($status == 2){
        $factoryId = $this->input->post('jobAssignFactory');
        $jobId     = $getId;
        $check = $this->db->get_where('tbl_assign_jobs',array('factory_id'=>$factoryId,'job_id'=>$jobId))->row_array();
         if(empty($check)){
              $insert = array();
              $insert['factory_id']      = $factoryId;
              $insert['job_id']          = $jobId;
              $insert['add_date']        = time();
              $insert['modify_date']     = time();
              $insert['status']          = 1;
              $insert['job_seen_status'] = 1;
              $insert['job_status']      = 1;
              $this->db->insert('tbl_assign_jobs',$insert);
         }
     }else{
         $this->db->where('job_id',$getId);
         $this->db->delete('tbl_assign_jobs');
     }
     $this->session->set_flashdata('message',generateAdminAlert('S',26));
     echo 1;exit;
  }
  public function deleteProjectPdf(){
        $getId = $this->input->post('argument');
        $this->db->where('id',$getId);
        $this->db->delete('project_document');
        echo 1;exit;
  }
    // Manage projects 
  public function projectGalleryView($getId){
    is_not_logged_in();
    $response['pageTitle'] = 'Manage Projects Gallery - '.ELAN;
    $response['pageIndex'] = 'projects';
    $response['result']       = $this->login->getGalleryImage(base64_decode($getId));
    $response['projectId']    = base64_decode($getId);
    $this->load->view('header/header',$response);
    $this->load->view('header/left-menu',$response);
    $this->load->view('gallery',$response);
    $this->load->view('header/footer');
  }
  public function projectGalleryViewPost(){
       $dataInfo = array();
    if(!empty($_FILES["gallery"]['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt   = count($_FILES['gallery']['name']);
        for($i=0; $i<$cpt; $i++){           
            $_FILES['userfile']['name']    = $files['gallery']['name'][$i];
            $_FILES['userfile']['type']    = $files['gallery']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['gallery']['tmp_name'][$i];
            $_FILES['userfile']['error']   = $files['gallery']['error'][$i];
            $_FILES['userfile']['size']    = $files['gallery']['size'][$i];    
            $this->upload->initialize($this->set_upload_optionsGallery());
            $this->upload->do_upload();
            $dataInfo[] = $this->upload->data();
        }
    }
     // Image
    $projectId = $this->input->post('project');
      if(!empty($dataInfo[0]['file_name'])){
         foreach($dataInfo as $list){
             $addProject = array();
             $addProject['user_id']     = 1;
             $addProject['project_id']  = $projectId;
             $addProject['user_type']   = 1;
             $addProject['imageUrl']    = $list['file_name'];
             $addProject['add_date']    = time();
             $this->db->insert('project_gallery',$addProject);
           }
      }
      $this->session->set_flashdata('message',generateAdminAlert('S',13));
      redirect('project-gallery-view/'.base64_encode($projectId));
  }
  private function set_upload_optionsGallery(){   
    //upload an image options
    $config = array();
    $config['upload_path']   = './uploads/gallery/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['overwrite']     = TRUE;
    $config['encrypt_name']  = TRUE;
    $config['remove_spaces'] = TRUE;
    return $config;
 }
 public function deleteProjectGalleryImages(){
        $getId = $this->input->post('argument');
        $this->db->where('id',$getId);
        $this->db->delete('project_gallery');
        echo 1;exit;
  }

}
