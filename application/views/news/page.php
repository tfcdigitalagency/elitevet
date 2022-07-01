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
		<div class="mb-3">
			<h1 class="mb-0 font-weight-semibold" style="color:black">
				<?php echo ($article)?$article['article_title']:'Article is not found.';?>
			</h1>
			<div style="color: #999; font-size: 12px">Published: <?php echo date('d/m/Y h:s A')?></div>
		</div>
	<div class="faqWrap">
		<div class="row">
			<div class="col-md-6"><?php echo @$article['detail'];?></div>
			<div class="col-md-6 text-center"><img src="<?php echo base_url().$article['photo']?>" style="max-width: 100%;" /></div>

		</div>
		<h3 class="mt-5">Others Article</h3>
		<ul>
		<?php
			foreach ($orthers as $item){
				?><li><a href="<?php echo base_url('news/article/'.$item['slug'])?>"><?php echo $item['article_title']?></a></li><?php
			}
		?>
		</ul>
	</div>
	</div>
 </div>

</div>

