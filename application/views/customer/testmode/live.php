<div id="broadcating_wait">
	<img width="100%" height="100%" src="<?=base_url()?>/assets/image/Sdvoblogo300.jpg" alt="" />
</div>
<div id="Brocast_Soc" style="display: none">
	<img width="100%" height="100%" src="<?=base_url()?>/assets/Brocast_Soc_2.jpg" alt="" />
</div>
<div id="broadcating_video" style="display: none">
	<video id="my_video" style="width: 100%;" playsinline autoplay></video>
	<button style="display:none;" id="enable-audio">Enable audio</button>
	<link href="<?php echo site_url()?>assets/broadcast/styles.css" rel="stylesheet" />
	<script src="https://server.ncdeliteveterans.org:<?php echo $port?>/socket.io/socket.io.js"></script>
	<script src="<?php echo site_url()?>assets/broadcast/watch_<?php echo $port?>.js?v=<?php echo time()?>"></script>
</div>