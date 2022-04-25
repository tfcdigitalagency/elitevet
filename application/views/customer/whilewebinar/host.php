<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.voximplant.com/voximplant.min.js"></script>
	<style>
		#mic_activity_wrap {
		    position: absolute;
            height: 20px;
            overflow: hidden;
            width: 160px;
            left: 4px;
			bottom: 10px;
        }
    	#mic_activity {
    		-webkit-transform: rotate(90deg);
    		-moz-transform: rotate(90deg);
    		-o-transform: rotate(90deg);
    		-ms-transform: rotate(90deg);
    		transform: rotate(90deg); 
    		
    		 
            position: relative;
            top: -67px;
            left: 73px;
     
    	}
	
	</style>
<?php
	$user =  $this->session->userdata('user');
	//print_r($user);
?>
<div style="width:100%; margin:auto;position:relative">
<div style="width: 0; height: 0; overflow: hidden;">
<div style="display:none;opacity: 0" class="select">
	<label for="audioSource">Audio: </label>
	<select id="audioSource"></select>
</div>
<div style="display:none;opacity: 0" class="select">
	<label for="videoSource">Video: </label>
	<select id="videoSource"></select>
</div>
</div>
<video playsinline autoplay muted class="video minor" style="height: 144px;"></video>
<div id="videoControls" >
<div id="mic_activity_wrap"><canvas id="mic_activity" width="10" height="240" style="border: solid 1px #ccc;"></canvas></div>

<div style="padding:10px 0; position:relative;bottom:-30px;">
<button id="start_video" class="btn btn-danger">Start Broadcasting</button>
<button id="end_video" class="btn btn-danger" style="display:none">End Broadcasting</button> &nbsp; <button id="stopCamera" onclick="stopVideoOnly()" class="btn btn-warning"  style="display:none">Turn off Camera</button>
<div id="currentUser" style="position:absolute; right:0; top:5px; font-weight:bold;"></div>
 </div>

</div>
</div>
<link href="<?php echo site_url()?>assets/broadcast/styles.css?v=<?php echo time()?>" rel="stylesheet" />
<script src="https://server.ncdeliteveterans.org:<?php echo $port?>/socket.io/socket.io.js"></script>
<script src="<?php echo site_url()?>assets/broadcast/broadcast_<?php echo $port?>.js?v=<?php echo time()?>"></script>
<script>
var checkInt = null;
$('#start_video').click(function(){
		$('#start_video').hide();
		$('#end_video').show();
		$('#stopCamera').show();
		start(); 
	});

$('#end_video').click(function(){ 
	$('#start_video').show();
	$('#end_video').hide();
	$('#stopCamera').hide();
	stop();
});

$(document).ready(function(){
		$('#start_video').hide();
		$('#end_video').show();
		$('#stopCamera').show();
		start(); 
});

</script>