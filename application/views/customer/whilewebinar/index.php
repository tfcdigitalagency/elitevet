<?php
  date_default_timezone_set('America/Vancouver');
	function getExcerpt($string, $long = 60){
		if(strlen($string) <= $long) return $string;
		$s = substr($string, 0, $long);
   		$result = substr($s, 0, strrpos($s, ' '));
   		if(strlen($string) > strlen($result)) $result.="...";
   		return $result;
	}
	$contract = array_slice($contract, 0, 5);

  $this->While_webinar_model->setTable('tbl_event');
  $live = $this->While_webinar_model->find(array("status"=>"upcoming"), array("start_time" => "ASC"), array(), true);
  if(count($live) > 0){
    $live = $live[0];
  }
?>
<style>

  * {box-sizing: border-box;}
  body {font-family: Verdana, sans-serif;}
  .wrapper{
    width:  1500px;
    margin:  auto;
    max-width: 100%;
  }
  .post-item{
    margin: 10px 0 20px;
  }
  .post-item .post-thumbnail{
    width: 25%;
    float: left;
  }
  .post-item .post-thumbnail img{
    border-radius: 4px;
  }
  .post-item .post-content{
    width: 75%;
    float: left;
    padding-left: 10px;
  }
  .post-item .post-title{
    margin-bottom: 5px;
    line-height: 1.2em;
  }
  .post-item .post-sponsor{
    margin-bottom: 5px;
    line-height: 1.2em;
    color: #0a6ebd;
    font-weight: bold;
  }
  .post-item .post-description{
    line-height: 1.2em;
    font-size: 13px;
  }
  .gala-item{
    text-align:  center;
  }
  .gala-item img{
    max-width:  100%;
    max-height:  100px;
  }
  .sponsor-image{
    margin: 15px;
    max-height: 150px;
    display: inline-block;
  }
  #splide{
  	margin: 10px 0 20px;
  }
  .splide__list{
    width: 100%;
    text-align: center;
  }
  .hide{
    display: none;
  }
</style>

<link rel="stylesheet" href="<?=base_url().'assets/customer_assets'?>/splide/css/splide.min.css" type="text/css" media="all">
<script src="<?=base_url().'assets/customer_assets'?>/splide/js/splide.min.js"></script>

