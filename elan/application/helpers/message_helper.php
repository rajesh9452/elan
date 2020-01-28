<?php
function getAlertMessage($code){
    $codes = Array(
                '1' => 'Invalid Username/Email or Password.',
                '2' => 'A password reset link is sent to your email address.',
                '3' => 'This email address is not registered.',
                '4' => 'Please enter a valid email address.',
                '5' => 'Please fill up all fields.',
                '6' => 'Password doesn\'t match.',
                '7' => 'Password is same as previous one.',
                //Image Upload Alerts
                '10' => 'Account has been logout successfully.',
                '11' => 'Record has been add successfully.',
                '13' => 'Record has been update successfully.',
                '14' => 'Record has been deactive successfully.',
                '15' => 'Record has been active successfully.',
                '16' => 'Record has been delete successfully.',
                '17' => 'Question has been add successfully.',
                '18' => 'Question has been update successfully.',
                '19' => 'New chapter has been create successfully.',
                '20' => 'Chapter has been published successfully.',
                '21' => 'Chapter has been Update successfully.',
                '22' => 'Product has been add successfully.',
                '23' => 'Product has been update successfully.',
                '24' => 'Message has been send successfully.',
                '25' => 'User has been remove from this project.',
                '26' => 'Job has been assign in factory',
                '12' => '!Oops something went wrong.',
                '13' => 'Product gallery image has been Upload successfully.'

            );

    return (isset($codes[$code])) ? $codes[$code] : '';
}
function getAlertBody($class, $message){
    $alert  =   '<div class="alert alert-'.$class.'">
                    '.$message.'
                </div>';

    return $alert;
}
function generateAdminAlert($type, $messageCode){
    if($type == 'S'){
        $flash_msg = getAlertBody("success", getAlertMessage($messageCode));
    }elseif($type == 'I'){
        $flash_msg = getAlertBody("info", getAlertMessage($messageCode));
    }elseif($type == 'W'){
        $flash_msg = getAlertBody("warning", getAlertMessage($messageCode));
    }elseif($type == 'D'){
        $flash_msg = getAlertBody("danger", getAlertMessage($messageCode));
    }

    return $flash_msg;
}
function getCustomAlert($type, $message){
    if($type == 'S'){
        $flash_msg = getAlertBody("success", $message);
    }elseif($type == 'I'){
        $flash_msg = getAlertBody("info", $message);
    }elseif($type == 'W'){
        $flash_msg = getAlertBody("warning", $message);
    }elseif($type == 'D'){
        $flash_msg = getAlertBody("danger", $message);
    }

    return $flash_msg;
}

/* login/session methods */
// Check login status if already login redirect it to dashboard
function is_logged_in() {
    $obj =& get_instance();
    $adminData = $obj->session->userdata('adminData');
    if (!empty($adminData)) {
        redirect('admin-dashboard');
    }
}
// Check login status if not login redirect it to login page
function is_not_logged_in() {
    $obj =& get_instance();
    $adminData = $obj->session->userdata('adminData');
    if (empty($adminData)) {
      redirect('admin-login');
    }
}
function is_not_logged_in_factory() {
    $obj =& get_instance();
    $adminData = $obj->session->userdata('factoryData');
    if (empty($adminData)) {
      redirect('admin-login');
    }
}
function sendMail($email,$getmessage){
        $to = $email;
        $subject = 'Welcome to Zetwerk';
        $message ="Welcome to Zetwerk<br>";
        $message.="<br><br>";
        $message.=" ".$getmessage."\r\n";
        $message .="<br><br><br><br>Note - This is a System Generated Mail, please do not reply.";
        $headers = "From:"."noreply@zetwerk.com"."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        mail($to,$subject,''.$message.'',$headers);
        return 1;
 }
 function sendJobMail($email,$getmessage,$subject){
        $to = $email;
        $subject = $subject;
        $message ="Welcome to Zetwerk\r\n";
        $message.="<br><br>";
        $message.=" ".$getmessage."\r\n\r\n\r\n";
        $message.="<br><br><br><br>";
        $message .="Note - This is a System Generated Mail, please do not reply.\r\n";
        $headers = "From:"."noreply@zetwerk.com"."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        mail($to,$subject,''.$message.'',$headers);
        return 1;
 }