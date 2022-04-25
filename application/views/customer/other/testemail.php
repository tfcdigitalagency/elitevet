<?php
require 'system/PHPMailer.php';


	date_default_timezone_set('America/Vancouver');

  $mailto = $_GET['mailto'];

	$datax = $this->Settings_model->find(array("skey"=>'createemail'), array(), array(), true);
  $html = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'createsubject'), array(), array(), true);
  $subject = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'smtp_secure'), array(), array(), true);
  $smtp_secure = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'smtp_port'), array(), array(), true);
  $smtp_port  = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'smtp_host'), array(), array(), true);
  $smtp_host  = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'smtp_username'), array(), array(), true);
  $smtp_username  = $datax[0]['svalue'];

  $datax = $this->Settings_model->find(array("skey"=>'smtp_password'), array(), array(), true);
  $smtp_password  = $datax[0]['svalue'];

  $email_body = $html;
                    
  $email_body .= '<br><br><p>Click here to register: <a href="#" target="_blank">???</a></p>';


    $mail = new PHPMailer;

    $mail->SMTPDebug = 2;
    $mail->IsSMTP();
    $mail->Host = 'localhost';
    $mail->SMTPAuth = false;

    $mail->From = 'support@ncdeliteveterans.org';
    $mail->FromName = 'Jones';
    $mail->AddAddress($mailto);

    $mail->Subject = $subject;
    //$mail->Body = $email_body;
    
    $mail->MsgHTML($email_body);
    
    $mail->IsHTML(true);

    $mailresult = $mail->Send();
    $mailconversation = nl2br(htmlspecialchars(ob_get_clean())); //captures the output of PHPMailer and htmlizes it
    if ( !$mailresult ) {
        echo 'FAIL: ' . $mail->ErrorInfo . '<br />' . $mailconversation;
    } else {
        echo $mailconversation;
    }
        
//   $mail = new PHPMailer();
//   $mail->IsSMTP();

//   $mail->SMTPDebug  = 2;  
//   $mail->SMTPAuth   = false;
//   $mail->Port       = 25;
//   $mail->Host       = 'localhost';
//   $mail->Username   = $smtp_username;
//   $mail->Password   = $smtp_password;
//   $mail->From = $smtp_username;

//   $mail->IsHTML(true);
//   $mail->AddAddress($mailto, "");
//   $mail->SetFrom($smtp_username, "");
//   $mail->AddReplyTo($smtp_username, "");
//   $mail->Subject = $subject;
//   $content = $email_body;

//   $mail->MsgHTML($content);

//   try {
//     $mail->send();
//     echo "Message has been sent successfully";
//   } catch (Exception $e) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
//   }
?>