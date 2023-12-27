
<style>
	@charset "UTF-8";
	@import url(https://fonts.googleapis.com/css?family=Lato:700);
	.titlePack{
		font-weight: bold;
	}
	.btn_register{
		max-width:300px;
		margin: auto;
	}
	.option_flex{
		display: flex;
	}
	.note{
		font-size: 0.8em;
		color: #999;
	}
	.wrapper-card {
		display: flex;
		flex-wrap: nowrap;
		margin: 40px auto;
		width: 77%;
	}

	.card {
		background: #fff;
		border-radius: 3px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0);
		flex: 1;
		margin: 8px;
		padding: 30px;
		position: relative;
		text-align: center;
		transition: all 0.5s ease-in-out;
	}
	.card.popular {
		margin-top: -10px;
		margin-bottom: -10px;
	}
	.card.popular .card-title h3 {
		color: #3498db;
		font-size: 22px;
	}
	.card.popular .card-price {
		margin: 30px;
	}
	.card.popular .card-price h1 {
		color: #3498db;
		font-size: 60px;
	}
	.card.popular .card-action button {
		background-color: #3498db;
		border-radius: 80px;
		color: #fff;
		font-size: 17px;
		margin-top: -5px;
		padding: 15px;
		height: 60px;
	}
	.card.popular .card-action button:hover {
		background-color: #2386c8;
		font-size: 23px;
	}
	.card:hover {
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
	}

	.card-ribbon {
		position: absolute;
		overflow: hidden;
		top: -10px;
		left: -10px;
		width: 114px;
		height: 112px;
	}
	.card-ribbon span {
		position: absolute;
		display: block;
		width: 160px;
		padding: 10px 0;
		background-color: #3498db;
		box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
		color: #fff;
		font-size: 13px;
		text-transform: uppercase;
		text-align: center;
		left: -35px;
		top: 25px;
		transform: rotate(-45deg);
	}
	.card-ribbon::before, .card-ribbon::after {
		position: absolute;
		z-index: -1;
		content: "";
		display: block;
		border: 5px solid #2980b9;
		border-top-color: transparent;
		border-left-color: transparent;
	}
	.card-ribbon::before {
		top: 0;
		right: 0;
	}
	.card-ribbon::after {
		bottom: 0;
		left: 0;
	}

	.card-title h3 {
		color: rgba(0, 0, 0, 0.3);
		font-size: 20px;
		text-transform: uppercase;
	}
	.card-title h4 {
		color: rgba(0, 0, 0, 0.6);
	}

	.card-price {
		margin: 20px 0;
	}
	.card-price h1 {
		font-size: 46px;
	}
	.card-price h1 sup {
		font-size: 15px;
		display: inline-block;
		margin-left: -20px;
		width: 10px;
	}
	.card-price h1 small {
		color: rgba(0, 0, 0, 0.3);
		display: block;
		font-size: 11px;
		text-transform: uppercase;
	}

	.card-description ul {
		display: block;
		list-style: none;
		margin: 10px 0;
		padding: 0;
	}
	.card-description li {
		color: rgba(0, 0, 0, 0.6);
		font-size: 15px;
		margin: 0 0 15px;
	}
	.option_label{ font-weight: bold }
	.card-description li div.option_label::before {
		content: "✔";
		padding: 0 5px 0 0;
		color: green;
	}

	.card-action button {
		background: transparent;
		border: 2px solid #3498db;
		border-radius: 30px;
		color: #3498db;
		cursor: pointer;
		display: block;
		font-size: 15px;
		font-weight: bold;
		padding: 10px;
		width: 100%;
		text-transform: uppercase;
		transition: all 0.3s ease-in-out;
	}
	.card-action button:hover {
		background-color: #3498db;
		box-shadow: 0 2px 4px #196090;
		color: #fff;
		font-size: 17px;
	}
	.toggler-wrapper {
		display: block;
		width: 45px;
		height: 25px;
		cursor: pointer;
		position: relative;
	}

	.toggler-wrapper input[type="checkbox"] {
		display: none;
	}

	.toggler-wrapper input[type="checkbox"]:checked+.toggler-slider {
		background-color: #44cc66;
	}

	.toggler-wrapper .toggler-slider {
		background-color: #ccc;
		position: absolute;
		border-radius: 100px;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		-webkit-transition: all 300ms ease;
		transition: all 300ms ease;
	}

	.toggler-wrapper .toggler-knob {
		position: absolute;
		-webkit-transition: all 300ms ease;
		transition: all 300ms ease;
	}


	.toggler-wrapper.style-1 input[type="checkbox"]:checked+.toggler-slider .toggler-knob {
		left: calc(100% - 19px - 3px);
	}

	.toggler-wrapper.style-1 .toggler-knob {
		width: calc(25px - 6px);
		height: calc(25px - 6px);
		border-radius: 50%;
		left: 3px;
		top: 3px;
		background-color: #fff;
	}


