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
            <h4><span class="font-weight-semibold">Survey result

</span></h4> 
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
					<div class="col-md-1">Name</div>
					<div class="col-md-8"><b><?php echo $result->name?></b></div>
				</div>
				<div class="row">
					<div class="col-md-1">Email</div>
					<div class="col-md-8"><b><?php echo $result->email?></b></div>
				</div>
				<div class="row">
					<div class="col-md-1">Phone</div>
					<div class="col-md-8"><b><?php echo $result->phone_number?></b></div>
				</div>
				<?php if($result->company){?>
				<div class="row">
					<div class="col-md-1">Company</div>
					<div class="col-md-8"><b><?php echo $result->company?></b></div>
				</div>
				<?php }?>
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
  