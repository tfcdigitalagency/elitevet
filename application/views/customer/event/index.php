
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">

                    <!-- Layout 1 -->
                    <div class="mb-3">

                    </div>
                    <div style="border-style: solid;border-color: cadetblue;border-width: 2px;background-color: aliceblue;">
                    	<div class="content" style="width: 80%;margin-left: 10%;">
                    			
							<!-- Image grid -->						
							<div class="row">
							<?php for ($i = 0; $i < count($event); $i++){?>
								<div class="col-sm-3 col-xl-3">
									<div class="card" style="width:90%">
										<div class="card-img-actions mx-1 mt-1">
											<a href="<?=base_url().'customer/event/display_Detail?id='.$event[$i]['id']; ?>">
												<img class="card-img img-fluid" src="<?=base_url().$event[$i]['thumbnail'];?>" alt="">
											</a>										
										</div>

										<div class="card-body" style="color: black;font-size: 18px; font-weight: bold; padding: 0.25rem !important;">
											<div class="d-flex align-items-start flex-nowrap">
												<div>
													<a href="<?=base_url().'customer/event/display_Detail?id='.$event[$i]['id']; ?>">
														<?php echo $event[$i]['name']; ?>
													</a>
												</div>
											</div>
										</div>
										<div class="card-body" style="color: darkgoldenrod;font-size: inherit; padding: 0.25rem !important;">
											<div class="d-flex align-items-start flex-nowrap">
												<div>
													Location - <?php echo $event[$i]['location']; ?>
												</div>
											</div>
										</div>
										<div class="card-body" style="color: deeppink;font-size: inherit; padding: 0.25rem !important;">
											<div class="d-flex align-items-start flex-nowrap">
												<div>
													Start at <?php echo $event[$i]['start_time']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }?>	
							</div>						
							<!-- /Image grid -->
						</div>
						<div>
	                    	<ul class="pagination pagination-pager pagination-rounded pagination-lg justify-content-center mb-3">
								<li class="page-item active <?=($cur_page == 1)?'disabled':'';?>"><a href="<?=base_url().'customer/event/display_Event?page='.($cur_page-1); ?>" class="page-link">← &nbsp; Previous</a></li>
								<li class="page-item active <?=($all_count > $cur_count)?'':'disabled';?>"><a href="<?=base_url().'customer/event/display_Event?page='.($cur_page+1); ?>" class="page-link">Next &nbsp; →</a></li>
							</ul>             	
	                    </div>
                    </div>

                    
                    <!-- /layout 1 -->
                   	
                    <p style="height: 30px;"></p>
                    <div class="mb-3">
                        <h1 class="mb-0 font-weight-semibold" style="color:red">
                            EliteNCDVeterans
                        </h1>
                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>

<script> 
    function Display_Detail() {
        location.href = base_url+'auth/register';
    }

    function Previous(){

    }

</script>