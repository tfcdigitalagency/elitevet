<?php

	$user = $this->session->userdata('user');

	$this->Webinar_model->setTable('tbl_broadcast');
	//$this->Webinar_model->update(array("name"=>"api_key"), array("value"=>''));
	//$this->Webinar_model->update(array("name"=>"api_secret"), array("value"=>''));
	$this->Webinar_model->update(array("name"=>"meeting_number"), array("value"=>''));
	$this->Webinar_model->update(array("name"=>"meeting_passcode"), array("value"=>''));

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<!-- Meta tag for responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Meta when no responsive:
	<meta name="viewport" content="width=1000"> -->
	
	<title></title>
</head>
<body>
	
	<div class="information">
		<h1>Webinar is ended!</h1>
	</div>

	<style>
		.information{
			position: fixed;
			width:  100%;
			height:  100%;
			top:  0;
			left:  0;
			display:  flex;
			justify-content: center;
			align-items:  center;
		}
	</style>
	
</body>
</html>