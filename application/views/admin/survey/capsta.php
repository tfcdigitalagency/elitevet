<style type="text/css">
	@page { margin: 15px 30px; }
	body { margin: 0px; }
	.question-item{
		margin-top: 5px;
	}
	.box{
		margin-bottom: 10px;
	}
	.title{
		font-size: 16px;
		font-weight: bold;
		/*background: #0a6ebd;
		color: #fff;*/
		padding: 5px 10px;
		border-radius: 10px;
		min-height: 25px;
	}
	.left .content{
		padding-left: 40px;
	}
	.left .arrow{
		background-image: url("<?php echo base_url()?>assets/capsta/left_arrow.jpg?v=1");
		background-repeat: no-repeat;
		background-position: top left;
		padding-left: 40px;
	}
	.right .arrow{
		background-image: url("<?php echo base_url()?>assets/capsta/right_arrow.jpg?v=1");
		background-repeat: no-repeat;
		background-position: top right;
		padding-right: 40px;
	}
	.right .content{
		padding-right: 60px;
		padding-left: 10px;
	}
	.border{
		border: 1px solid #000;
		padding: 10px;
	}
	ul{
		margin: 0;
		padding: 0 0 0 20px;
	}
</style>
<?php
	if($company_type){
		if($company_type['image1']){
			$image1 = $company_type['image1'];
		}else{
			$image1 = 'assets/capsta/Cap_Sta_14.jpg?t='.time();
		}
		if($company_type['image2']){
			$image2 = $company_type['image2'];
		}else{
			$image2 = 'assets/capsta/Cap_Sta_15.jpg?t='.time();
		}
		if($company_type['image2']){
			$image3 = $company_type['image3'];
		}else{
			$image3 = 'assets/capsta/img3.jpg';
		}
	}else{
		$image1 = 'assets/capsta/Cap_Sta_14.jpg?t='.time();
		$image2 = 'assets/capsta/Cap_Sta_15.jpg';
		$image3 = 'assets/capsta/img3.jpg';
	}
?>
<table class="card">
	<tr>
	<td class="card-body">
		<?php $user= get_user($result->user_id);
 		$company_name =  $user->company;
		?>
		<div style="text-align: center">
		<h1 style="margin: 0; font-size: 24px;">Capability Statement</h1>
		<div style="font-size:24px"><b>Company:</b> <?php echo $company_name ?></div>
			<div style="margin-top: 5px"><img width="380" src="<?php echo base_url().$image1?>"></div>			 
		</div>
	</td>
	</tr>
	<tr><td>
			<table style="width: 100%;">
				<tr><td valign="middle" style="vertical-align: middle;">
						<table border="0" width="100%" style="font-size: 13px;">
							<tr>
								<td style="width:350px;vertical-align: top">
									<div class="box left">
										<div class="title arrow">CORPORATE PROFILE</div>
										<div class="content">
											<?php echo $company_name;?>, is an <?php echo getSelected($survey[3])?> owned company. <?php echo getSelected($survey[0])?> our company is an entrepreneurial business where we assess client’s needs finding products or services that are beneficial to their everyday life.
										</div>
									</div>
									<div class="box left">
										<div class="title arrow"><?php echo $company_name;?> has been in business for</div>
										<div class="content">
											<?php echo getSelected($survey[2])?> years
										</div>
									</div>
									<div class="box left">
										<div class="title arrow">Type of company</div>
										<div class="content">
											<?php echo getSelected($survey[3])?>
										</div>
									</div>
									<div class="box left">
										<div class="title arrow">Employees at <?php echo $company_name;?> between</div>
										<div class="content">
											<?php echo getSelected($survey[4])?>
										</div>
										<div style="margin-top: 5px">
											<img width="330" height="140" src="<?php echo base_url().$image2?>">
										</div>
									</div>
								</td>
								<td width="30" align="center" valign="middle" style="padding-top: 30px; vertical-align: center;">
									<img height="480" width="20" src="<?php echo base_url()?>/assets/capsta/split.jpg">
								</td>
								<td width="45%" style="vertical-align: top">
									<div class="box right">
										<div class="title arrow">MARKET PROFILE</div>
										<div class="content">
											<?php echo $company_name;?> market?
											<div><?php echo getSelected($survey[5])?></div>
										</div>
									</div>
									<div class="box right">
										<div class="title arrow">  Contract Bids <?php echo $company_name;?>

										</div>
										<div class="content">
											prepared to receive between <?php echo getSelected($survey[7])?>
										</div>
									</div>
									<div class="box right">
										<div class="title arrow">In what sector do you work? </div>
										<div class="content">
											<?php echo getSelected($survey[9])?>
										</div>
									</div>
									<div class="box">
										<div class="title">Serving Clients needs <?php echo $company_name;?> could not do it along!</div>
										<div class="content">

										</div>
									</div>

									<div class="box">
										<div class="content">
											<div class="border">
												<table width="100%">
													<tr>
														<td width="70%" style="vertical-align: top">
															<div>Are you a member of supplier diversity?
																<?php echo getSelected($survey[14])?></div>
															<div>
																By becoming a member of a of supplier diversity group, It will build disable veteran business community and help fellow veteran business owners with resources, training and connecting with corporations and government agencies.
															</div>

														</td>
														<td width="30%" style="text-align:right;">
															<img height="90" width="60" src="<?php echo base_url().$image3?>">
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</td>
								</tr>
								<tr>
								<td style="vertical-align: top;text-align:center; padding-top:10px">
									<div style="padding:10px; border:1px solid #000; border-top:2px solid #000;">
									<b style="font-size:16px;">CERTIFICATIONS</b>
									<div style="height:60px;"></div>
									</div>
								</td>
								<td></td>
								<td style="vertical-align: top;text-align:center; padding-top:10px">
									<div style="padding:10px; border:1px solid #000; border-top:2px solid #000;">
									<b style="font-size:16px;">COMPANY INFORMATION</b>
									<div style="height:60px;"></div>
									</div>									
								</td>
							</tr>
						</table>
					</td></tr>
			</table>
		</td></tr>
</table>
<div class="box"> 
										<div class="content">
											<p><b>Name:</b> <?php echo $user->name ?><br>
												<b>Company:</b> <?php echo $user->company ?><br>
												<?php echo ($user->membership)?'<b>Member:</b> '.$user->membership->name.'<br/>':'<b>Member:</b> non-member'.'<br/>'; ?>
												<b>Email:</b> <?php echo $user->email ?><br>
												<b>Phone:</b> <?php echo $user->phone_number ?><br>
											</p>
										</div>
									</div>
<div style="text-align: center; margin-top: 10px; font-weight: bold; width: 100%; position: fixed; bottom: 0px;">
	<?php echo $user->name ?> - <?php echo $user->phone_number ?> - <?php echo $user->email ?>
</div>
<?php
function getSelected($item){
	$choise = json_decode($item->content);
	$detail = json_decode($item->detail);

	switch($item->type){
		case 1:
			foreach($choise as $c){
				if(in_array($c,$detail->answer)) return $c;
			}
			break;
		case 2:
			$html="<ul>";
			foreach($choise as $c){
				if(in_array($c,$detail->answer)) $html.= "<li>".$c."</li>";
			}
			$html.="</ul>";
			return  $html;
			break;
	}
}
?>
