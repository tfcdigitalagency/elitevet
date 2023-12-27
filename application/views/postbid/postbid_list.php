<style type="text/css">
	.gv-table-view{table-layout:fixed;width:100%}.gv-table-view th,.gv-table-view td{padding:.3em}.gv-table-view-content{table-layout:fixed}.gv-table-view-content th{width:35%;vertical-align:top}a.gv-sort.gv-icon-caret-up-down{opacity:0.5}a.gv-sort.gv-icon-caret-up-down:hover{opacity:1}@media screen and (max-width: 575.98px){.gv-table-view thead,.gv-table-view tfoot{display:none}.gv-table-view tr{display:block;position:relative;padding:1.2em 0;overflow-x:auto}.gv-table-view tr:first-of-type{border-top:1px solid #ccc}.gv-table-view tr td{display:table-row}.gv-table-view tr td:before{content:attr(data-label);font-weight:bold;display:table-cell;padding:0.2em 0.6em 0.2em 0;text-align:right;width:40%}.gv-table-view tr td:last-child:after{content:'';position:absolute;left:0;right:0;bottom:0;border-bottom:1px solid #ccc;width:100%}}
	.gv-table-view tr.alt {
		background-color: #f9f9f9;
	}
	.gv-table-view tr {
		border-bottom: 1px solid #CCC;
	}
</style>
<div style="margin-top:30px;" data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="container">

                    <!-- Layout 1 -->

                    <div class="row">
						<div class="col-md-12">

							<!-- Blog layout #1 with video -->
							<div class="card" style="font-size: large;">
								<div class="card-body">
									<h1>List
										<div style="float: right">
											 <a class="btn btn-primary" style="color: #fff" href="<?php echo site_url('postbid/add/'.$hash)?>">Add New</a>
										</div>
									</h1>

									<div class="card-body">
										<div class="gv-table-view gv-table-container gv-table-multiple-container gv-container gv-container-5724">
											<table class="gv-table-view" width="100%">
												<thead>
												<tr>
													<th  id="gv-field-5-1" class="gv-field-5-1" data-label="Company"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>Opportunity</span></th>
													<th width="15%" id="gv-field-5-11" class="gv-field-5-11" data-label="Opportunity Title"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>Image</span></th>
													<th width="20%" id="gv-field-5-8" class="gv-field-5-8" data-label="Company"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>Company</span></th>
													<th width="20%" id="gv-field-5-8" class="gv-field-5-8" data-label="Description"><span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>Description</span></th>
													<th width="5%" id="gv-field-5-8" class="gv-field-5-8" data-label="Description"></th>

												</tr>
												</thead>
												<tbody>
												<?php
												if(!empty($data)){
												foreach($data as $k=>$item){ 
												 //echo '<pre>';print_r($item); die();
												?>
												<tr>
													<td id="gv-field-5-1" class="gv-field-5-1" data-label="Company">
													<div><b><a href="<?php echo site_url('/customer/opportunities/detail/'.$item['id'])?>"><?php echo $item['title']; ?></a></b></div>
													<div><?php echo $item['start_date']; ?> ~ <?php echo $item['end_date']; ?></div>
													</td>
													<td id="gv-field-5-11" class="gv-field-5-11" data-label="Image">
													<?php if($item['thumbnail']):?>
													<img src="<?php echo base_url().$item['thumbnail']; ?>" width="100" height="100"/>
													<?php endif;?>
													</td>
													<td id="gv-field-5-8" class="gv-field-5-8" data-label="Company"><?php echo $item['company']; ?></td>
													<td id="gv-field-5-8" class="gv-field-5-8" data-label="Description"><?php echo $item['details']; ?></td>
													<td id="gv-field-5-8" class="gv-field-5-8" ><a href="<?php echo site_url('postbid/edit/'.$item['id'].'/'.$hash)?>">Edit</a></td>

												</tr>
												<?php }
												}else{
													?>
													<tr><td colspan="8">
															No item.
														</td></tr>
													<?php
												}?>
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

                    <div class="mb-3 text-center">

                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>

 