<?php
// 
// 
// 
// NOTE - 6th April 2017
// 
// Any of the changes in this page need to UPDATE on 'DEV' server 'LYSOFT' folder.
// 
// 
// 
// 


if(isset($_REQUEST['to'])){
    $to = $_REQUEST['to'];
    $subject = $_REQUEST['subject'];
    $content = $_REQUEST['content'];
    $mail_from_email = $_REQUEST['mail_from_email'];
    $mail_from_name = $_REQUEST['mail_from_name'];
    try{
        if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
            define('SMTP_EMAIL_USER_NAME', $_REQUEST['mail_from_email']); # smtp service username
            define('SMTP_EMAIL_USER_PASSWORD', $_REQUEST['password']); # smtp service password
            _mail($to, $subject, $content, array(),$mail_from_email,$mail_from_name,$_REQUEST['mail_from_email'],$_REQUEST['password'],$_REQUEST['bcc']);
        }else{
            _mail($to, $subject, $content, array(),$mail_from_email,$mail_from_name,SMTP_EMAIL_USER_NAME,SMTP_EMAIL_USER_PASSWORD,$_REQUEST['bcc']);
        }
        echo  json_encode(array("success"=>"1","message"=>"Mail sent successfully!"));
    }  catch (Exception $e){
        qi("activity_log",array("payload"=>"Error 45:".$e->getMessage(),"log"=>SMTP_EMAIL_USER_NAME.":".SMTP_EMAIL_USER_PASSWORD));        
        echo  json_encode(array("success"=>"0","message"=>$e->getMessage()));        
    }
}
die;
?>