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

	.border{
		border: 1px solid #000;
		padding: 10px;
	}
	ul{
		margin: 0;
		padding: 0 0 0 20px;
	}
	.head{background: lightyellow}
	.questions{margin-bottom: 20px;}
	.table_detail{ margin-top: 10px;}
</style>
<div style="text-align: center">
	<h1 style="margin-bottom: 0px; font-size: 24px;">Survey Report</h1>
	<div style="margin-bottom: 30px;">(Total <?php echo $total_members;?> members)</div>
</div>
<div>
	<?php foreach ($questions as $k=>$question){
		//print_r($question);
		if(in_array($k,array(7))){
			echo '<div style="page-break-before: always; page-break-after: always;"></div>';
		}
		?>
		<div class="questions" style="text-align: center">
			<div class="title"><?php echo ($k+1).". ".$question->question?></div>
			<div>
				 <?php echo $question->chart;?>
			</div>
			<div class="table_detail" style="max-width: 600px; margin: auto">
				<table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="3" cellspacing="0">
					<tr class="head"><th width="50%">Answer Choices</th><th width="50%">Responses</th></tr>
					<?php foreach ($question->statistic as $k=>$v){?>
						<tr>
							<td><?php echo $k?></td>
							<td><?php echo $v?><?php echo ($question->type == 3)?'':'%'?></td>
						</tr>
					<?php }?>
				</table>
			</div>
		</div>
	<?php }?>
</div>

<div style="text-align: center; margin-top: 10px; font-weight: bold; width: 100%; position: fixed; bottom: 0px;">

</div>