<!-- Content area -->
<div class="content wrapper">

  <div class="mb-3">
      <h1 class="mb-0 font-weight-semibold" style="color:red">
		  <?php if($this->ishost){?>
	  <div class="float-right"><a id="broadcasterNow" class="btn btn-success" style="color:#fff"><i class="fa fa-camera"></i> Start Broadcasting</a></div>
	  <?php }?>
      </h1>
  </div>

  <div class="row">
    <div class="col-sm-12 col-lg-8">
      <div class="card">
        <div class="card-body">

          <div id="sponsors" class="hide" style="text-align: center">
            <h1><strong>Thanks to our sponsors!</strong></h1>
            <br>
            <?php foreach($sponsors_image as $s){ ?>
            <img src="<?=base_url().$s['link']?>" alt="" class="sponsor-image" />
            <?php } ?>
          </div>
		 <iframe id="frameBroast" src="https://server.ncdeliteveterans.org:4000/video.html" title="Video1" width="100%" height="600" scrolling="no" style="border:0;overflow:hidden"></iframe>
          
		  
		  
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-lg-4">
      <div class="card">
        <div class="card-body">

          <div style="text-align: center" class="live-iframe">
			<table width="100%">
			<tr>
			<td width="50%">
				<video id="trainingVideoPlayer" src="" autoplay muted autobuffer controls style="width: 100%">
				Your browser does not support the video element.
			  </video>
			</td>
			<td width="50%">
				<iframe src="https://server.ncdeliteveterans.org:8080/video.html" title="Video1" width="100%" height="180" scrolling="no"  style="border:0;overflow:hidden"></iframe>    
			</td>
			
			</tr>
			</table>
          </div>

          <a href="<?=base_url().$handout?>" target="_blank" class="btn btn-info" style="color: #fff; margin: 10px 0; width: 100%">
            <i class="icon-file-pdf" style="margin-right: 10px;"></i> Download handout
          </a>

          <div class="splide" id="splide">
            <div class="splide__track">
              <ul class="splide__list">
                <?php foreach($adsimage as $i){ ?>
                <li class="splide__slide gala-item">
                  <img src="<?=base_url().$i['thumbnail']?>" />
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>

          <div class="posts-wrapper">
            <?php foreach($contract as $c){ ?>
            <div class="post-item ">
			  <a href="<?php echo trim($c['details'])?>" class="row" target="_blank">
              <div class="post-thumbnail col-lg-4" style="width:200px;">
                <img src="<?=base_url().$c['thumbnail']?>" alt="" />
              </div>
              <div class="post-content col-lg-8">
                <p class="post-title"><strong><?=$c['title']?></strong></p>
                <p class="post-sponsor"><?=$c['sponsor']?></p>
                <div class="post-description">
                  <?=getExcerpt($c['details'])?>
                </div>
              </div>
              <div class="clearfix"></div>
			  </a>
            </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
	<div class="faqWrap">
	<h3>Do you have a question?</h3>
			<div>Totally <span class="total_quest"><?php echo $total_question;?></span> questions submitted.</div>
			<form id="frmFQA" method="POST" action="<?php echo site_url("/customer/whilewebinar/addQuestion")?>">
				<div class="row">
				<div class="col-md-10">
					<input type="text" id="question" name="question" class="form-controls"/>
				</div>
				<div class="col-md-2">
					<input type="submit" id="btnSendQuestion" value="Send"  name="submit" style="height: 100%;width: 100%;" class="btn btn-primary"/>
				</div>
				</div>
				<div id="message_q" style="color:blue;"></div>
			</form> 
		  </div>
		 </div>
	 </div>
<div class="card">
    <div class="card-body">
	<div class="faqWrap">
	<h3>Your capability Statement Pdf</h3> 
			<form action="<?php echo site_url('customer/whilewebinar/upload')?>" style="display:<?php echo($pdf_link)?'none':''?>" id="pdf_form" enctype="multipart/form-data" method="post" accept-charset="utf-8"> 
				<div class="row">
				<div class="col-md-12">
					<input type="file" name="userfile" size="20" style="display: inline-block;"/>
					<input type="submit" value="Upload" class="btn btn-primary" id="submit_file" />
					
				</div> 
				</div> 
			</form>
			<div id="pdf_link">
				<?php if($pdf_link) echo '<a target="_blank" class="btn btn-success" style="color:#fff;margin-top:10px;"  href="/assets/uploads/pdf/'.$pdf_link.'">Download Statement Pdf</a>';?>
				<a style="position: relative; cursor: pointer; display: inline-block; top: 5px; left: 20px;" id="btnEdit">Update</a>
			</div>
		  </div>
		 </div>
	 </div>	 
  <div class="card">
    <div class="card-body">
      <p id="attend" style="text-align: center;font-style: italic;font-size: x-large;"><?php echo $real_register; ?> registed users,  <span id="attended"><?php echo $real_attend; ?></span> attending users on this webinar.</p>
	  
    </div>
  </div>


  <div class="mb-3">

  </div>

</div>
<!-- /content area -->
<script type="text/javascript">
    $(document).ready(function () {

        $('#btnEdit').click(function () {
            $('#pdf_form').show();
            $(this).hide();
        });

        $("#submit_file").click(function (event) {
            event.preventDefault();
            var form_data = new FormData($('#pdf_form')[0]);


            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "customer/whilewebinar/upload",
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if (res) {
                        if (res.status == 1) {
                            $('#pdf_link').css({color: 'blue'}).html('<a  target="_blank" class="btn btn-success" style="color:#fff;margin-top:10px;"  href="/assets/uploads/pdf/' + res.data.upload_data.file_name + '">Download Statement Pdf</a>');
                        } else {
                            $('#pdf_link').css({color: 'red'}).html(res.error.error);
                        }

                    }
                }
            });
        });
    });
