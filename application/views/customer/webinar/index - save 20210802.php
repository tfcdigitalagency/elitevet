<?php
    $islive = false;
    $this->Webinar_model->setTable('tbl_broadcast');
    $api_key = $this->Webinar_model->find(array("name"=>"api_key"), array(), array(), true)[0]['value'];
    $api_secret = $this->Webinar_model->find(array("name"=>"api_secret"), array(), array(), true)[0]['value'];
    $meeting_number = $this->Webinar_model->find(array("name"=>"meeting_number"), array(), array(), true)[0]['value'];
    $meeting_passcode = $this->Webinar_model->find(array("name"=>"meeting_passcode"), array(), array(), true)[0]['value'];

    if($api_key != '' && $api_secret != '' && $meeting_number != ''){
        $islive = true;
    }
?>
<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

.mySlides img {
    max-height: 500px !important;
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">

                    <!-- Layout 1 -->
                    <div class="mb-3">

                    </div>
                    <div class="row">
						<div class="col-md-12">
							<!-- Blog layout #1 with video -->
							<div class="card">
								<div class="card-body">
									<?php if(!$islive){ ?>
                                    <div class="row">
                                        <div class="col-<?=count($video) > 0 ? '6' : '12'?>">
    										<div class="slideshow-container">
                                            <?php if (!empty($webinar)):?>
                                                <?php foreach ($webinar as $item):?>
                                                    <div class="mySlides fade">
                                                        <img src="<?=base_url().$item['thumbnail']?>" style="width:100%">
                                                    </div>
                                                <?php endforeach;?>
                                            <?php else:?>
                                                <div class="mySlides fade">
                                                    <img src="<?=base_url(ASSETS_URL)?>image/1.jpg" style="width:100%">
                                                </div>

                                                <div class="mySlides fade">
                                                    <img src="<?=base_url(ASSETS_URL)?>image/3.jpg" style="width:100%">
                                                </div>

                                                <div class="mySlides fade">
                                                    <img src="<?=base_url(ASSETS_URL)?>image/2.jpg" style="width:100%">
                                                </div>
                                            <?php endif;?>
    										</div>
    										<br>

    										<div style="text-align:center">
                                            <?php if (!empty($webinar)):?>
                                                <?php foreach ($webinar as $item):?>
                                                    <span class="dot"></span>
                                                <?php endforeach;?>
                                            <?php else:?>
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                            <?php endif;?>
    										</div>
                                        </div>

                                        <?php if(count($video) > 0){ ?>
                                        <div class="col-6">
                                            <video id="videoPlayer" src="<?=base_url().$video[0]['thumbnail']?>" autoplay muted autobuffer controls>
                                                Your browser does not support the video element.
                                            </video>
                                        </div>
                                        <?php } ?>

                                    </div>
									<div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
										<ul class="list-inline list-inline-dotted text-muted mb-3 mb-sm-0">
											
										</ul>

										<a class="text-muted"><i class="icon-music text-pink mr-2" ></i><button type="button" class="btn btn-primary" onclick="play_Music()">Pre Music Count Down</button></a>
									</div>
                                    <audio controls id="video1" hidden>
                                        <source src="<?=!empty($music)?base_url($music[0]['music']):'';?>" type="audio/mpeg" />
                                      Your browser does not support the audio element.
                                    </audio>
                                    <p style="text-align: center;font-style: italic;font-size: x-large;">The Webinar will be started soon, Please make sure you are online for webinar.</p>
                                    <p id="attend" style="text-align: center;font-style: italic;font-size: x-large;"><?php echo $event[0]['registered']; ?> registed users,  <?php echo $event[0]['attended']; ?> users on this webinar.</p>

                                    <h2 style="text-align: center"><a href="" style="text-decoration: underline">Click here</a> to refresh.</h2>
                                        
                                    <?php }else{ ?>
                                    <iframe src="<?=base_url()?>customer/webinar/live" style="height: calc(100vh - 150px)"></iframe>
                                    <?php } ?>
									
								</div>
							</div>
							<!-- /blog layout #1 with video -->

						</div>
					</div>
                    <!-- /layout 1 -->
                   	
                    <p style="height: 30px;"></p>
                    <div class="mb-3">

                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>

<script>
    var slideIndex = 0;
    var data = JSON.parse('<?=json_encode($event)?>');
    var count = 0;

    // var music_path;

    var myMusic = document.getElementById("video1"); 

    function play_Music(){
      if (myMusic.paused) 
          myMusic.play(); 
      else 
          myMusic.pause();

    }
    
<?php if(!$islive){ ?>
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
           slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 3 seconds
    }

    setInterval(function () {
        var data_length = data.length;
        var temp = count % data_length;
        var html = data[temp]['registered'] + ' registed users, ' + data[temp]['attended'] + ' attending users on this webinar.';
        $('#attend').html(html);
        count++;
    }, 5000);

    jQuery(document).ready(function() {
        var data_length = data.length;
        var temp = count % data_length;
        var html = data[temp]['registered'] + ' registed users, ' + data[temp]['attended'] + ' attending users on this webinar.';
        $('#attend').html(html);
        count++;
    });

    

    <?php if(count($video) > 0){ ?>
    var videoList = [];
    <?php foreach($video as $v){ ?>
        videoList.push('<?=$v['thumbnail']?>');
    <?php } ?>

    var videoIndex = 0;
    var videoPlayer = document.getElementById('videoPlayer');
    videoPlayer.onended = function(){
        if(videoIndex < videoList.length-1)
            videoIndex++;
        else
            videoIndex = 0;
        videoPlayer.src = '<?=base_url()?>'+videoList[videoIndex];
    }
    <?php } ?>
<?php } ?>
</script> 
