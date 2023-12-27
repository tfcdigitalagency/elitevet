<?php
	date_default_timezone_set('America/Vancouver');
	require 'system/PHPMailer.php';

	$events = $this->Webinar_model->find(array("status"=>"upcoming", "reminded" => 0), array(), array(), true);
	$now = new DateTime();
	$response = array();

	$data = $this->Settings_model->find(array("skey"=>'remindemail'), array(), array(), true);
	$html = $data[0]['svalue'];

	$data = $this->Settings_model->find(array("skey"=>'remindsubject'), array(), array(), true);
	$subject = $data[0]['svalue'];


	foreach($events as $event){
		$start_time = DateTime::createFromFormat('Y-m-d H:i:s', $event['start_time']);
		//echo $now->format("d/m/Y")." - ".$start_time->format("d/m/Y")."<br/>";

		$interval = $now->diff($start_time);
		$datediff = $interval->format('%a');
		//echo $datediff;

		// Action
		if($datediff > 0 && $datediff < 2){

			$res = array(
				'event_name' => $event['name'],
				'start_time' => $event['start_time'],
				'remind_to' => $event['remind_to'],
				'members' => array(),
				'admins' => array()
			);

			/***************** FOR MEMBERSHIP ****************/

			// Get all register users
			$regs = $this->Reg_history_model->find(array("event_id" => $event['id']), array(), array(), true);

			// If exist users register of event
			if(count($regs) > 0){
				// Prepare user ids
				$ids = array();
				foreach($regs as $reg){
					$ids[] = $reg['user_id'];
				}
				$ids = implode(",",$ids);

				// Get users information
				$users = $this->User_model->find(array("id in (".$ids.")"=> null), array(), array(), true);
				foreach($users as $user){
					// Send mail
					try{
						// $headers = "MIME-Version: 1.0" . "\r\n";
						// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						// $from = 'joneslj2@gmail.com';

						// $message = $html;
						// $headers .= "From:". $from;

						// mail($user['email'],$subject,$message, $headers);

						$mail = new PHPMailer();
                    
                        $mail->IsSMTP();
                        $mail->Host = 'localhost';
                        $mail->SMTPAuth = false;
                        $mail->From = 'support@ncdeliteveterans.org';
                        $mail->FromName = 'Elite Nor-Cal';
                        
                        $mail->AddAddress($user['email']);
    
                        $mail->IsHTML(true);
                        $mail->Subject = $subject;
                        $content = $html;
                        $mail->MsgHTML($content); 

						if($mail->Send()){

							$res['members'][] = $user['email'];
						}
					}catch (Exception $e) {}
				}
			}

			/***************** FOR ADMIN ****************/
			// Get all admin users
			$admins = $this->User_model->find(array("is_admin" => 1), array(), array(), true);
			foreach($admins as $user){
				// Send mail
				try{
					
					$mail = new PHPMailer();
                    
                    $mail->IsSMTP();
                    $mail->Host = 'localhost';
                    $mail->SMTPAuth = false;
                    $mail->From = 'support@ncdeliteveterans.org';
                    $mail->FromName = 'Elite Nor-Cal';
                    
                    $mail->AddAddress($user['email']);

                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $content = $html;
                    $mail->MsgHTML($content); 

					if($mail->Send()){

						$res['admins'][] = $user['email'];
					}
				}catch (Exception $e) {}
			}

			$this->Webinar_model->update(array("id"=>$event['id']), array("reminded" => 1), array(), true);
			$response[] = $res;
		}
	}
	echo json_encode($response);
?>