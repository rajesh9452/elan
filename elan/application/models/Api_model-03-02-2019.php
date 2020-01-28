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
 # Response: We have response as a JSON formet.
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
 # Response: We have response as a JSON formet.
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
   # Response: We have response as a JSON formet.
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
   # Response: We have response as a JSON formet.
 */
  public function forgotuserpassword($request){
    isBlank($request['email'],NOT_EXISTS,110);
    $validateAccount = $this->db->get_where('user_master',array('email'=>$request['email'],'status !='=>3))->row_array();
    if(!empty($validateAccount)):
           if($validateAccount['status'] == 1):
             $getmessage = 'Your password is.'.base64_decode($validateAccount['password']);
            sendMail($validateAccount['name'],$getmessage);
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
   # Response: We have response as a JSON formet.
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
   # Response: We have response as a JSON formet.
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
   # Response: We have response as a JSON formet.
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
   # Response: We have response as a JSON formet.
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
}
?>