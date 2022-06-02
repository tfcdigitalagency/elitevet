<style type="text/css">
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
		padding-left: 50px;
	}
	.left .arrow{
		background-image: url("<?php echo base_url()?>assets/capsta/left_arrow.jpg?v=1");
		background-repeat: no-repeat;
		background-position: top left;
		padding-left: 50px;
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

<div class="card">
	<div class="card-body">
		<?php $user= get_user($result->user_id);
 		$company_name =  $user->company;
		?>
		<div style="text-align: center">
		<h1 style="margin: 0; font-size: 24px;">Capability Statement</h1>
		<div style="font-size:24px"><b>Company:</b> <?php echo $company_name ?></div>
			<div style="margin-top: 5px"><img width="400" src="<?php echo base_url()?>/assets/capsta/Cap_Sta_14.jpg"></div>
			<div style="margin-top: 5px"><img width="180" src="<?php echo base_url()?>/assets/capsta/Disable_Vet.jpg"></div>
		</div>

		<div style="margin-top: 10px">
			<table width="100%" style="font-size: 13px;">
				<tr>
					<td width="45%" style="vertical-align: top">
						<div class="box left">
							<div class="title arrow">CORPORATE PROFILE</div>
							<div class="content">
								<?php echo $company_name;?>, is an <?php echo getSelected($survey[3])?> <?php echo getSelected($survey[0])?> owned company  Our company is an entrepreneurial business where we assess client’s needs finding products or services that are beneficial to their everyday life.
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
								<img width="100%" src="<?php echo base_url()?>/assets/capsta/Cap_Sta_15.jpg">
							</div>
						</div>
						<div class="box">
							<div class="title">CONTACT</div>
							<div class="content">
								<p><b>Name:</b> <?php echo $user->name ?><br>
									<b>Company:</b> <?php echo $user->company ?><br>
									<?php echo ($user->membership)?'<b>Member:</b> '.$user->membership->name.'<br/>':'<b>Member:</b> non-member'.'<br/>'; ?>
									<b>Email:</b> <?php echo $user->email ?><br>
									<b>Phone:</b> <?php echo $user->phone_number ?><br>
								</p>
							</div>
						</div>

					</td>
					<td width="30" align="center" valign="middle" style="padding-top: 30px; vertical-align: center;">
						<img src="<?php echo base_url()?>/assets/capsta/split.jpg">
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
												By become a member of a of supplier diversity group, It will build disable veteran business community and help fellow veteran business owners with resources, training and connecting with corporations and government agencies.
											</div>

										</td>
										<td width="30%">
											<img width="100%" src="<?php echo base_url()?>/assets/capsta/img3.jpg">
										</td>
									</tr>
								</table>
							</div>
							</div>
						</div>

					</td>
				</tr>
			</table>
		</div>
		<div style="text-align: center; margin-top: 10px; font-weight: bold; width: 100%; position: fixed; bottom: 10px;">
			<?php echo $user->name ?> - <?php echo $user->phone_number ?> - <?php echo $user->email ?>
		</div>
	</div>
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
