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
						<div class="col-md-8">

							<!-- Blog layout #1 with video -->
							<div class="card" style="font-size: large;">
								<div class="card-body">
									<div class="card-img embed-responsive embed-responsive-16by9 mb-3">
										<iframe class="embed-responsive-item" allowfullscreen="true" frameborder="0" mozallowfullscreen="" src="<?=$training[0]['video_link']?>" webkitallowfullscreen=""></iframe>
									</div>

									<div class="card-body" id="videodetail">
										<?=$training[0]['details']?>
									</div>


								</div>

								<div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
									<ul class="list-inline list-inline-dotted text-muted mb-3 mb-sm-0">
										<li class="list-inline-item">Uploaded By <a href="#" class="text-muted">Lavelle Jones</a></li>
										at <li id="uploadat" class="list-inline-item"><?=$training[0]['uploaded_at']?></li>
										<li class="list-inline-item"><a href="#" class="text-muted">3 comments</a></li>
									</ul>

									<a href="#" class="text-muted"><i class="icon-heart6 text-pink mr-2"></i> 99</a>
								</div>
							</div>
							<!-- /blog layout #1 with video -->

						</div>
						<div class="col-md-4">

							<!-- Blog layout #1 with video -->
							<div class="card">
							
								<div class="card-body">
									<div class="chart mb-3" id="bullets"></div>

									<ul class="media-list">
									<?php for($k=0;$k<count($training);$k++){ ?>

										<li class="media" >

											<a style="font-size: large;" onclick="show_Video('<?=$training[$k]['video_link']?>', '<?=$training[$k]['details']?>', '<?=$training[$k]['uploaded_at']?>')" class="btn bg-transparent text-success btn-icon">
												<?php echo $training[$k]['title']; ?>
											</a>
										</li>
									<?php } ?>
									</ul>
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
    function show_Video(video_url, detail, uploaded_at) {
        $('.embed-responsive-item').attr('src', video_url);
		$('#videodetail').text(detail);
		$('#uploadat').text(uploaded_at);
    }
</script>
