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
     NEWS
    </h1>
  </div>

<div class="card">
    <div >
	<div class="faqWrap">
		<?php foreach ($articles as $item):?>
		<div class="card-body">
			<h2><a href="<?php echo base_url('news/article/'.$item['slug'])?>"><?php echo $item['article_title']?></a></h2>
			<div class="row">
				<div class="col-md-2 col-sm-3 col-4">
					<img src="<?php echo base_url().$item['photo']?>" style="max-width: 100%; max-height: 250px; border: 1px solid #f1f1f1;"/>
				</div>
				<div class="col-md-10 col-sm-9 col-8">
					<?php echo $item['short'] ?>
					<div><a href="<?php echo base_url('news/article/'.$item['slug'])?>">View more</a></div>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	</div>
 </div>

</div>

