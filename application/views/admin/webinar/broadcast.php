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
<div id="device" style="display:none">
<div style="display:flex; margin:10px 0;">
<div class="select">
	<label for="audioSource">Audio: </label>
	<select id="audioSource" style="max-width:150px; padding:5px 10px;"></select>
</div>
<div class="select">
	<label for="videoSource">Video: </label>
	<select id="videoSource" style="max-width:150px; padding:5px 10px;"></select>
</div>
</div>
</div>
<video playsinline autoplay muted class="video minor"></video>
<div id="videoControls" style="display:none;">
<div id="mic_activity_wrap"><canvas id="mic_activity" width="10" height="150" style="border: solid 1px #ccc;"></canvas></div>

<div style="padding:10px 0; position:relative;">
<button id="start_video" class="btn btn-danger">Start Broadcasting</button>
<button id="end_video" class="btn btn-danger" style="display:none">End Broadcasting</button> &nbsp; <button id="stopCamera" onclick="stopVideoOnly()" class="btn btn-warning"  style="display:none">Turn off Camera</button>
<button id="genlink" onclick="generateLink(<?php echo $port?>)" class="btn btn-warning">Create Link</button>
<div id="currentUser" style="position:absolute; right:0; bottom: -23px; font-weight:bold;"></div>
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
		$('#device').show();
		start();
		updateStatus();
		checkInt = setInterval(updateStatus,2000);
	});

$('#end_video').click(function(){ 
	$('#start_video').show();
	$('#end_video').hide();
	$('#stopCamera').hide();
	$('#device').hide();
	stop();
	clearInterval(checkInt);
});
setInterval(checkStatus,2000);
function checkStatus(){
	 $.ajax({
                url: '<?php echo site_url("/admin/webinar/broadcast_status")?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    port: <?php echo $port?>,
                    uid: <?php echo $user['id'];?>
                }
            }).done(function(response) {
				$('#currentUser').text(response.currentName);
				
                if(parseInt(response.status) == 1){
					$('#videoControls').show();
				}else{
					$('#videoControls').hide();
				}
            });
	
}

function updateStatus(){
	 $.ajax({
                url: '<?php echo site_url("/admin/webinar/broadcast_status")?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    port: <?php echo $port?>,
                    uid: <?php echo $user['id'];?>,
                    act: 'up'
                }
            }).done(function(response) {				
                if(parseInt(response.status) == 1){
					$('#videoControls').show();
				}else{
					$('#videoControls').hide();					
				}
            });
}

function generateLink(p){
	 $.ajax({
                url: '<?php echo site_url("/broadcasting/createLink")?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    port: p, 
                    act: 'up'
                }
            }).done(function(response) {				
                if(parseInt(response.status) == 1){
					 alert("Your new link was generated in clipboard.");
					 copyToClipboard(response.url);
				} 
            });
}

function removeStatus(){
	 $.ajax({
                url: '<?php echo site_url("/admin/webinar/broadcast_status")?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    port: <?php echo $port?>,
                    uid: <?php echo $user['id'];?>,
                    act: 'del'
                }
            }).done(function(response) {				
                if(parseInt(response.status) == 1){
					$('#videoControls').show();
				}else{
					$('#videoControls').hide();					
				}
            });
}

function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}
</script>