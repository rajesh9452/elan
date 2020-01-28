<?php
class Api_model extends CI_Model {
  public function __construct(){
    parent::__construct();
    
    $this->load->helper('api');
    $this->load->database();
    $this->status = 'status';
  }
   /*
 # Create date: 31-01-2019
 # Function: checkApiRequest()
 # Parameter: $accessToken,$accessId,$packageName,$deviceID
 # Description: This function has been check api request is valid or not if user has been provide valid access token and access ID the api has been work.
 # Response: We have response as a JSON format.
 */
   public function checkApiRequest($accessToken,$accessId,$packageName,$deviceID){
      $check = $this->db->get_where('login_master',array('status !='=>2,'id'=>base64_decode($accessId),'accessToken'=>$accessToken,'device_id'=>$deviceID))->row_array();
      if(!empty($check)){
           if($packageName ==  md5(PACKAGENAME)){
               return $check;
           }else{
            return 0;
           }
      }else{
        return 0;
      }
   }
 /*
 # Create date: 31-01-2019
 # Function: getAccessToken()
 # Parameter: deviceId
 # Description: this api use for getting the all api access token if user has been access token then he will do something else other api otherwise api return false.
 # Response: We have response as a JSON format.
 */
  public function getAccessToken($request){
       isBlank($request['deviceId'],NOT_EXISTS,133);
       $token = openssl_random_pseudo_bytes(150); 
       $token = bin2hex($token);//Convert the binary data into hexadecimal representation.
       $insertData = array();
       $getTimes   = time();
       $insertData['device_id']    = $request['deviceId'];
       $insertData['accessToken']  = $token;
       $insertData['add_date']     = $getTimes;
       $insertData['status']       = 3;
       $this->db->insert('login_master',$insertData);
       $insert = $this->db->insert_id();
        $response['tokenAccess']    = $token;
        $response['accessId']       = base64_encode($insert);
        generateServerResponse(S,SUCCESS,$response);
  }
   /*
   # Create date: 31-01-2019
   # Function: accountLogin()
   # Parameter: deviceId,accessId,email,password
   # Description: If user want to login account then he will provide a valid details for checking the request api url and user account details if user has been all details send right then api has been provide a all users information.
   # Response: We have response as a JSON format.
 */
  public function accountLogin($request,$apiRequest){
      isBlank($request['email'],NOT_EXISTS,110);
      isBlank($request['password'],NOT_EXISTS,107);
      isBlank($request['fcm_id'],NOT_EXISTS,111);
      $validateAccount = $this->db->get_where('user_master',array('email'=>$request['email'],'status !='=>3))->row_array();
        # If email id valid then 
      if(!empty($validateAccount)):
           if($validateAccount['status'] == 1):
               if($validateAccount['password'] == base64_encode($request['password'])):
                # IF user password has been worng then use send message
                  $this->updateLoginDetails($apiRequest,$request['fcm_id'],$validateAccount['id']);
                  $response['userId']  = $validateAccount['id'];
                  $response['loginId'] = $apiRequest['id'];
                  $response['name']   = $validateAccount['name'];
                  $response['email'] = $validateAccount['email'];
                  $response['mobileNumber'] = $validateAccount['mobileNumber'];
                  generateServerResponse(S,SUCCESS,$response);
               else:
                generateServerResponse(F,128);
               endif;
             # If user account has been deactivate then send message
           else:
             generateServerResponse(F,108);
           endif;
        # If user enter email id not valide then user send message
      else:
        generateServerResponse(F,105);
      endif;
   }
  public function updateLoginDetails($apiRequest,$fcm_id,$userId){
       $this->db->where('id',$apiRequest['id']);
       $this->db->update('login_master',array('user_id'=>$userId,'status'=>1,'fcm_id'=>$fcm_id,'add_date'=>time()));
       return $this->db->affected_rows();
   }
  /*
   # Create date: 31-01-2019
   # Function: forgotuserpassword()
   # Parameter: email
   # Description:  If email id is valid then send password user registered email id.
   # Response: We have response as a JSON format.
 */
  public function forgotuserpassword($request){
    isBlank($request['email'],NOT_EXISTS,110);
    $validateAccount = $this->db->get_where('user_master',array('email'=>$request['email'],'status !='=>3))->row_array();
    if(!empty($validateAccount)):
           if($validateAccount['status'] == 1):
             $getmessage = 'Your password is.'.base64_decode($validateAccount['password']);
             //send mail
        // $to = $email;
        // $subject = 'Welcome to Zetwerk';
        // $message ="Welcome to Zetwerk\r\n";
        // $message.="\r\n";
        // $message.=" ".$getmessage."\r\n";
        // $message .="Note - This is a System Generated Mail, please do not reply.\r\n";
        // $headers = "From:"."noreply@zetwerk.com"."\r\n";
        // $headers .= "MIME-Version: 1.0\r\n";
        // $headers .= "Content-type: text/html; charset=utf-8\r\n";
       // $this->load->library('email'); 
             
            sendMail($request['email'],$getmessage);
            generateServerResponse(S,162);
             # If user account has been deactivate then send message
           else:
             generateServerResponse(F,108);
           endif;
        # If user enter email id not valide then user send message
      else:
        generateServerResponse(F,105);
      endif;
  }
    /*
   # Create date: 31-01-2019
   # Function: sendFeedback()
   # Parameter: userId,subject,message
   # Description: 
   # Response: We have response as a JSON format.
 */
    public function sendFeedback($request){
        isBlank($request['userId'],NOT_EXISTS,125);
        isBlank($request['subject'],NOT_EXISTS,112);
        isBlank($request['message'],NOT_EXISTS,113);
         $feedback = array();
         $feedback['user_id'] = $request['userId'];
         $feedback['subject'] = $request['subject'];
         $feedback['message'] = $request['message'];
         $feedback['add_date'] = time();
         $this->db->insert('customer_support',$feedback);
         generateServerResponse(S,152);
    }
 /*
   # Create date: 31-01-2019
   # Function: changeUsersPassword()
   # Parameter: email
   # Description: 
   # Response: We have response as a JSON format.
 */
  public function changeUsersPassword($request){
     isBlank($request['userId'],NOT_EXISTS,125);
     $checkUser = $this->db->get_where('user_master',array('id'=>$request['userId']))->row_array();
     if($checkUser['password'] == base64_encode($request['oldpassword'])):
          $this->db->where('id',$checkUser['id']);
          $this->db->update('user_master',array('password'=>base64_encode($request['newPassword'])));
          generateServerResponse(S,158);
     else:
      generateServerResponse(F,142);
     endif;
  }
  /*
   # Create date: 31-01-2019
   # Function: logoutUsers()
   # Parameter: loginId
   # Description: 
   # Response: We have response as a JSON format.
 */
  public function logoutUsers($request){
         isBlank($request['loginId'],NOT_EXISTS,131);
         $this->db->where('id',$request['loginId']);
         $this->db->update('login_master',array('status'=>2,'logout'=>time()));
         $check = $this->db->affected_rows();
         if($check > 0):
          generateServerResponse(S,201);
         else:
          generateServerResponse(F,130);
         endif;
  }
   /*
   # Create date: 31-01-2019
   # Function: updateprofiles()
   # Parameter: loginId
   # Description: 
   # Response: We have response as a JSON format.
 */
   public function updateprofiles($request){
       isBlank($request['userId'],NOT_EXISTS,125);
      $checkUser = $this->db->get_where('user_master',array('id !='=>$request['userId'],'mobileNumber'=>$request['mobile']))->row_array();
      if(empty($checkUser)):
           $this->db->where('id',$request['userId']);
           $this->db->update('user_master',array('name'=>$request['name'],'mobileNumber'=>$request['mobile']));
           generateServerResponse(S,156);
      else:
        generateServerResponse(F,135);
      endif;
   }
     /*
   # Create date: 31-01-2019
   # Function: ProjectAssignList()
   # Parameter: loginId
   # Description: 
   # Response: We have response as a JSON formet.
 */
   public function ProjectAssignList($request){
       isBlank($request['userId'],NOT_EXISTS,125);
       $offset = (!empty($request['offset']) ? 0 : $request['offset']);
       $limit = 10;
       $sql ='SELECT uap.id AS assign_id,pm.project_name,pm.projetc_number,pm.id AS project_id, pm.company_id, mc.name, uap.add_date FROM `user_assign_project` AS uap INNER JOIN project_master AS pm ON pm.id = uap.project_id INNER JOIN user_master AS um ON um.id = uap.user_id inner join manage_company as mc on mc.id=pm.company_id WHERE um.id='.$request['userId'].' AND pm.status = 1 ORDER BY uap.id DESC  LIMIT '.$offset.','.$limit;
       $getData = $this->db->query($sql)->result_array();
       $response['data'] = $getData;
       $response['offset'] = count($getData) + $request['offset'];
       if(!empty($getData) > 0){
        generateServerResponse(S,SUCCESS,$response);
       }else{
        generateServerResponse(F,'E');
       }

   }
    /*
   # Create date: 04-02-2019
   # Function: getJobsList()
   # Parameter: project_id
   # Description: 
   # Response: We have response as a JSON format.
 */
  public function getDeletedJobsList(){
     $this->db->order_by('id','asc');
     $deleteRecords = $this->db->get_where('jobs_master',array('status'=>3))->result_array();
     if(!empty($deleteRecords)):
         foreach($deleteRecords as $list){
            $check = $this->db->get_where('jobs_master',array('status !='=>3,'job_name'=>$list['job_name']))->row_array();
            if(empty($check)){
              return $list['job_name'];
              break;
            }
         }
     else:
     return $this->getActiveJobsList();
     endif;
  }
  public function getActiveJobsList(){
     $this->db->order_by('id','desc');
     $active = $this->db->get_where('jobs_master',array('status !='=>3))->row_array();
     if(!empty($active)){
        $str = ltrim($active['job_name'], 'A');
        $name = (int) $str + 1;
        return 'A'.$name;
     }else{
       return 'A1';
     }
  }
  public function getJobsList($request){
       isBlank($request['type'],NOT_EXISTS,513);
       if($request['type'] == 1){
        isBlank($request['project_id'],NOT_EXISTS,513);
        isBlank($request['user_id'],NOT_EXISTS,125);
            $addJob = array();
            $getJobName = $this->getDeletedJobsList();
         // $addJob['job_name']   = '';
          if(!empty($getJobName)):
            $addJob['job_name']  = $getJobName;
          endif;
          $addJob['projetc_id']  = $request['project_id'];
          $addJob['user_id']     = $request['user_id'];
          $addJob['add_date']    = time();
          $addJob['modify_date'] = time();
          $addJob['status']      = 1;
          $this->db->insert('jobs_master',$addJob);
          $insert_id = $this->db->insert_id();
          // if(empty($getJobName)):
          //    $this->db->where('id',$insert_id);
          //    $this->db->update('jobs_master',array('job_name'=>'A'.$insert_id));
          // endif;
          generateServerResponse(S,515);
       }else if($request['type'] == 2){
          isBlank($request['job_id'],NOT_EXISTS,516);
          $addJob = array();
          // $addJob['job_name']    = $request['job_name'];
          $addJob['modify_date'] = time();
          $this->db->where('id',$request['job_id']);
          $this->db->update('jobs_master',$addJob);
          generateServerResponse(S,518);
       }else if($request['type'] == 3){
          isBlank($request['job_id'],NOT_EXISTS,516);
           $this->db->where('id',$request['job_id']);
           $this->db->update('jobs_master',array('status'=>3));
           generateServerResponse(S,519);
       }
       else if($request['type'] == 4){
          isBlank($request['project_id'],NOT_EXISTS,513);
          $offset = (empty($request['offset']) ? 0 : $request['offset']);
          $limit = 10;
         $sql ='SELECT project_master.id as project_id,project_master.project_name,project_master.projetc_number,jobs_master.id AS job_id,jobs_master.job_name,jobs_master.delivery_date,jobs_master.add_date FROM `project_master` INNER JOIN jobs_master ON jobs_master.projetc_id = project_master.id WHERE project_master.status = 1 AND jobs_master.status = 1 AND jobs_master.projetc_id = '.$request['project_id'].' AND jobs_master.user_id = '.$request['user_id'].'  AND jobs_master.delivery_date IS NULL ORDER BY jobs_master.id DESC LIMIT '.$offset.','.$limit;
           $getData = $this->db->query($sql)->result_array();
           $response['data'] = $getData;
           $response['offset'] = count($getData) + $request['offset'];
           if(!empty($getData) > 0){
             generateServerResponse(S,SUCCESS,$response);
            }else{
             generateServerResponse(F,'E');
            }
       }
   }
   /*
   # Create date: 04-02-2019
   # Function: jobUserList()
   # Parameter: user_id
   # Description: 
   # Response: We have response as a JSON format.
 */
  public function jobUserList($request){
     isBlank($request['user_id'],NOT_EXISTS,125);
     $offset = (empty($request['offset']) ? 0 : $request['offset']);
      $limit = 10;
       $this->db->order_by('id','desc');
       $this->db->limit($limit, $offset);
       $this->db->where('delivery_date is NOT NULL', NULL, FALSE);
       $sql ='SELECT project_master.id as project_id,project_master.project_name,project_master.projetc_number,jobs_master.id AS job_id,jobs_master.job_name,
       jobs_master.pdf_url,jobs_master.delivery_date,jobs_master.add_date FROM `project_master` INNER JOIN jobs_master ON jobs_master.projetc_id = project_master.id 
       WHERE project_master.status = 1 AND jobs_master.status = 1 
       AND jobs_master.user_id = '.$request['user_id'].'  AND jobs_master.delivery_date IS NOT NULL ORDER BY jobs_master.id DESC LIMIT '.$offset.','.$limit;
       $getData = $this->db->query($sql)->result_array();
       //$getData = $this->db->get_where('jobs_master',array('status'=>1,'user_id'=>$request['user_id']))->result_array();
      // echo $this->db->last_query();exit;
       $response['data'] = $getData;
       $response['offset'] = count($getData) + $request['offset'];
        $response['url'] = base_url('uploads/pdf/'); 
       if(!empty($getData) > 0){
         generateServerResponse(S,SUCCESS,$response);
        }else{
         generateServerResponse(F,'E');
      }
  }
  /*
   # Create date: 04-02-2019
   # Function: sendjobs()
   # Parameter: job_id,Pdf_link,delivery sendjobs
   # Description: 
   # Response: We have response as a JSON format.
 */
  public function sendjobs($request){
      isBlank($request['job_id'],NOT_EXISTS,516);
       $checkData = $this->db->get_where('job_pdf_send',array('job_id'=>$request['job_id'],'uuid'=>$request['user_id']))->result_array();
       // echo $this->db->last_query();exit;
      // print_r($checkData);exit;
       $sql ='SELECT jobs_master.id,jobs_master.job_name,jobs_master.delivery_date,project_master.project_name,project_master.projetc_number,manage_company.name as company,manage_company.email as companyEmail,user_master.name AS userName FROM `jobs_master` INNER JOIN project_master ON project_master.id = jobs_master.projetc_id INNER JOIN manage_company ON manage_company.id = project_master.company_id INNER JOIN user_master ON user_master.id = jobs_master.user_id WHERE jobs_master.id ='.$request['job_id'];
      $jobDetails  = $this->db->query($sql)->row_array();
      $mpdf =  new mPDF('utf-8','A4-P');
      $html = '';
     $html = '<div style="width:100%; height:auto;margin:0 auto;">
     <div style="width:50%;float:left;">
      <div style="width:350px;float: left; border: 1px solid; height:200px;">
    <div style="width:250px; margin:0 auto;">
      <img src="'.base_url().'/uploads/047b9fc6-1d8e-46d7-8833-6f70fb004cf1.jpg" width="250px;">
    </div>
    <table style="margin-top:18px;">
     <tr>
     <td>
      <div style="width:350px;">
        <h6 style="margin: 0px;padding-bottom: 10px;font-size:13px;padding-left: 15px;">Aaltenseweg 54 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Postbus 36</h6>
        <h6 style="margin: 0px;padding-bottom: 10px;font-size: 13px;padding-left: 15px;">7051 CM Varsseveld &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7050AA Varsseveid</h6>
        <h6 style="margin: 0px;padding-bottom: 10px;font-size: 13px;padding-left: 15px;">Tel: 0031-(0)315-242560</h6>
        <h6 style="margin: 0px;padding-bottom: 10px;font-size: 13px;padding-left: 15px;">Fax: 0031-(0)315-241514</h6>
          </div>
         </td>
       </tr>
    </table>
      </div>
  </div>
  <div style="width:50%;float:left;">
    <div style="width:350px;float: left; border: 1px solid black; height:200px;">
      <h3 style="text-align: center;font-size:17px;margin-bottom:15px;margin-top:16px;">ZETWERKBESTELFORMULIER</h3>
      <p style="border-bottom: 1px solid;border-top: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Bonnummer:</span> '.(!empty($jobDetails['job_name']) ? $jobDetails['job_name'] : '').'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Bedrijf:</span> '.(!empty($jobDetails['company']) ? $jobDetails['company'] : '').'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Project:</span> '.(!empty($jobDetails['project_name']) ? $jobDetails['project_name'] : '').'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Projectnr:</span> '.(!empty($jobDetails['projetc_number']) ? $jobDetails['projetc_number'] : '').'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Datum:</span> '.date('d-m-Y',time()).'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 4px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">Gereed:</span> '.$request['delivery_date'].'</p>
      <p style="border-bottom: 1px solid;margin: 0px;padding-bottom:4px;padding-top: 3px;padding-left: 6px;font-size: 13px;"><span style="font-weight: bold;">BesteId door:</span> '.(!empty($jobDetails['userName']) ? $jobDetails['userName'] : '').'</p>
    </div>
  </div> ';
  // New tab Add
      $html .= '<div style="width: 50%;float: left;">
      <div style="width:350px;float: left; border: 1px solid black; height:25px;">
      &nbsp;Omschrijving</div></div>';
      $html .= '<div style="width: 50%;float: left;">
      <div style="width:350px;float: left; border: 1px solid black;  height:25px;">
      <div style="width:100%;">
      <div style="width:44.98%;float: left;">&nbsp;Prijs €</div>
      <div style="width:50%;border-left: 1px solid;float: left;">&nbsp;s.d. nr:</div>
      </div></div></div>';
    if(!empty($checkData)){
        $count = 1;
        foreach($checkData as $list){
         $html .= '<div style="width: 50%;float: left;">
               <div style="width:350px;float: left; border: 1px solid; height:120px;">
                <div style="border:1px solid black; height:30px; width:30px;position: absolute; text-align:center;">'.$count.'</div>
               <center>';
               if(!empty($list['in_data'])):
                $html .= '<div style="padding-left:290px;position: absolute;">
                 <img src="'.base_url().'/uploads/outside.png"   width="20px" height="20px">
                 </div>';
               else:
               $html .= '<div style="padding-left:290px;position: absolute;" width="20px" height="20px">
                 </div>';
                endif;
              $html .= '<div style="margin:0 auto;width:200px;height:180px;"><img src="'.base_url().'/uploads/pdf/'.$list['images'].'" width="200px" height="180px"></div></center>';
             if(!empty($list['uit'])):
              $html .= '<div style="margin-bottom:10px;padding-left:10px;">
                 <img src="'.base_url().'/uploads/inside.png"  style="margin-top:-10px;position: absolute;"  width="20px" height="20px">
                 </div>';
              else:
               $html .= '<div style="padding-left:290px;position: absolute;" width="20px" height="20px">
                 </div>';
                endif;
               $html .= '<div style="width: 100%;border: 1px;">
               <div style="width:49.5%;border: 1px solid;float: left;">&nbsp;&nbsp;Mat: '.$list['mat'].'</div>
               <div style="width:49.3%;border: 1px solid;float: left;">&nbsp;&nbsp;Afw: '.$list['afw'].'</div>

               <div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;Dikte: '.$list['dikte'].'</div>
               <div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;'.$list['side'].'</div>
               <div style="width:33.2%;border: 1px solid;float: left;">&nbsp;&nbsp;Ral: '.$list['ral'].'</div> 

               <div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;ST: '.$list['st'].'</div>
               <div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;L: '.$list['length'].'</div>

               <div style="width:33.2%;border: 1px solid;float: left;">&nbsp;&nbsp;KL: '.$list['kl'].'</div>
               <!--<div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;IN: '.$list['in_data'].'</div>
               <div style="width:32.5%;border: 1px solid;float: left;">&nbsp;&nbsp;UIT: '.$list['uit'].'</div>
              <div style="width:33.2%;border: 1px solid;float: left;">&nbsp;&nbsp;KANT: '.$list['kant'].'</div>-->
              <div style="width:100%;border: 1px solid; height:50px; overflow: hidden;text-overflow: clip;"><p style="margin:0px;padding:3px;">'.$list['remark'].'</p></div>
            </div>
          </div>
          </div>';
          $count++;
        }
    }
        $html .= '</div>';
        $PDFContent = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $mpdf->WriteHTML($PDFContent);
        $pdfName = (!empty($jobDetails['job_name']) ? str_replace(" ","_",$jobDetails['job_name']) : '').'.pdf'; 
        $pdfFilePath =  IMAGE_DIRECTORY.'pdf/'.$pdfName; 
        $mpdf->Output($pdfFilePath, "F");
          echo '$html';exit;
        $this->db->where('id',$request['job_id']);
        $this->db->update('jobs_master',array('pdf_url'=>$pdfName,'delivery_date'=>$request['delivery_date']));
        // Delete All data from the tables and folders
        if(!empty($checkData)){
        foreach($checkData as $list){ 
              $Path = IMAGE_DIRECTORY.'pdf/'.$list['images'];
                 if (file_exists($Path)){
                     unlink($Path);
                 }
                  $this->db->where('id',$list['id']);
                  $this->db->delete('job_pdf_send');
            }
            if(!empty($jobDetails['companyEmail'])):
                 $getmessage = 'New job has been posted. Please find the PDF <a href="'.base_url('/uploads/pdf/'.$pdfName).'">Click Here</a>\r\n';
                 $subject = 'Project number:'.$jobDetails['projetc_number'].' Project Name:'.$jobDetails['project_name'].' Job Number:'.$jobDetails['job_name'];
                 sendJobMail($jobDetails['companyEmail'],$getmessage,$subject);
             endif;
         }
         
        generateServerResponse(S,518);
  }
  