</style>
<div style="margin:auto; margin-top: 30px; max-width: 650px;">
<h1 style="text-align: center; font-size: 30px;">Register Marketing Package</h1>
	<p>
		Lorem Ipsum is a dummy text used in typesetting and printing. It is a scrambled Latin text that is used in place of real text to give an example of what a printed page will look like when filled with actual content.
	</p>
</div>
<div class="wrapper-card">
	<?php foreach ($packages as $pack){
		$detail = json_decode($pack['detail'], true);
		$unit = $pack['unit'];
		$basic = $pack['price'];
		$requiredItems = array();
		$optionalItems = array();
		$total = $basic;
		foreach ($detail as $key => $value){
			if($value['require']){
				$requiredItems[] = $value;
				$total += floatval($value['price']);
			}else{
				$optionalItems[] = $value;
				$total += floatval($value['price']);
			}
		}

		?>
	<div class="card card_package <?php echo $pack['popular']?'popular':''?>">
		<form method="post" action="<?php echo site_url('marketing/register/process') ?>">
		<div class="card-title">
			<input type="hidden" name="pack_id" value="<?php echo $pack['id']?>">
			<input type="hidden" name="total" class="total" value="<?php echo $total?>">
			<input type="hidden" class="unitPrice" value="<?php echo floatval($basic)?>">
			<h3 class="titlePack"><?php echo $pack['pack_name']?></h3>
			<h4><?php echo $pack['description']?></h4>
		</div>
		<div class="card-price">
			<h1>
				<sup>$</sup>
				<span class="total"><?php echo $total?></span>
				<?php if($unit){?><small>month</small><?php }?>
			</h1>
		</div>
		<div class="card-description">
			<?php if(!empty($requiredItems)){?>
			<ul>
				<?php foreach ($requiredItems as $opt){?>
				<li data-price="<?php echo $opt['price']?>">
					<input type="hidden" class="unitPrice" value="<?php echo floatval($opt['price'])?>">
					<div class="option_label"><?php echo $opt['options']?></div>
					<?php if($opt['note']){?>
						<div class="note"><?php echo $opt['note']?></div>
					<?php }?>
				</li>
				<?php }?>
			</ul>
			<?php }?>
			<ul>
				<?php foreach ($optionalItems as $opt){?>
					<li data-price="<?php echo $opt['price']?>">
						<input type="hidden" class="unitPrice" value="<?php echo floatval($opt['price'])?>">
						<div class="option_flex">
							<div style="flex: 1; position: relative;">
								<label class="toggler-wrapper style-1">
								<input type="checkbox" class="option_price" name="custom_options[]" value="<?php echo base64_encode(json_encode($opt))?>" checked data-price="<?php echo $opt['price']?>">
									<div class="toggler-slider">
										<div class="toggler-knob"></div>
									</div>
								</label>
							</div>
							<div style="flex: 4;  text-align: left">
								<div class=""><?php echo $opt['options']?></div>
								<?php if($opt['note']){?>
									<div class="note"><?php echo $opt['note']?></div>
								<?php }?>
							</div>
							<div style="flex: 1"><?php echo $opt['price']?>$</div>
						</div>

					</li>
				<?php }?>
			</ul>
		</div>
		<div class="card-action">
			<button type="submit" class="btn_register">Register</button>
		</div>
		</form>
	</div>
	 <?php }?>
</div>
<div style="height: 50px;"></div>
<script>
	$(document).on('click','.option_price',function () {
		var value = $(this).is(':checked')? $(this).data('price') : 0;
		$(this).closest('li').find('.unitPrice').val(value)
		updatePrice($(this).closest('.card_package'))
	})

	function updatePrice(object){
		var total = 0;
		object.find('.unitPrice').each(function (){
			total += parseFloat($(this).val());
		})
 		object.find('.total').text(total)
	}


</script>
