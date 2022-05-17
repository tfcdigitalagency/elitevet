<?php

?>
  <style>


.wrapper{
  width:  1500px;
  margin:  auto;
  max-width: 100%;
}

label{
	cursor:pointer;
	margin-right:15px;
}

</style>
<div class="content wrapper">



<div class="card">
    <div class="card-body">
	<div class="faqWrap">
		<div class="mb-3 text-center">
			<h1 class="mb-0 font-weight-semibold">
				Nor-Cal Elite Disable Veterans Needs Questionnaire
			</h1>
			<hr/>
			<div class="text-center" style="font-size: 18px;">
				<?php if($user){
					$user= get_user($user->id);
					?>
					<p><b>Name:</b> <?php echo $user->name ?><br>
						<?php if($user->company):?><b>Company:</b> <?php echo $user->company ?><br><?php endif;?>
						<?php echo ($user->membership)?'<b>Member:</b> '.$user->membership->name.'<br/>':'<b>Member:</b> non-member'.'<br/>'; ?>
						<b>Email:</b> <?php echo $user->email ?><br>
						<?php if($user->title):?><b>Type:</b> <?php echo $user->title ?><br><?php endif;?>
						<?php if($user->phone):?><b>Phone:</b> <?php echo $user->phone ?><br><?php endif;?>
					</p>
				<?php }else{
					?>

					<?php
				}?>
			</div>
		</div>

	<div class="mt-3">
		<?php
		$error = $this->session->flashdata('error');
		if($error){?>
		<div style="color:red">
			<?php echo $error;?>
		</div>
		<?php }?>
		<?php if($didSurvey){?>
		<div style="color:blue" class="text-center">
			Thanks, you already sent survey.
		</div>
		<?php }?>
		<hr/>
		<?php if($didSurvey){?>
			<?php foreach($survey as $k=>$item){?>
				<div class="mt-3 question-item questype_<?php echo $item->type;?>">
					<div style="font-weight:bold"><?php echo ($k+1)?>. <?php echo $item->question;?></div>
					<div class="mt-3">
						<?php
						 $choise = json_decode($item->content);
						 $detail = json_decode($item->detail);
						 switch($item->type){
							case 1:
								foreach($choise as $c){
								?>
								<div>
									<label><input disabled type="radio" <?php if(in_array($c,$detail->answer)) echo 'checked';?> name="question[<?php echo $item->id?>][answer][]" value="<?php echo $c?>"> <?php echo $c?></label>
								</div>
								<?php
								}
							break;
							case 2:
								foreach($choise as $c){
								?>
								<div>
									<label><input disabled type="checkbox" <?php if(in_array($c,$detail->answer)) echo 'checked';?> name="question[<?php echo $item->id?>][answer][]" value="<?php echo $c?>"> <?php echo $c?></label>
								</div>
								<?php
								}
							break;
							case 3:
								foreach($choise as $idx=>$c){
								?>
								<div class="mb-2 rate_choise"><div><?php echo $c?>:</div>
									<label><input disabled type="radio" name="question[<?php echo $item->id?>][answer][<?php echo $idx?>]" value="N/A"> N/A</label>
								<?php
								for($i=1;$i<=10;$i++){
								?>
								<label><input disabled type="radio" <?php if($i == $detail->answer[$idx]) echo 'checked';?> name="question[<?php echo $item->id?>][answer][<?php echo $idx?>]" value="<?php echo $i?>"> <?php echo $i?></label>
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
		<?php }else{?>



			<form method="post" onsubmit="return validate();" action="<?php echo site_url('/survey/?hash='.$_GET['hash']);?>">
				<input type="hidden" name="user_id" value="<?php echo $user->id;?>"/>
				<?php foreach($survey as $k=>$item){?>
				<div class="mt-3 question-item questype_<?php echo $item->type;?>">
					<div style="font-weight:bold"><?php echo ($k+1)?>. <?php echo $item->question;?></div>
					<div class="mt-3">
						<?php
						 $choise = json_decode($item->content);
						 switch($item->type){
							case 1:
								foreach($choise as $c){
								?>
								<div>
									<label><input type="radio" name="question[<?php echo $item->id?>][answer][]" value="<?php echo $c?>"> <?php echo $c?></label>
								</div>
								<?php
								}
							break;
							case 2:
								foreach($choise as $c){
								?>
								<div>
									<label><input type="checkbox" name="question[<?php echo $item->id?>][answer][]" value="<?php echo $c?>"> <?php echo $c?></label>
								</div>
								<?php
								}
							break;
							case 3:
								foreach($choise as $idx=>$c){
								?>
								<div class="mb-2 rate_choise"><div><?php echo $c?>:</div>
									<label><input type="radio" name="question[<?php echo $item->id?>][answer][<?php echo $idx?>]" value="N/A"> N/A</label>
								<?php
								for($i=1;$i<=10;$i++){
								?>
								<label><input type="radio" name="question[<?php echo $item->id?>][answer][<?php echo $idx?>]" value="<?php echo $i?>"> <?php echo $i?></label>
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

				<div class="mt-3">
					<input type="submit" value="Submit" name="submit" class="btn btn-primary">
					<div id="error" style="color:red;margin-top:5px;"></div>
				</div>
			</form>
		<?php }?>
	</div>

	</div>
	</div>
 </div>

  <div class="mb-3">
    <h1 class="mb-0 font-weight-semibold" style="color:red">
      EliteNCDVeterans

    </h1>
  </div>

</div>

<script>
	function validate(){
		var ok = true;
		$('#error').html("");
		$('.question-item').each(function(){
			if($(this).find(':checked').length <1){
				ok = false;
			}
		});
		$('.rate_choise').each(function(){
			if($(this).find(':checked').length <1){
				ok = false;
			}
		});
		if(!ok){
			$('#error').html("Please answer all question.");
		}
		return ok;
	}
</script>