    public function sendPdfData($request){
      $arrayPdf = array();
      $checkData = $this->db->get_where('job_pdf_send',array('job_id'=>$request['job_id'],'pdf_id'=>$request['pdf_id'],'uuid'=>$request['user_id']))->row_array();
      $arrayPdf['job_id'] = $request['job_id'];
      $arrayPdf['pdf_id'] = $request['pdf_id'];
      $arrayPdf['jsonData'] = json_encode($request['jsonData']);
      $arrayPdf['uuid'] = $request['user_id'];
      $arrayPdf['add_date'] = time();
      $arrayPdf['pos'] = $request['pos'];
      $arrayPdf['dikte'] = $request['dikte'];
      $arrayPdf['bin'] = $request['bin'];
      $arrayPdf['mat'] = $request['mat'];
      $arrayPdf['afw'] = $request['afw'];
      $arrayPdf['st'] = $request['st'];
      $arrayPdf['length'] = $request['length'];
      $arrayPdf['kl'] = $request['kl'];
    //   New tag
    $arrayPdf['in_data'] = $request['in_data'];
    $arrayPdf['uit'] = $request['uit'];
    $arrayPdf['kant'] = $request['kant'];
    $arrayPdf['side'] = $request['side'];
    $arrayPdf['ral'] = $request['ral'];
    $arrayPdf['remark'] = $request['remark'];
      $arrayPdf['images'] = saveProfilesImage($request['images']);
      if(empty($checkData)):
          $this->db->insert('job_pdf_send', $arrayPdf);
         else:
             $Path = IMAGE_DIRECTORY.'pdf/'.$checkData['images'];
             if (file_exists($Path)){
                 unlink($Path);
             }
             $this->db->where('id',$checkData['id']);
             $this->db->update('job_pdf_send',$arrayPdf);
        endif;
         generateServerResponse(S,SUCCESS);
  }
  public function sendPdfDelete($request){
       $this->db->where('id',$request['pdf_id']);
       $this->db->delete('job_pdf_send');
       generateServerResponse(S,SUCCESS);
  }
}
?>