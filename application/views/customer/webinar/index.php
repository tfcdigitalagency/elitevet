<?php
date_default_timezone_set('America/Vancouver');
//date_default_timezone_set('Asia/Ho_Chi_Minh');
function getExcerpt($string, $long = 60)
{
	if (strlen($string) <= $long) return $string;
	$s = substr($string, 0, $long);
	$result = substr($s, 0, strrpos($s, ' '));
	if (strlen($string) > strlen($result)) $result .= "...";
	return $result;
}

$contract = array_slice($contract, 0, 5);
//$trainingvideo = array_slice($trainingvideo, 0, 2);

$this->Webinar_model->setTable('tbl_event');
$live = $this->Webinar_model->find(array("status" => "upcoming"), array("start_time" => "ASC"), array(), true);
if (count($live) > 0) {
	$live = $live[0];
}

$now = date("Y-m-d H:i:s");

?>
<link rel="stylesheet" href="<?= base_url() . 'assets/customer_assets' ?>/splide/css/splide.min.css" type="text/css"
	  media="all">
<script src="<?= base_url() . 'assets/customer_assets' ?>/splide/js/splide.min.js"></script>
<script src="<?= base_url() . 'assets/customer_assets' ?>/moment.min.js"></script>
<style>


	.wrapper {
		width: 1500px;
		margin: auto;
		max-width: 100%;
	}

	.post-item {
		margin: 10px 0 20px;
	}

	.post-item .post-thumbnail {
		width: 25%;
		float: left;
	}

	.post-item .post-thumbnail img {
		border-radius: 4px;
	}

	.post-item .post-content {
		width: 75%;
		float: left;
		padding-left: 10px;
	}

	.post-item .post-title {
		margin-bottom: 5px;
		line-height: 1.2em;
	}

	.post-item .post-sponsor {
		margin-bottom: 5px;
		line-height: 1.2em;
		color: #0a6ebd;
		font-weight: bold;
	}

	.post-item .post-description {
		line-height: 1.2em;
		font-size: 13px;
	}

	.gala-item {
		text-align: center;
	}

	.gala-item img {
		max-width: 100%;
		max-height: 100px;
	}

	.sponsor-image {
		margin: 15px;
		max-height: 150px;
		display: inline-block;
	}

	.hide {
		display: none;
	}

	.splide__list {
		width: 100%;
		text-align: center;
	}

	.zoom-part {
		position: relative;
		height: 280px;
		overflow: hidden;
	}

	.zoom-placeholder {
		position: absolute;
		z-index: 1;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: #fff;
		display: none;
		align-items: center;
		justify-content: center;
	}

	.zoom-placeholder.show {
		display: flex;
	}

</style>
<script>
	var liveType = '';