</script>

<script>
  var living = 0;
  var display_sponsor = "<?=$live['display_sponsor']?>";

  jQuery(document).ready(function() {
	  
	var broascatX = false;
	$('#broadcasterNow').click(function(){
		if(!broascatX){
			broascatX = true;
			$('#frameBroast').attr('src', "<?php echo site_url('customer/whilewebinar/host/4000');?>");
			$('#broadcasterNow').removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-camera"></i> Stop Broadcasting');
		}else{
			$('#frameBroast').attr('src',"<?php echo site_url('customer/whilewebinar/live/4000');?>" );
			$('#broadcasterNow').removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-camera"></i> Start Broadcasting');
			broascatX = false;
		}
	});  
	
	$('#frmFQA').submit(function(e){
		e.preventDefault();
		sendQuestion();
		return false;
	});	
	 
    new Splide( '#splide', {
      type  : 'fade',
      rewind: true,
      autoplay: true
    }).mount();
	
	setInterval(refreshQuestionTotal,5000);

    setInterval(function () {
	   //   $.ajax({
			// 	url: base_url+'customer/whilewebinar/getAttended',
			// 	type : 'POST',
			// 	dataType: 'json',
			// 	cache: false,
			// 	success: function(result) {
			// 		if(result.status == 'ok'){
			// 			$('#attended').text(result.data);
			// 		}
			// 	}
			// });

      $.ajax({
        url: 'webinar/getData',
        type : 'POST',
        dataType: 'json',
        cache: false,
        success: function(result) {
          if(result.status == 'ok'){
            $('#attended').text(result.data);
            display_sponsor = result.display_sponsor;
            if(result.live == 1 && living == 0){
              living = 1;
              $('.live-iframe').html(`
                <iframe src="<?=base_url()?>customer/webinar/live" style="width: 280px; height: 280px;"></iframe>
              `);
            }
            if(result.close_broadcasting == 1){
                $('#broadcating_wait').css('display','block');
                $('#broadcating_video').css('display','none');
            }
            checkDuration();
          }
        }
      });
		}, 5000);

  });
  
  function sendQuestion(){
	  $('#message_q').text("");
	  var quest = $('#question').val();
	  if(!quest){
		  $('#question').focus();
		  return;
	  }
	  $.ajax({
			url: $('#frmFQA').attr('action'),
			type: 'POST',
			dataType: 'json',
			data:$('#frmFQA').serialize()  
		}).done(function(response) {
			console.log(response);
			$('#question').val('');
			$('#message_q').text("Your question has been sent, thank you.");
			$('.total_quest').text(response.total);
		});
  }
  
  function refreshQuestionTotal(){
	  $.ajax({
			url: '<?php echo site_url("/customer/whilewebinar/totalRefresh")?>',
			type: 'POST',
			dataType: 'json' 
		}).done(function(response) { 
			$('.total_quest').text(response.total);
		});
  }

  function checkDuration(){
    if(display_sponsor == 1){
      $('#sponsors').removeClass('hide');
      $('#trainingVideoPlayer').addClass('hide');
      trainingVideoPlayer.pause();
    }else{
      $('#sponsors').addClass('hide');
      $('#trainingVideoPlayer').removeClass('hide');
    }
  }

  checkDuration();

  var trainingVideoList = [];
  <?php foreach($trainingvideo as $v){ ?>
      trainingVideoList.push('<?=$v['video_link']?>');
  <?php } ?>

  var trainingVideoIndex = 0;
  var trainingVideoPlayer = document.getElementById('trainingVideoPlayer');
  trainingVideoPlayer.onended = function(){
    if(trainingVideoIndex < trainingVideoList.length-1){
      trainingVideoIndex++;
    }
    else{
      trainingVideoIndex = 0;
    }
    trainingVideoPlayer.src = trainingVideoList[trainingVideoIndex];
  }

  trainingVideoPlayer.src = trainingVideoList[0];
</script>
