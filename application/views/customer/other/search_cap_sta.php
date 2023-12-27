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

                    </div>
					
					<?php if(check_sponsor()){?>
					
                    <div style="">
                    	 <h2 class="text-center mb-3" style="font-size:3em; font-weight:bold;color:#000;">Search Cap-Sta</h3>
						 <form action="<?php echo site_url('customer/other/search_cap_sta');?>" class="form-validate-jquery" method="GET">
						 <div class="row">
						 <div class="col-md-3"></div>
						 <div class="col-md-5">
							<select id="q" name="q" style="width:100%; height:35px; line-height:35px;">
								<option>Select Type</option>
								<?php foreach($company_type as $c){?>
								<option value="<?php echo $c['title']?>" <?php echo $_GET['q'] == $c['title']?'selected':''?>><?php echo $c['title']?></option>
								<?php }?>
							</select>
							<!--input type="text" class="form-control" id="q" name="q" value="<?php echo $_GET['q']?>" placeholder="Keyword" required-->
						 </div>
						 <div class="col-md-2">
						 <button type="submit" class="btn btn-primary"> Search </button>
						 </div>
						 </div>
						 </form>
                    
                    <!-- /layout 1 -->
                   	
                    <p style="height: 30px;"></p>
                    <div id="result" style="min-height:400px;" class="mb-3"> 
							<?php if(!empty($results)){
								$config_data = get_config_content('CAPSTA');
								?>
								<strong style="color:blue;">Found <?php echo count($results)?> items with the keyword "<?php echo $q;?>".</strong>
								<div style="color:red;">Notice:Only <?php echo implode(', ',$config_data->candownload)?> member accounts can download files.</div>
								<div class="gv-table-view gv-table-container gv-table-multiple-container gv-container gv-container-5724">
											<table class="gv-table-view" width="100%">
												<thead>
												<tr style="background-color:#F2A900">
													<th width="30%" id="gv-field-5-1" class="gv-field-5-1" data-label="Name">
													<span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Name</span>
													</th>
													<th id="gv-field-5-11" class="gv-field-5-11" data-label="Email">
													<span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Email</span>
													</th>
													<th width="160" style="text-align:center" id="gv-field-5-8" class="gv-field-5-8" data-label="Deadline Date">
													<span class="gv-field-label"><a class="gv-sort gv-icon-caret-up-down"></a>&nbsp;Download</span>
													</th>

												</tr>
												</thead>
												<tbody>
								<?php
								foreach($results as $row){
									?><tr><td><?php echo $row['name'];?></td><td><?php echo $row['email'];?></td>
									<td style="text-align:center">
									<?php echo ($is_download)?anchor(base_url().'assets/capsta/'.$row['file'],'Download','class="btn btn-primary text-white"'):anchor(site_url('/customer/other/benefit#select_package'),'Upgrade Membership','class="btn btn-primary text-white"');?>
									</td></tr>
									<?php
								}
								?>
								</tfoot>
											</table>
										</div>
								<?php
							}else{
								if(!$q){?>
							<h3 style="text-align:center;"> Please input keyword to search</h3>
							<?php 
								}else{
									?>
									<h3 style="text-align:center;color:red"> No result found with the keyword "<?php echo $q;?>"</h3>
									<?php
								}
							}?>
                    </div>
 <p style="height: 30px;"></p>
                </div>
                <!-- /content area -->
					<?php }else{
						?>
						<h3 style="margin-top:150px; margin-bottom:150px;">Sorry, You are not a Sponsor so you haven't permission to view content, to become a sponsor <a href="<?php echo site_url('/customer/other/benefit#select_package')?>">click here</a>
						</h3>
						<?php
					}?>
            </div>
        </div>
    </div>
</div>
 