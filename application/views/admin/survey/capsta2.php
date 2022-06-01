<style type="text/css">
	.question-item{
		margin-top: 5px;
	}
</style>
<div class="card">
	<div class="card-body">
		<div>
			<table width="100%" border="0">
				<tr>
					<td>
						<img src="<?php echo base_url()?>/assets/logo.png">
					</td>
					<td style="padding-left: 30px;">
						<h2>Elite Service Disabled Veteran Owned Business Network</h2>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellpadding="3" style="font-size: 16px; color: #fff; background: #0a6ebd">
				<tr>
					<td style="padding-left: 20px">
						Capability statement
					</td>
					<td style="text-align: right; padding-right: 20px;">
						www.ncdeliteveterans.org
					</td>
				</tr>
			</table>
		</div>
		<div class="text-center" style="font-size: 18px;">
			<?php if($result->user_id){
				$user= get_user($result->user_id);
				?>
				<p><b>Name:</b> <?php echo $user->name ?><br>
					<?php if($user->company):?><b>Company:</b> <?php echo $user->company ?><br><?php endif;?>
					<?php echo ($user->membership)?'<b>Member:</b> '.$user->membership->name.'<br/>':'<b>Member:</b> non-member'.'<br/>'; ?>
					<b>Email:</b> <?php echo $user->email ?><br>
					<?php if($user->title):?><b>Type:</b> <?php echo $user->title ?><br><?php endif;?>
					<?php if($user->phone):?><b>Phone:</b> <?php echo $user->phone ?><br><?php endif;?>
					<b>Completed:</b> <?php echo $result->created_at?>
				</p>
			<?php }else{
				?>
				<p><b>Name:</b><?php echo $result->uname; ?></p><br>
				<b></b>Email:</b><?php echo $result->email; ?><br>
				<b>Completed:</b> <?php echo $result->created_at?>
				</p>
				<?php
			}?>

		</div>
		<hr/>
		<div class="col-md-12">
			<?php foreach($survey as $k=>$item){?>
				<div class="mt-3 question-item questype_<?php echo $item->type;?>">
					<div style="font-weight:bold; font-size: 1.2em"><?php echo ($k+1)?>. <?php echo $item->question;?></div>
					<div class="mt-3">
						<?php
						$choise = json_decode($item->content);
						$detail = json_decode($item->detail);
						switch($item->type){
							case 1:
								foreach($choise as $c){
									?>
									<div>
										<?php $img = (in_array($c,$detail->answer))? 'check.png':'uncheck.png';?><img width="25" src="<?php echo base_url()?>/assets/<?php echo $img?>"><label><?php echo $c?></label>
									</div>
									<?php
								}
								break;
							case 2:
								foreach($choise as $c){
									?>
									<div>
										<?php $img = (in_array($c,$detail->answer))? 'check.png':'uncheck.png';?><img width="25" src="<?php echo base_url()?>/assets/<?php echo $img?>"><label><?php echo $c?></label>
									</div>
									<?php
								}
								break;
							case 3:
								foreach($choise as $idx=>$c){
									?>
									<div class="mb-2 rate_choise"><div><?php echo $c?>:</div>
										<?php
										for($i=1;$i<=10;$i++){
											?>
											<?php $img = ($i == $detail->answer[$idx])? 'check.png':'uncheck.png';?><img width="25" src="<?php echo base_url()?>/assets/<?php echo $img?>"><label><?php echo $i?></label>
											<?php
										}
										?>
									</div>
									<?php
								}
								break;
						}?>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>
