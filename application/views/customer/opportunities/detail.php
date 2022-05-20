<style type="text/css">
	.gv-table-view{table-layout:fixed;width:100%}.gv-table-view th,.gv-table-view td{padding:.3em}.gv-table-view-content{table-layout:fixed}.gv-table-view-content th{width:35%;vertical-align:top}a.gv-sort.gv-icon-caret-up-down{opacity:0.5}a.gv-sort.gv-icon-caret-up-down:hover{opacity:1}@media screen and (max-width: 575.98px){.gv-table-view thead,.gv-table-view tfoot{display:none}.gv-table-view tr{display:block;position:relative;padding:1.2em 0;overflow-x:auto}.gv-table-view tr:first-of-type{border-top:1px solid #ccc}.gv-table-view tr td{display:table-row}.gv-table-view tr td:before{content:attr(data-label);font-weight:bold;display:table-cell;padding:0.2em 0.6em 0.2em 0;text-align:right;width:40%}.gv-table-view tr td:last-child:after{content:'';position:absolute;left:0;right:0;bottom:0;border-bottom:1px solid #ccc;width:100%}}
	.gv-table-view tr.alt {
		background-color: #f9f9f9;
	}
	.gv-table-view tr {
		border-bottom: 1px solid #CCC;
	}
</style>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="container">

                    <!-- Layout 1 -->
                    <div class="mb-3">

                        <h1 class="mb-0 font-weight-semibold" style="color:red">
                            EliteNCDVeterans
                        </h1>

                    </div>
                    <div class="row">
						<div class="col-md-12">

							<!-- Blog layout #1 with video -->
							<div class="card" style="font-size: large;">
								<div class="card-body">
									<h1>Opportunity Board <a class="btn btn-success" style="color: #fff; float: right;" href="<?php echo site_url('/customer/opportunities')?>">Back</a></h1>
									<div class="card-body">
										<div class="gv-table-view gv-table-container gv-table-single-container gv-container gv-container-5724">
											<table class="gv-table-view-content" width="100%">
												<tbody>
												<tr id="gv-field-5-1" class="gv-field-5-1">
													<th scope="row" width="30%"><span class="gv-field-label">Company</span></th>
													<td><?php echo $opportunity['company']?></td></tr>
												<tr id="gv-field-5-2" class="gv-field-5-2">
													<th scope="row"><span class="gv-field-label">Name</span></th>
													<td><?php echo $opportunity['name']?></td></tr>
												<tr id="gv-field-5-4" class="gv-field-5-4">
													<th scope="row"><span class="gv-field-label">Email</span></th>
													<td><a href="mailto:<?php echo $opportunity['email']?>"><?php echo $opportunity['email']?></a></td></tr>
												<tr id="gv-field-5-5" class="gv-field-5-5">
													<th scope="row"><span class="gv-field-label">Phone</span></th>
													<td><a href="tel:<?php echo $opportunity['phone']?>"><?php echo $opportunity['phone']?></a></td></tr>
												<tr id="gv-field-5-8" class="gv-field-5-8">
													<th scope="row">
														<span class="gv-field-label">Deadline Date</span></th><td><?php echo ($opportunity['end_date'])?date("m/d/Y",strtotime($opportunity['end_date'])):''; ?></td></tr>
												<tr id="gv-field-5-11" class="gv-field-5-11">
													<th scope="row"><span class="gv-field-label">Opportunity Title</span></th>
													<td><?php echo $opportunity['title']?></td></tr>
												<tr id="gv-field-5-12" class="gv-field-5-12"><th scope="row">
														<span class="gv-field-label">Description</span></th>
													<td><p><?php echo $opportunity['details']?></p>
													</td></tr>
												<tr id="gv-field-5-14" class="gv-field-5-14">
													<th scope="row"><span class="gv-field-label">Post Start Date</span></th>
													<td><?php echo ($opportunity['start_date'])?date("m/d/Y",strtotime($opportunity['start_date'])):''; ?></td></tr>
												<tr id="gv-field-5-15" class="gv-field-5-15">
													<th scope="row"><span class="gv-field-label">Post End Date</span></th>
													<td><?php echo ($opportunity['end_date'])?date("m/d/Y",strtotime($opportunity['end_date'])):''; ?></td></tr>
												<?php if($opportunity['second_thumbnail']):?>
												<tr id="gv-field-5-10" class="gv-field-5-10">
													<th scope="row"><span class="gv-field-label">Include attachment (PDF/JPG)</span></th>
													<td><a href="<?php echo  base_url().$opportunity['second_thumbnail']?>" rel="noopener noreferrer" target="_blank">
															<?php
															$filename = end(explode('/',$opportunity['second_thumbnail']));
															echo $filename?>
														</a></td>
												</tr>
												<?php endif;?>
												</tbody>

											</table>
										</div>
									</div>


								</div>
							</div>
							<!-- /blog layout #1 with video -->

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
    function show_Video(video_url, detail, uploaded_at) {
        $('.embed-responsive-item').attr('src', video_url);
		$('#videodetail').text(detail);
		$('#uploadat').text(uploaded_at);
    }
</script>
