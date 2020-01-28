<?php
class Login_model extends CI_Model {
  public $activate   = 1;
  public $deactivate = 2;
  public $delete     = 3;
  public $status     = 'status';
  public function loginAccount(){
  $request = $this->input->post();
  return $this->db->get_where(ADMIN,array(EMAIL => $request[EMAIL], PASS => base64_encode($request[PASS])))->row_array();
 }
 public function loginFactoryAccount(){
  $request = $this->input->post();
  return $this->db->get_where('factory_master',array(EMAIL => $request[EMAIL], PASS => base64_encode($request[PASS])))->row_array();
 }
 // return data from the databse in manage information table
 public function getUsersList(){
      $this->db->order_by('id','desc');
  return $this->db->get_where(USERS,array($this->status.' !=' => $this->delete))->result();
 }
 public function getUsersDetails($id){
  $this->db->order_by('id','desc');
  return $this->db->get_where(USERS,array('id' =>base64_decode($id)))->row_array();
 }
 public function getCompanyDetails($id){
  $this->db->order_by('id','desc');
  return $this->db->get_where('manage_company',array('id' =>base64_decode($id)))->row_array();
 }
 public function updateUserStatus($id,$status){
      $getUser =  $this->db->get_where(USERS,array('id' =>base64_decode($id)))->row_array();
   $this->db->where('id',base64_decode($id));
   $this->db->update(USERS,array($this->status => $status));
   if($status == 2){
    $message = "!Oops your accunt has been deactivate.";
    sendMail($getUser['email'],$message);
   }else if($status == 1){
     $message = "Your accunt has been activate.";
      sendMail($getUser['email'],$message);
   }

     return $this->db->affected_rows();
 }
  public function adminProfiles(){
  return $this->db->get_where('admin_master')->row_array();
 }
 public function factoryProfiles(){
    $adminData = $this->session->userdata('factoryData');
  return $this->db->get_where('factory_master',array('id'=>$adminData['id']))->row_array();
 }
 /*
 # get login users fcm id
 */
 public function sendJobDoneNotofication($jobId){
    $this->db->select('jobs_master.id,jobs_master.job_name,jobs_master.user_id,login_master.fcm_id');
    $this->db->from('jobs_master');
    $this->db->join('login_master','login_master.user_id=jobs_master.user_id','inner');
    $this->db->where('jobs_master.id',$jobId);
    $result = $this->db->get()->result_array();
    foreach ($result as $key => $list) {
        self::sendPushFactoryNotification($list['fcm_id'],$list['job_name']);
    }
 }
 public function sendPushFactoryNotification($fcm_id  = false,$jobNumber=false) {
            $registrationIds = $fcm_id;
            $msg2 = array ('message'   =>"Your job ".$jobNumber." is READY",'type'=>1);
            $fields = array ('to' => $registrationIds,'data' => $msg2);
            /* echo json_encode( $msg ); exit;*/
            $headers = array ('Authorization: key='.API_ACCESS_KEYS,'Content-Type: application/json');
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
            $result = curl_exec($ch );
            curl_close( $ch );
            return $result;
  }
 public function registerAccount(){
  $request = $this->input->post();
  $insertData = array();
    $insertData['name']         = $request['name'];
    $insertData['email']        = $request['email'];
    $insertData['mobileNumber'] = $request['number'];
    $insertData['password']     = base64_encode($request['password']);
    $insertData['modifyDate'] = time();
    if(!empty($request['id'])){
      $this->db->where('id',$request['id']);
      $this->db->update(USERS,$insertData);
      return $this->db->affected_rows();
    }else{
       $insertData['addDate']    = time();
       $this->db->insert(USERS,$insertData);
       $message = "Thanks for register accunt with ".ELAN;
       sendMail($request['email'],$message);
        return $this->db->affected_rows();
    }
 }
 public function getProjectList(){
        $search = $this->input->get();
        $this->db->order_by('id','desc');
        $this->db->select('project_master.*,(select count(id) from jobs_master where projetc_id = project_master.id AND delivery_date is not NULL AND status =1) as totalJobs,(select count(user_assign_project.id) from user_assign_project INNER JOIN user_master on user_master.id = user_assign_project.user_id  where user_assign_project.project_id = project_master.id AND user_master.status=1) as totalUsers');
          if(!empty($search) && $search['filter'] != 3){
            $this->db->where('projectStatus',$search['filter']);
         }
  return $this->db->get_where('project_master',array('status !='=>3))->result();
 }
 public function getProjectListUpdate($getId){
  return $this->db->get_where('project_master',array('id'=>base64_decode($getId)))->row_array();
 }
 public function addNewProjects(){
    $request = $this->input->post();
    $insertData = array();
     if(!empty($_FILES["projectImages"]["name"])):
          $config['upload_path'] = './uploads/project/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['overwrite'] = TRUE;
          $config['encrypt_name'] = false;
          $config['remove_spaces'] = TRUE;
          $this->load->library('upload', $config);
          $this->upload->do_upload('projectImages');
          $imageDetailArray = $this->upload->data();
          $insertData['projectImage']   =  $imageDetailArray['file_name'];
     endif;
      $dataInfo = array();
    if(!empty($_FILES["document"]['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['document']['name']);
        for($i=0; $i<$cpt; $i++){           
            $_FILES['userfile']['name']= $files['document']['name'][$i];
            $_FILES['userfile']['type']= $files['document']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['document']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['document']['error'][$i];
            $_FILES['userfile']['size']= $files['document']['size'][$i];    
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
            $dataInfo[] = $this->upload->data();
        }
    }
    $insertData['project_name']   = $request['name'];
    $insertData['projetc_number'] = $request['number'];
    $insertData['company_id']     = $request['company_id'];
    $insertData['address']        = $request['address'];
    $insertData['modify_date']    = time();
    if(!empty($request['id'])){
      $insertData['projectStatus']        = $request['projectStatus'];
      $this->db->where('id',$request['id']);
      $this->db->update('project_master',$insertData);
      self::updateDocument($request['id'],$dataInfo);
      return $this->db->affected_rows();
    }else{
       $insertData['add_date']    = time();
        $this->db->insert('project_master',$insertData);
        $lastInsertId = $this->db->insert_id();
        self::updateDocument($lastInsertId,$dataInfo);
        return $this->db->affected_rows();
    }
 }
 private function set_upload_options(){   
    //upload an image options
    $config = array();
    $config['upload_path'] = './uploads/document/';
    $config['allowed_types'] = 'pdf|xls|xlsx|doc|docx';
    $config['overwrite'] = TRUE;
    $config['encrypt_name'] = false;
    $config['remove_spaces'] = TRUE;
    return $config;
 }
 public function updateDocument($getId,$data){
       if(!empty($data[0]['file_name'])){
            // $this->db->where('project_id',$getId);
            // $this->db->delete('project_document');
           foreach($data as $list){
             $addProject = array();
             $addProject['project_id']  = $getId;
             $addProject['project_url'] = $list['file_name'];
             $addProject['add_date']    = time();
             $this->db->insert('project_document',$addProject);
           }
           return true;
       }else{
        return true;
       }
 }

 public function updateProjectStatus($id,$status){
   $this->db->where('id',base64_decode($id));
     $this->db->update('project_master',array($this->status => $status));
     return $this->db->affected_rows();
 }
 public function updateProjectJobsStatus($id,$status){
   $this->db->where('id',base64_decode($id));
     $this->db->update('jobs_master',array($this->status => $status));
     return $this->db->affected_rows();
 }

 public function getjobsList($id){
  $this->db->order_by('jobs_master.status_seen','asc');
  $this->db->select('jobs_master.*,tbl_assign_jobs.job_status as assignJobStatus');
  $this->db->from('jobs_master');
  $this->db->join('tbl_assign_jobs','tbl_assign_jobs.job_id = jobs_master.id','left');
  $this->db->where('jobs_master.projetc_id',base64_decode($id));
  $this->db->where('jobs_master.'.$this->status.' !=',3);
  return $this->db->get()->result();
 }
 public function getjobsListProjectDetails($id){
  $this->db->limit(7);
  $this->db->order_by('jobs_master.status_seen','asc');
  $this->db->select('jobs_master.*,tbl_assign_jobs.job_status as assignJobStatus');
  $this->db->from('jobs_master');
  $this->db->join('tbl_assign_jobs','tbl_assign_jobs.job_id = jobs_master.id','left');
  $this->db->where('jobs_master.projetc_id',base64_decode($id));
  $this->db->where('jobs_master.'.$this->status,1);
  $this->db->where('jobs_master.delivery_date is NOT NULL', NULL, FALSE);
  return $this->db->get()->result();
 }
  public function getActiveUsersList($getID){
     $sql ='SELECT uap.id AS assign_id,um.id as userid,um.name,um.mobileNumber,um.email,um.profile,pm.project_name,pm.projetc_number FROM `user_assign_project` AS uap INNER JOIN project_master AS pm ON pm.id = uap.project_id INNER JOIN user_master AS um ON um.id = uap.user_id WHERE um.status = 1 AND pm.id='.base64_decode($getID).' ORDER BY uap.id DESC';
  return $this->db->query($sql)->result();
 }
 public function getUsersActiveList($projetcID){
      $getId = $this->db->select('user_id')->get_where('user_assign_project',array('project_id'=>base64_decode($projetcID)))->result_array();
      $this->db->order_by('id','desc');
         if(!empty($getId)){
          $user_id = array_column($getId, 'user_id');
          $this->db->where_not_in('id',$user_id);
        }
      $this->db->where($this->status,1);
  return $this->db->get(USERS)->result();
 }
 public function sendPushNotification($userID,$projetcID) {
           $userData =  $this->db->select('fcm_id')->get_where('login_master',array('status'=>1,'user_id'=>$userID))->row_array();
         $project =  $this->db->get_where('project_master',array('id'=>base64_decode($projetcID)))->row_array();
         
          $message =  'You have to assign '.$project['project_name'].' project.Project code is:'.$project['projetc_number'];
            $registrationIds = $userData['fcm_id'];
            $fields = array (
                                'to' => $registrationIds,
                                'data' => $message
                            );
            /* echo json_encode( $msg ); exit;*/
            $headers = array (
                                'Authorization: key='.API_ACCESS_KEYS,
                                'Content-Type: application/json'
                            );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
            $result = curl_exec($ch );
            curl_close( $ch );
            return $result;
        }
        public function getCompanyList(){
            return $this->db->get_where('manage_company',array('status !='=>3))->result();
        }
 public function updateCompanyStatus($id,$status){
   $this->db->where('id',base64_decode($id));
     $this->db->update('manage_company',array($this->status => $status));
     return $this->db->affected_rows();
 }
 public function registerCompanyAccount(){
  $request = $this->input->post();
  //print_r($request);exit;
    $insertData = array();
    $insertData['name']         = $request['name'];
    $insertData['email']        = $request['email'];
    $insertData['mobile']      = $request['number'];
    $insertData['address']      = $request['address'];
    $insertData['pincode']      = $request['pincode'];
    $insertData['modify_date'] = time();
    if(!empty($request['id'])){
      $this->db->where('id',$request['id']);
      $this->db->update('manage_company',$insertData);
      return $this->db->affected_rows();
    }else{
       $insertData['add_date']    = time();
       $this->db->insert('manage_company',$insertData);
        return $this->db->affected_rows();
    }
 }
 public function getProjectDetailsss($getId){
    $this->db->order_by('id','desc');
    $this->db->select('project_master.*,(select count(id) from jobs_master where projetc_id = project_master.id) as totalJobs,(select count(user_assign_project.id) from user_assign_project INNER JOIN user_master on user_master.id = user_assign_project.user_id  where user_assign_project.project_id = project_master.id AND user_master.status=1) as totalUsers');
  return $this->db->get_where('project_master',array('status !='=>3,'id'=>$getId))->row_array();
 }
  public function getFactoryList(){
     return $this->db->get_where('factory_master',array('status !='=>3))->result();
  }
  public function registerFactoryAccount(){
    $request = $this->input->post();
    $insertData = array();
    $insertData['name']    = $request['name'];
    $insertData['email']   = $request['email'];
    $insertData['mobile']  = $request['number'];
    $insertData['address'] = $request['address'];
     if(!empty($request['password'])):
        $insertData['password'] = base64_encode($request['password']);
      endif;
    $insertData['modify_date'] = time();
    if(!empty($request['id'])){
      $this->db->where('id',$request['id']);
      $this->db->update('factory_master',$insertData);
      return $this->db->affected_rows();
    }else{
       $insertData['add_date']    = time();
       $this->db->insert('factory_master',$insertData);
        return $this->db->affected_rows();
    }
 }
 public function getFactoryDetails($id){
  $this->db->order_by('id','desc');
  return $this->db->get_where('factory_master',array('id' =>base64_decode($id)))->row_array();
 }
 public function updateFactoryStatus($id,$status){
   $this->db->where('id',base64_decode($id));
     $this->db->update('factory_master',array($this->status => $status));
     return $this->db->affected_rows();
 }
 public function getTotalJobsAssignFactory(){
    $adminData = $this->session->userdata('factoryData');
    $this->db->order_by('tbl_assign_jobs.job_seen_status','desc');
    $this->db->select('tbl_assign_jobs.*,jobs_master.job_name,jobs_master.user_id,jobs_master.delivery_date,jobs_master.pdf_url,jobs_master.projetc_id,project_master.company_id,project_master.project_name,project_master.projetc_number,project_master.address,project_master.projectImage,project_master.projectStatus');
    $this->db->from('tbl_assign_jobs');
    $this->db->join('jobs_master','jobs_master.id= tbl_assign_jobs.job_id','inner');
    $this->db->join('project_master','project_master.id= jobs_master.projetc_id','inner');
    $this->db->where('project_master.projectStatus !=',2);
    $this->db->where('jobs_master.job_status',2);
    $this->db->where('tbl_assign_jobs.factory_id',$adminData['id']);
    return $this->db->get()->result_array();
 }
 public function updateJobsStatus($getId){
  $this->db->where('id',$getId);
  $this->db->update('jobs_master',array('status_seen'=>2));
  return $this->db->affected_rows();
 }
 public function getProjectJobDetails($getJobId){
  $this->db->select('jobs_master.*,project_master.id as project_id,project_master.project_name,project_master.projetc_number,project_master.address,project_master.projectImage,project_master.add_date as project_date,manage_company.name as companyName,project_master.company_id,tbl_assign_jobs.factory_id');
  $this->db->from('jobs_master');
  $this->db->join('project_master','project_master.id=jobs_master.projetc_id','inner');
  $this->db->join('manage_company','manage_company.id=project_master.company_id','inner');
  $this->db->join('tbl_assign_jobs','tbl_assign_jobs.job_id=jobs_master.id','left');
  $this->db->where('jobs_master.id',$getJobId);
  return $this->db->get()->row_array();
 }
   public function getFactoryListDetails(){
    return $this->db->get_where('factory_master',array('status'=>1))->result_array();
   }
   public function getProjectJobDetailsFactory($getJobId){
    $adminData = $this->session->userdata('factoryData');
  $this->db->select('jobs_master.*,project_master.id as project_id,project_master.project_name,project_master.projetc_number,project_master.address,project_master.projectImage,project_master.add_date as project_date,manage_company.name as companyName,project_master.company_id,tbl_assign_jobs.factory_id,tbl_assign_jobs.job_status as jobAssignStatus');
  $this->db->from('jobs_master');
  $this->db->join('project_master','project_master.id=jobs_master.projetc_id','inner');
  $this->db->join('manage_company','manage_company.id=project_master.company_id','inner');
  $this->db->join('tbl_assign_jobs','tbl_assign_jobs.job_id=jobs_master.id','inner');
  $this->db->where('jobs_master.id',$getJobId);
  $this->db->where('tbl_assign_jobs.factory_id',$adminData['id']);
  return $this->db->get()->row_array();
 }
 public function updateJobsStatusFactory($getId){
    $adminData = $this->session->userdata('factoryData');
    $this->db->where('job_id',$getId);
    $this->db->where('factory_id',$adminData['id']);
    $this->db->update('tbl_assign_jobs',array('job_seen_status'=>2));
    return $this->db->affected_rows();
 }
  public function getFactoryProjectAllNewJobListDashboard(){
    $this->db->reconnect();
    $adminData = $this->session->userdata('factoryData');
    $lastDate = $this->input->post('lastMessageDate');
    $this->db->order_by('jobs_master.status_seen','desc');
    $this->db->order_by('jobs_master.add_date','desc');
    $this->db->limit(10);
    $this->db->select('tbl_assign_jobs.*,jobs_master.job_name,jobs_master.pdf_url,project_master.id as project_id,project_master.project_name,project_master.projetc_number,project_master.address,project_master.projectImage,project_master.add_date as project_date,manage_company.name as companyName,project_master.company_id');
    $this->db->from('tbl_assign_jobs');
    $this->db->join('jobs_master','jobs_master.id=tbl_assign_jobs.job_id','inner');
    $this->db->join('project_master','project_master.id=jobs_master.projetc_id','inner');
    $this->db->join('manage_company','manage_company.id=project_master.company_id','inner');
    $this->db->where('jobs_master.status',1);
    $this->db->where('tbl_assign_jobs.job_seen_status',1);
    $this->db->where('tbl_assign_jobs.factory_id',$adminData['id']);
     if(!empty($lastDate)):
       $this->db->where('tbl_assign_jobs.add_date >',$lastDate);
     endif;
    $result = $this->db->get()->result_array();
    $response = array();
      if(!empty($result)){
           $response['status'] = 201;
           $html = '';
           
           $count = 1;
           foreach($result as $list){
           $html .= '<tr>
                    <td>'.$list['project_name'].'</td>
                    <td>'.$list['projetc_number'].'</td>
                    <td><a  target="_blank" href="'.base_url('factory-job-view/'.$list['job_id']).'">'.$list['job_name'].'</a></td>
                    <td><a href="'.base_url('uploads/pdf/'.$list['pdf_url']).'" target="_blank">View Job</a></td>
                    <td><span class="label label-'.($list['job_status'] == 1 ? 'warning' : ($list['job_status'] == 2 ? 'info' : 'success' )  ).' ">'.($list['job_status'] == 1 ? 'IN PROGRESS' : ($list['job_status'] == 2 ? 'READY' : 'PICKED' )  ).'</span></td>
                    <td><span  class="label label-success">'.($list['job_seen_status'] == 1 ? 'New' :'').'</span></td>
                    <td>'.date('d-m-Y',$list['add_date']).'</td>
                  </tr>';
                  if($count == 1){
                    $getLastTimeStamp = $list['add_date'];  
                  }
                  $count++;
           }
           $response['result']      = $html;
           $response['lastMessage'] = $getLastTimeStamp;
      }else{
          $response['status'] = 404;
      }
      $this->db->close();
      echo json_encode($response);exit;
 }
 public function getProjectAllNewJobListDashboard(){
    $this->db->reconnect();
    $lastDate = $this->input->post('lastMessageDate');
    $this->db->order_by('jobs_master.status_seen','desc');
    $this->db->order_by('jobs_master.add_date','desc');
    $this->db->limit(10);
    $this->db->select('jobs_master.*,project_master.id as project_id,project_master.project_name,project_master.projetc_number,project_master.address,project_master.projectImage,project_master.add_date as project_date,manage_company.name as companyName,project_master.company_id');
    $this->db->from('jobs_master');
    $this->db->join('project_master','project_master.id=jobs_master.projetc_id','inner');
    $this->db->join('manage_company','manage_company.id=project_master.company_id','inner');
    $this->db->where('jobs_master.status',1);
    $this->db->where('jobs_master.status_seen',1);
    $this->db->where('jobs_master.delivery_date is NOT NULL', NULL, FALSE);
     if(!empty($lastDate)):
       $this->db->where('jobs_master.modify_date >',$lastDate);
     endif;
    $result = $this->db->get()->result_array();
    $response = array();
      if(!empty($result)){
           $response['status'] = 201;
           $html = '';
           
           $count = 1;
           foreach($result as $list){
           $html .= '<tr>
                    <td><a  target="_blank" href="'.base_url('project-view/'.base64_encode($list['project_id'])).'">'.$list['project_name'].'</a></td>
                    <td>'.$list['projetc_number'].'</td>
                    <td><a  target="_blank" href="'.base_url('factory-assign-job/'.$list['id']).'">'.$list['job_name'].'</a></td>
                    <td><a href="'.base_url('uploads/pdf/'.$list['pdf_url']).'" target="_blank">View Job</a></td>
                    <td><span class="label label-'.($list['job_status'] == 1 ? 'warning' : ($list['job_status'] == 2 ? 'info' : ($list['job_status'] == 3 ? 'danger':'success') )  ).' ">'.($list['job_status'] == 1 ? 'IN PROGRESS' : ($list['job_status'] == 2 ? 'APPROVED' : ($list['job_status'] == 3 ? 'DISAPPROVE':'COMPLETED') )  ).'</span></td>
                    <td><span  class="label label-success">'.($list['status_seen'] == 1 ? 'New' :'').'</span></td>
                    <td>'.date('d-m-Y',$list['add_date']).'</td>
                  </tr>';
                  if($count == 1){
                    $getLastTimeStamp = $list['modify_date'];  
                  }
                  $count++;
           }
           $response['result']      = $html;
           $response['lastMessage'] = $getLastTimeStamp;
      }else{
          $response['status'] = 404;
      }
      $this->db->close();
      echo json_encode($response);exit;
 }
 public function getGalleryImage($projectId){
    $this->db->order_by('id','desc');
   return $this->db->get_where('project_gallery',array('project_id'=>$projectId))->result_array();
 }
 public function getTotalJobs($userId){
    $this->db->order_by('id','desc');
   return $this->db->get_where('jobs_master',array('user_id'=>$userId,'status'=>1))->result_array();
 }
}
?>
