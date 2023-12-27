<style>
 
#timeline {
  display: flex;
  background-color: #031625;
}
#timeline:hover .tl-item {
  width: 23.3333%;
}

.btn_view{display:inline-block;cursor:pointer; padding:8px 40px; border-radius:5px; margin:15px; color:#fff; background-color:#ff0000;}

.tl-item {
  transform: translate3d(0, 0, 0);
  position: relative;
  width: 25%;
  height: 100vh;
  min-height: 600px;
  color: #fff;
  overflow: hidden;
  transition: width 0.5s ease;
}
.tl-item:before, .tl-item:after {
  transform: translate3d(0, 0, 0);
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}
.tl-item:after {
  background: rgba(3, 22, 37, 0.85);
  opacity: 1;
  transition: opacity 0.5s ease;
}
.tl-item:before {
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 75%);
  z-index: 1;
  opacity: 0;
  transform: translate3d(0, 0, 0) translateY(50%);
  transition: opacity 0.5s ease, transform 0.5s ease;
}
.tl-item:hover {
  width: 30% !important;
}
.tl-item:hover:after {
  opacity: 0;
}
.tl-item:hover:before {
  opacity: 1;
  transform: translate3d(0, 0, 0) translateY(0);
  transition: opacity 1s ease, transform 1s ease 0.25s;
}
.tl-item:hover .tl-content {
  opacity: 1;
  transform: translateY(0);
  transition: all 0.75s ease 0.5s;
}
.tl-item:hover .tl-bg {
  filter: grayscale(0);
}
.tl-content {
  transform: translate3d(0, 0, 0) translateY(25px);
  position: relative;
  z-index: 1;
  text-align: center;
  margin: 0 1.618em;
  top: 55%;
  opacity: 0;
}
.tl-content h1 {
  font-family: 'Pathway Gothic One', Helvetica Neue, Helvetica, Arial, sans-serif;
  text-transform: uppercase;
  color: #1779cf;
  font-size: 1.44rem;
  font-weight: normal;
}
.tl-year {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translateX(-50%) translateY(-50%);
  z-index: 1;
   
}
.tl-year p {
  font-family: 'Pathway Gothic One', Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 1.728rem;
  line-height: 0;
}
.tl-bg {
  transform: translate3d(0, 0, 0);
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-size: cover;
  background-position: center center;
  transition: filter 0.5s ease;
  filter: grayscale(100%);
}

.swiper-container {
  width: 100%;
  padding-top: 50px;
  padding-bottom: 50px;
}

img {
  display: block;
  max-width: 100%;
}

.swiper-wrapper {
  padding-left: initial;
  margin: 0;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;
  width: 500px;
  height: 300px; 
  display: flex;
  align-items: center;
  padding:10px;
} 

</style>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10"
     data-elementor-settings="[]">
    <div class="elementor-inner">
	 <div id="timeline_gallery">
       <section id="timeline">
	  
	  <?php foreach($gallery as $item){?>
	  <div class="tl-item">
	  
		<?php 
			if($item['images']){
				$images = json_decode($item['images'],true);
			}
		?>
		
		<div class="tl-bg" style="background-image: url(<?php echo base_url().$images[0];?>)"></div>
		
		<div class="tl-year">
		  <p class="f2 heading--sanSerif"><?php echo $item['year']?></p>
		</div>

		<div class="tl-content">
		  <h1><?php echo $item['title']?></h1>
		  <div style="text-align:center"><a data-id="<?php echo $item['id']?>" class="btn_view">View Detail</a></div>
		  <p><?php echo $item['content']?></p>
		</div>	

	  </div>
	  <?php }?>
		
</section>
 </div>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/css/swiper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.x.x/js/swiper.min.js"></script>
<?php foreach($gallery as $item){?>
 <div style="display:none;" class="timeline_content" id="timeline_content_<?php echo $item['id']?>">
	<div class="container">
	<?php
		$images = json_decode($item['images'],true);
		//print_r($images);
	?>
	<!-- Swiper -->
	<br><br>
	<table width="100%"><tr><td>
	<h2><?php echo $item['title'];?></h2>
	<div style="color:#777"><?php echo $item['year'];?></div>
	<p><?php echo $item['content'];?></p>
	</td><td style="text-align:right;"><a id="btn_back"class="btn btn-lg btn-primary" style="color:#fff">Back</a></td></table>
<div class="swiper-container">
    <ul class="swiper-wrapper">
     <?php foreach($images as $img){?>
	 <li class="swiper-slide">
          <a href="<?php echo base_url().$img?>" data-lightbox="image-<?php echo $item['id'];?>"><img src="<?php echo base_url().$img?>" /></a>
      </li>
<?php }?>  
    </ul>
    
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
</div>
 </div>
 <?php }?>
  </div>
  </div> 
 <script>
	$(document).on("click",".btn_view", function(){
		var id = $(this).data("id");
		$('#timeline_gallery').hide();
		$('#timeline_content_'+id).show();
	});
	$(document).on("click","#btn_back", function(){
	 
		$('#timeline_gallery').show();
		$('.timeline_content').hide();
	});
	$(document).ready(function(){
		lightbox.option({
		  'resizeDuration': 200,
		  'wrapAround': true
		})
	
		var Swipes = new Swiper('.swiper-container', {
				loop: false,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.swiper-pagination',
				},
			});
		}
    );
 </script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>