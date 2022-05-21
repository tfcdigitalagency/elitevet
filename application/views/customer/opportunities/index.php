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

						<div>
							<img style="width: 100%; border-radius: 10px;" src="<?php echo base_url()?>/assets/banner_opp.png">
						</div>

                    </div>
                    <div class="row">
						<div class="col-md-12">

							<!-- Blog layout #1 with video -->
							<div class="card" style="font-size: large;">
								<div class="card-body">
									<h1>Opportunity Board</h1>
									<p>Opportunity Board offers buyers, estimators and Veteran business advocates the ability to reach the Veteran business community for FREE. Share your bid opportunities, RFPs, RFQs, RFIs, outreach events and more! We will share these opportunities for free with Veterans businesses nationwide. Simply fill out the Opportunity Board form, include any attachments if necessary and submit.</p>
									<div class="card-body">
										<div class="gv-table-view gv-table-container gv-table-multiple-container gv-container gv-container-5724">
											<table class="gv-table-view" width="100%">
												<thead>
												<tr>
													<th width="20%" id="gv-field-5-1" class="gv-field-5-1" data-label="Company"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Company</span></th>
													<th id="gv-field-5-11" class="gv-field-5-11" data-label="Opportunity Title"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Opportunity Title</span></th>
													<th width="20%" id="gv-field-5-8" class="gv-field-5-8" data-label="Deadline Date"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Deadline Date</span></th>		</tr>
												</thead>
												<tbody>
												<?php for($k=0;$k<count($opportunities);$k++){ ?>
												<tr class="<?php echo ($k%2==0)? 'alt':'' ?>">
													<td id="gv-field-5-1" class="gv-field-5-1" data-label="Company"><a href="<?php echo site_url('/customer/opportunities/detail/'.$opportunities[$k]['id'])?>"><?php echo $opportunities[$k]['company']; ?></a></td>
													<td id="gv-field-5-11" class="gv-field-5-11" data-label="Opportunity Title"><a href="<?php echo site_url('/customer/opportunities/detail/'.$opportunities[$k]['id'])?>"><?php echo $opportunities[$k]['title']; ?></a></td>
													<td id="gv-field-5-8" class="gv-field-5-8" data-label="Deadline Date"><a href="<?php echo site_url('/customer/opportunities/detail/'.$opportunities[$k]['id'])?>"><?php echo ($opportunities[$k]['end_date'])?date("m/d/Y",strtotime($opportunities[$k]['end_date'])):''; ?></a></td>
												</tr>
												<?php } ?>
												</tbody>
												<tfoot>
												<tr>
													<th id="gv-field-5-1" class="gv-field-5-1" data-label="Company"><span class="gv-field-label"><a href="/opportunity-board/?sort%5B1%5D=asc" data-multisort-href="/opportunity-board/" class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Company</span></th><th id="gv-field-5-11" class="gv-field-5-11" data-label="Opportunity Title"><span class="gv-field-label"><a href="/opportunity-board/?sort%5B11%5D=asc" data-multisort-href="/opportunity-board/" class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Opportunity Title</span></th><th id="gv-field-5-8" class="gv-field-5-8" data-label="Deadline Date"><span class="gv-field-label"><a href="/opportunity-board/?sort%5B8%5D=asc" data-multisort-href="/opportunity-board/" class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Deadline Date</span></th>		</tr>
												</tfoot>
											</table>
										</div>

									</div>


								</div>
							</div>
							<!-- /blog layout #1 with video -->

						</div>
					</div>
                    <!-- /layout 1 -->

                    <div class="mb-3">
						<div style="text-align: right; font-size: 15px"> See more <a href="https://www.vibnetwork.org/opportunity-board/" target="_blank">https://www.vibnetwork.org/opportunity-board/</a></div>
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
