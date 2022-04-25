<?php
	$user = $this->session->userdata('user');
	if($user == null){
		echo '<h2>You need to login to access this page!</h2>';
		die();
	}
	function generate_signature ( $api_key, $api_secret, $meeting_number, $role){

	  //Set the timezone to UTC
	  date_default_timezone_set("UTC");

		$time = time() * 1000 - 30000;//time in milliseconds (or close enough)
		
		$data = base64_encode($api_key . $meeting_number . $time . $role);
		
		$hash = hash_hmac('sha256', $data, $api_secret, true);
		
		$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
		
		//return signature, url safe base64 encoded
		return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
	}
	$islive = false;
	$this->Webinar_model->setTable('tbl_broadcast');
	$api_key = $this->Webinar_model->find(array("name"=>"api_key"), array(), array(), true)[0]['value'];
	$api_secret = $this->Webinar_model->find(array("name"=>"api_secret"), array(), array(), true)[0]['value'];
	$meeting_number = $this->Webinar_model->find(array("name"=>"meeting_number"), array(), array(), true)[0]['value'];
	$meeting_passcode = $this->Webinar_model->find(array("name"=>"meeting_passcode"), array(), array(), true)[0]['value'];

	if($api_key != '' && $api_secret != '' && $meeting_number != ''){

		$islive = true;
		$signature = generate_signature($api_key, $api_secret, $meeting_number, 0);

		$this->Webinar_model->setTable('tbl_event');
		$event = $this->Webinar_model->find(array("status"=>"upcoming"), array("start_time" => "ASC"), array(), true);
		if(count($event) > 0){
			$id = $event[0]['id'];
			$attended = $event[0]['attended'];
			$attended++;
			$this->Webinar_model->update(array("id"=>$id), array('attended' => $attended));
		}

	}
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

	<?php if($islive){ ?>

	<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.5/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.5/css/react-select.css" />

	<?php } ?>
</head>
<body>
	<?php if(!$islive){ ?>
	<div class="information">
		<h1>Webinar is not started yet!</h1>
		<h2><a href="" style="text-decoration: underline">Click here</a> to refresh.</h2>
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
	<?php }else{ ?>
	<!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/1.9.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.9.5/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.9.5.min.js"></script>

    <script>
    	var api_key = '<?=$api_key?>';
    	var meeting_number = '<?=$meeting_number?>';
    	var meeting_passcode = '<?=$meeting_passcode?>';
    	var signature = '<?=$signature?>';
    	var userName = '<?=$user['name']?>';
    	if(userName == '') userName = 'Anonymous';
    </script>

    <script>
    	// For Global use source.zoom.us:
		ZoomMtg.setZoomJSLib('https://source.zoom.us/1.9.5/lib', '/av'); 
		ZoomMtg.preLoadWasm();
		ZoomMtg.prepareJssdk();

		const meetConfig = {
			apiKey: api_key,
			meetingNumber: meeting_number,
			leaveUrl: window.location.href.split('?')[0]+'_close',
			userName: userName,
			passWord: meeting_passcode, // if required
			role: 0 // 1 for host; 0 for attendee
		}

		
		ZoomMtg.init({
			leaveUrl: meetConfig.leaveUrl,
			isSupportAV: true,
			success: function() {
				ZoomMtg.join({
					signature: signature,
					apiKey: meetConfig.apiKey,
					meetingNumber: meetConfig.meetingNumber,
					userName: meetConfig.userName,
					// password optional; set by Host
					passWord: meetConfig.passWord,
					success: function (res) {
			            console.log("join meeting success");
			            console.log("get attendee list");
		          	},
					error(res) { 
						alert(res.errorMessage);
					}
				})		
			}
		})

		
    </script>
	<?php } ?>
	
</body>
</html>