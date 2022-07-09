<h2 style="text-align: center; margin-bottom: 20pxfont-size: 18px; font-weight: bold">
	<a href="<?php echo site_url('news/article/'.$item['slug'].'?clicked=1')?>"><?php echo $item['article_title']?></a>
</h2>
<div style="text-align: center; ">
<?php if($item['photo']):?>
	<img src="<?php echo base_url().$item['photo']?>" style="max-width: 100%; max-height: 250px; border: 1px solid #f1f1f1;"/>
<?php endif;?>
</div>
<div>
	<?php echo $item['short']?>
</div>
<div style="text-align: center; margin-top: 30px">
	<a href="<?php echo site_url('news/article/'.$item['slug'])?>" style="display: inline-block; padding: 5px 20px; background: #0a6ebd; color: #fff; border-radius: 10px;">View More</a>
</div>
