<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
	.action a{
		cursor:pointer;
	}
</style>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Survey result </span></h4>
			<a style="margin-left:40px;" href="<?php echo site_url('admin/survey/capsta?id='.$result->id);?>" class="btn btn-primary">Create cap-sta </a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic modals -->
    <div class="card">
        <div class="card-body">
			<h1 class="mb-0 font-weight-semibold text-center">
				Nor-Cal Elite Disable Veterans Needs Questionnaire
			</h1>
			<hr/>
			<div class="text-center" style="font-size: 18px;">
				<?php if($result->user_id){
				$user= get_user($result->user_id);
				?>
					<p><b>Name:</b> <?php echo $user->name ?><br>
					<?php if($user->company):?><b>Company:</b> <?php echo $user->company ?><br><?php endif;?>
					<?php echo ($user->membership)?'<b>Member:</b> '.$user->membership->name.'<br/>':'<b>Member:</b> non-member'.'<br/>'; ?>
						<b>Email:</b> <?php echo $user->email ?><br>
						<?php if($user->title):?><b>Type:</b> <?php echo $user->title ?><br><?php endif;?>
					<?php if($user->phone_number):?><b>Phone:</b> <?php echo $user->phone_number ?><br><?php endif;?>
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
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->
