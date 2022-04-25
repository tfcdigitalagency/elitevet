<div class="container">
	<div class="card">
		<div class="card-body">
			<?php
				if($_GET['uid'] && $_GET['eid'] && $_GET['salt']){
					$uid = $_GET['uid'];
					$eid = $_GET['eid'];
					$salt = $_GET['salt'];

					// Check SALT
					$salt_original = md5($uid.$eid."elite2021@salt");

					if($salt_original != $salt){
						echo "ERROR! Your link is invalid";
					}else{
						// Check exist user
						$this->Webinar_model->setTable("tbl_user");
						$theUser = $this->Webinar_model->find(array("id"=>$uid), array(), array(), true);						
						if(count($theUser) == 0){
							echo "ERROR! Your link is invalid";
						}else{
							$this->Webinar_model->setTable("tbl_register_webinar");
							$register = $this->Webinar_model->find(array("user_id"=>$uid, "event_id"=>$eid), array(), array(), true);
							if(count($register) > 0){
								echo "You have already registered for this webinar!";
							}else{
								$this->Webinar_model->insert(array("event_id"=>$eid, "user_id"=>$uid));
								echo "You have successfully registered for this webinar!";
							}
						}
					}
				}else{
					echo "ERROR! Your link is invalid";
				}
			?>
		</div>
	</div>
</div>
