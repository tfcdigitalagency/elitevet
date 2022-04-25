<div style="text-align: left" class="live-iframe">

<?php

if($hash && !empty($data)){

	 

			if($data->created >= date("Y-m-d H:i:s",strtotime("-3 hours"))){

				?>				

				<h2>Host</h2>

				<iframe src="https://server.ncdeliteveterans.org:8080/video.html" title="Video1" width="600" height="550" scrolling="no"  style="border:0;overflow:hidden"></iframe> 

				<iframe src="https://server.ncdeliteveterans.org:4000/video.html" title="Video1" width="240" height="180" scrolling="no" style="border:0;overflow:hidden;position: relative;bottom: 85px;"></iframe>

				<a href="https://ncdeliteveterans.org/customer/whilewebinar" target="_blank">Visit Webinar page! (login required)</a> 

				<?php

			}else{

				//expired

				?>

				<h2 style="color:red">Sorry the link is expired.</h2>

				<?php

			}

		}else{

			?>

				<h2 style="color:red">Invalid.</h2>

			<?php

		}

?>

</div>