</script>
<div class="content wrapper">

	<div class="mb-3">

	</div>

	<span class="countdown hide"></span>

	<?php if ($live) { ?>
		<div class="alert alert-success timeleft"></div>
		<?php if (get_admin_level() == 2): ?>
			<div style="text-align:right;padding-bottom:10px;"><a class="btn btn-success" id="broadcasterNow"
																  style="color:white">Start Broadcast</a></div>
		<?php endif; ?>
	<?php } ?>

	<!-- Gallery -->
	<div class="card" id="gallery">
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">

							<div style="text-align: center" class="live-iframe">
								<table width="100%">
									<tr>
										<td>
											<iframe src="https://server.ncdeliteveterans.org:8080/video.html" title="Video1" width="100%" height="200" scrolling="no"  style="border:0;overflow:hidden"></iframe>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<div class="card-body">

							<div style="text-align: center" class="live-iframe">
								<table width="100%">
									<tr>
										<td>
											<iframe id="frameBroast1" src="https://server.ncdeliteveterans.org:4000/video.html" title="Video1" width="100%" height="200" scrolling="no" style="border:0;overflow:hidden"></iframe>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="splide" id="splide">
						<div class="splide__track">
							<ul class="splide__list">
								<?php if (!empty($webinar)): ?>

									<?php foreach ($webinar as $item): ?>
										<li class="splide__slide" style="text-align: center">
											<img  class="image-slide-fit" src="<?= base_url() . $item['thumbnail'] ?>"/>
										</li>
									<?php endforeach; ?>

								<?php else: ?>

									<li class="splide__slide">
										<img  class="image-slide-fit" src="<?= base_url(ASSETS_URL) ?>image/1.jpg"/>
									</li>
									<li class="splide__slide gala-item">
										<img  class="image-slide-fit" src="<?= base_url(ASSETS_URL) ?>image/2.jpg"/>
									</li>
									<li class="splide__slide gala-item">
										<img  class="image-slide-fit" src="<?= base_url(ASSETS_URL) ?>image/3.jpg"/>
									</li>

								<?php endif; ?>
							</ul>
						</div>
					</div>

				</div>


			</div>


		</div>
	</div>

	<?php if ($live) { ?>

		<!-- Pre videos -->
		<div class="card hide" id="prevideo">
			<div class="card-body">
				<video id="preVideoPlayer" src="" autoplay muted autobuffer controls style="width: 100%">
					Your browser does not support the video element.
				</video>
			</div>
		</div>

		<!-- Webinar -->
		<div class="row hide" id="whilewebinar">

			<div class="col-sm-12 col-lg-3">
				<div class="card">
					<div class="card-body">

						<div style="text-align: center" class="live-iframe">
							<table width="100%">
								<tr>
									<td>
										<iframe src="https://server.ncdeliteveterans.org:8080/video.html" title="Video1"
												width="100%" height="200" scrolling="no"
												style="border:0;overflow:hidden"></iframe>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="card mt-3">
					<div class="card-body">

						<div style="text-align: center" class="live-iframe">
							<table width="100%">
								<tr>
									<td>
										<iframe id="frameBroast2"
												src="https://server.ncdeliteveterans.org:4000/video.html" title="Video1"
												width="100%" height=200" scrolling="no"
												style="border:0;overflow:hidden"></iframe>
									</td>
								</tr>
							</table>
						</div>
					</div>


				</div>
			</div>
			<div class="col-sm-12 col-lg-9">
				<div class="card">
					<div class="card-body">

						<div id="sponsors" class="hide" style="text-align: center">
							<h1><strong>Thanks to our sponsors!</strong></h1>
							<br>
							<?php foreach ($sponsors_image as $s) { ?>
								<img src="<?= base_url() . $s['link'] ?>" alt="" class="sponsor-image"/>
							<?php } ?>
						</div>

						<div id="sponsors-single" class="hide" style="text-align: center">
							<img src="<?= base_url() . $sponsor_image_url ?>" alt="" class="sponsor-single-image"/>
						</div>


						<video id="trainingVideoPlayer" src="" autoplay muted autobuffer controls style="width: 100%"
							   class="hide">
							Your browser does not support the video element.
						</video>

					</div>

				</div>
			</div>
		</div>


	<?php } ?>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="faqWrap">
						<h3>Do you have a question?</h3>
						<div>Totally <span class="total_quest"><?php echo $total_question; ?></span> questions
							submitted.
						</div>
						<form id="frmFQA" method="POST"
							  action="<?php echo site_url("/customer/whilewebinar/addQuestion") ?>">
							<div class="row">
								<div class="col-md-10">
									<input type="text" id="question" name="question" class="form-controls"/>
								</div>
								<div class="col-md-2">
									<input type="submit" id="btnSendQuestion" value="Send" name="submit"
										   style="height: 100%;width: 100%;" class="btn btn-primary"/>
								</div>
							</div>
							<div id="message_q" style="color:blue;"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="faqWrap">
								<h3>Webinar tool</h3>
								<form action="<?php echo site_url('customer/whilewebinar/upload') ?>"
									  style="display:<?php echo ($pdf_link) ? 'none' : '' ?>" id="pdf_form"
									  enctype="multipart/form-data" method="post" accept-charset="utf-8">
									<div class="row">
										<div class="col-md-12">
											<input type="file" name="userfile" size="20" style="display: inline-block;"/>
											<input type="submit" value="Upload" class="btn btn-primary" id="submit_file"/>

										</div>
									</div>
								</form>
								<div id="pdf_link">
									<?php if ($pdf_link) echo '<a target="_blank" style="margin-right:15px;" title="Download Statement Pdf"  href="/assets/uploads/pdf/' . $pdf_link . '"><i class="fa fa-download"></i></a>'; ?>
									<a style="cursor: pointer;margin-right:15px;"
									   id="btnEdit" title="Update Statement Pdf"><i class="fa fa-edit"></i></a>
									<a href="<?= base_url() . $handout ?>" title="Download handout" target="_blank"
									   style="margin-right:15px;" >
										<i class="icon-file-pdf"></i>
									</a>
									<a href="#" onclick="playMusic()" title="Pre Music Count Down" style="margin-right:15px;" ><i class="icon-music text-pink mr-2"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="col-md-6 text-right">
							<audio controls id="backgroundMusic" hidden>
								<source src="<?= !empty($music) ? base_url($music[0]['music']) : ''; ?>" type="audio/mpeg"/>
								Your browser does not support the audio element.
							</audio>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">

					<?php if($live):?>
					<div class="splide" id="gala">
						<div class="splide__track">
							<ul class="splide__list">
								<?php foreach ($adsimage as $i) { ?>
									<li class="splide__slide gala-item">
										<img  class="image-slide-fit" src="<?= base_url() . $i['thumbnail'] ?>"/>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php endif;?>
					<div class="posts-wrapper">
						<?php foreach ($contract as $c) { ?>
							<div class="post-item ">
								<a href="<?php echo trim($c['details']) ?>" class="row" target="_blank">
									<div class="post-thumbnail col-lg-4" style="width:200px;">
										<img src="<?= base_url() . $c['thumbnail'] ?>" alt=""/>
									</div>
									<div class="post-content col-lg-8">
										<p class="post-title"><strong><?= $c['title'] ?></strong></p>
										<p class="post-sponsor"><?= $c['sponsor'] ?></p>
										<div class="post-description">
											<?= getExcerpt($c['details']) ?>
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


	<div class="card" id="webinar-footer">
		<div class="card-body">
			<p id="attend"
			   style="text-align: center;font-style: italic;font-size: x-large;"><?php echo $real_register; ?> registed
				users, <span id="attended"><?php echo $real_attend; ?></span> attending users on this webinar.</p>

		</div>
	</div>
	<div class="mb-3">

	</div>

</div>

<script type="text/javascript">
	$(document).ready(function () {

		setInterval(refreshQuestionTotal, 5000);
		$('#frmFQA').submit(function (e) {
			e.preventDefault();
			sendQuestion();
			return false;
		});
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

	function sendQuestion() {
		$('#message_q').text("");
		var quest = $('#question').val();
		if (!quest) {
			$('#question').focus();
			return;
		}
		$.ajax({
			url: $('#frmFQA').attr('action'),
			type: 'POST',
			dataType: 'json',
			data: $('#frmFQA').serialize()
		}).done(function (response) {
			console.log(response);
			$('#question').val('');
			$('#message_q').text("Your question has been sent, thank you.");
			$('.total_quest').text(response.total);
		});
	}

	function refreshQuestionTotal() {
		$.ajax({
			url: '<?php echo site_url("/customer/whilewebinar/totalRefresh")?>',
			type: 'POST',
			dataType: 'json'
		}).done(function (response) {
			$('.total_quest').text(response.total);
		});
	}

</script>

<script>

	var myMusic = document.getElementById("backgroundMusic");

	function playMusic() {
		if (myMusic.paused) myMusic.play();
		else myMusic.pause();
	}


	jQuery(document).ready(function () {
		var broascatX = false;
		$('#broadcasterNow').click(function () {
			var t = new Date().getSeconds();
			if (!broascatX) {
				broascatX = true;
				$('#frameBroast2').attr('src', "<?php echo site_url('customer/whilewebinar/host/4000');?>?t=" + t);
				$('#broadcasterNow').removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-camera"></i> Stop Broadcasting');
			} else {
				$('#frameBroast2').attr('src', "https://server.ncdeliteveterans.org:4000/video.html?t=" + t);
				$('#broadcasterNow').removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-camera"></i> Start Broadcasting');
				broascatX = false;
			}
		});

		new Splide('#splide', {
			type: 'fade',
			rewind: true,
			autoplay: true
		}).mount();

		<?php if($live){ ?>

		var display_sponsor = "<?=$live['display_sponsor']?>";

		var status_webinar = '';
		var is_end = 0;

		setInterval(function () {
			$.ajax({
				url: 'webinar/getData',
				type: 'POST',
				dataType: 'json',
				cache: false,
				success: function (result) {
					if (status_webinar == 'ok' && result.status == 'end') {
						// End webinar
						is_end = 1;
						$('#sponsors-single').removeClass('hide');
						$('.zoom-placeholder').addClass('show');
						$('.live-iframe').remove();
						$('#prevideo').remove();
						$('#sponsors').remove();
						$('#trainingVideoPlayer').remove();
						setTimeout(function () {
							$('#webinar-footer').remove();
							$('#gallery').removeClass('hide');
							$('#whilewebinar').remove();
						}, 300000);
					} else {
						status_webinar = result.status;
						if (result.status == 'ok') {
							$('#attended').text(result.data);
							display_sponsor = result.display_sponsor;

							if (status == 'whilewebinar') {

								if (result.live == 1 && living == 0) {
									living = 1;
									$('.live-iframe').html(`
											<iframe src="<?=base_url()?>customer/webinar/live" style="width: 280px; height: 280px;"></iframe>
										`);
								}

								if (living == 1 && result.display_zoom != display_zoom) {
									display_zoom = result.display_zoom;
									if (display_zoom == 0) {
										$('.zoom-placeholder').addClass('show');
									} else if (display_zoom == 1) {
										$('.zoom-placeholder').removeClass('show');
									}
								}

							}

							if (liveType == 'broadcasting' && result.close_broadcasting == 1) {
								$('#broadcating_wait').addClass('show');
								$('#broadcating_video').css('display', 'none');
								liveType = '';
							}


						}
					}
				}
			});
		}, 5000);

		var preVideoList = [];
		<?php foreach($video as $v){ ?>
		preVideoList.push('<?=$v['thumbnail']?>');
		<?php } ?>

		var preVideoIndex = 0;
		var preVideoPlayer = document.getElementById('preVideoPlayer');
		preVideoPlayer.onended = function () {
			if (preVideoIndex < preVideoList.length - 1)
				preVideoIndex++;
			else
				preVideoIndex = 0;
			preVideoPlayer.src = '<?=base_url()?>' + preVideoList[preVideoIndex];
		}

		var trainingVideoList = [];
		<?php foreach($trainingvideo as $v){ ?>
		trainingVideoList.push('<?=$v['video_link']?>');
		<?php } ?>

		var trainingVideoIndex = 0;
		var trainingVideoPlayer = document.getElementById('trainingVideoPlayer');
		trainingVideoPlayer.onended = function () {
			if (trainingVideoIndex < trainingVideoList.length - 1) {
				trainingVideoIndex++;
			} else {
				trainingVideoIndex = 0;
			}
			trainingVideoPlayer.src = trainingVideoList[trainingVideoIndex];
		}

		var status = '';
		var living = 0;
		var display_zoom = "0";

		new Splide('#gala', {
			type: 'fade',
			rewind: true,
			autoplay: true
		}).mount();

		//var now = moment('2021-08-04 11:29:45','YYYY-MM-DD HH:mm:ss');
		var now = moment('<?=$now?>', 'YYYY-MM-DD HH:mm:ss');
		var live = moment('<?=$live["start_time"]?>', 'YYYY-MM-DD HH:mm');
		var timeleft = '';

		var duration = live.diff(now, 'seconds');

		checkDuration();
		getTimeLeft();

		setInterval(function () {
			checkDuration();
			if (duration >= 0) {
				getTimeLeft();
			}
			duration -= 1;
		}, 1000);

		function getTimeLeft() {
			if (duration > 0) {
				var d = h = m = s = 0;
				var totalSeconds = duration;
				d = Math.floor(totalSeconds / 86400);
				totalSeconds %= 86400

				h = Math.floor(totalSeconds / 3600);
				totalSeconds %= 3600;

				m = Math.floor(totalSeconds / 60);
				s = totalSeconds % 60;

				var ds = d < 2 ? (d + " day ") : (d + " days ");
				var hs = h < 2 ? (h + " hour ") : (h + " hours ");
				var ms = m < 2 ? (m + " min ") : (m + " mins ");
				var ss = s < 2 ? (s + " second ") : (s + " seconds ");

				timeleft = ss;
				if (d > 0 | h > 0 | m > 0) timeleft = ms + timeleft;
				if (d > 0 | h > 0) timeleft = hs + timeleft;
				if (d > 0) timeleft = ds + timeleft;

				$('.timeleft').html("The webinar will be started after " + timeleft + "...");
			} else {
				$('.timeleft').remove();
			}
		}

		function checkDuration() {
			if (is_end == 0) {
				$('.countdown').text(duration);
				var stt = '';
				if (duration > 900) {
					stt = 'gallery';
					$('#gallery').removeClass('hide');
				} else if (duration > 0) {
					stt = 'prevideo';
					$('#gallery').addClass('hide');
					$('#prevideo').removeClass('hide');
				} else {
					$('#gallery').addClass('hide');
					$('#prevideo').remove();
					$('#whilewebinar').removeClass('hide');
					if (display_sponsor == 1) {
						stt = 'sponsor';
						$('#sponsors').removeClass('hide');
						$('#trainingVideoPlayer').addClass('hide');
						trainingVideoPlayer.pause();
					} else {
						stt = 'whilewebinar';
						$('#sponsors').addClass('hide');
						$('#trainingVideoPlayer').removeClass('hide');
					}
				}
				if (stt != status) {
					status = stt;
					if (status == 'prevideo') {
						preVideoPlayer.src = '<?=base_url()?>' + preVideoList[0];
					} else if (status == 'whilewebinar') {
						trainingVideoPlayer.src = trainingVideoList[0];
					}
				}
			}
		}

		<?php } ?>


	});


</script> 
 
