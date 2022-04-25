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

  <div class="mb-3">
    <h1 class="mb-0 font-weight-semibold" style="color:red">
      EliteNCDVeterans	   
    </h1> 
  </div>
 
<div class="card">
    <div class="card-body">
	<div class="faqWrap">
	<h3>Survey</h3> 
	
	<div class="mt-3">
		<?php 
		$error = $this->session->flashdata('error');
		if($error){?>
		<div style="color:red">		
			<?php echo $error;?>
		</div>		
		<?php }?>
		<?php if($didSurvey){?>
		<div style="color:blue">		
			Thanks, you already sent survey.
		</div>		
		<?php }?>
		
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
		
		
		
			<form method="post" onsubmit="return validate();" action="<?php echo site_url('/customer/home/survey');?>">
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
