<?php if(!empty($this->session->userdata('user'))):?>
	<nav role="navigation" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-text e--animation-grow">
		<ul id="menu-1-c85f928" class="elementor-nav-menu" data-smartmenus-id="16067532353891304">
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item menu-item-82"><a href="<?=base_url().'customer/home'?>" aria-current="page" class="elementor-item <?=($id == 'home')?'elementor-item-active':'elementor-item-anchor'?>">Home</a></li>
			<?php if($this->session->userdata('user')['membership_id'] > 0){ ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/event'?>" class="elementor-item <?=($id == 'event')?'elementor-item-active':'elementor-item-anchor'?>">EVENT</a></li>
			<?php } ?>

			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'news'?>" class="elementor-item <?=($id == 'news')?'elementor-item-active':'elementor-item-anchor'?>">NEWS</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/webinar'?>" class="elementor-item <?=($id == 'webinar')?'elementor-item-active':'elementor-item-anchor'?>">WEBINAR</a></li>

			<?php if($this->session->userdata('user')['is_admin'] > 0){ ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/whilewebinar'?>" class="elementor-item <?=($id == 'whilewebinar')?'elementor-item-active':'elementor-item-anchor'?>">WHILEWEBINAR</a></li>
			<?php } ?>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/home/page/sdvosb'?>" class="elementor-item <?=($id == 'sdvosb')?'elementor-item-active':'elementor-item-anchor'?>">SDVOSB Programs</a></li>
			<?php if($this->session->userdata('user')['membership_id'] > 0){ ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/opportunities'?>" class="elementor-item <?=($id == 'opportunities')?'elementor-item-active':'elementor-item-anchor'?>">OPPORTUNITIES</a></li>
			<?php } ?>
			<?php if($this->session->userdata('user')['membership_id'] > 0){ ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/training'?>" class="elementor-item <?=($id == 'training')?'elementor-item-active':'elementor-item-anchor'?>">TRAINING</a></li>
			<?php } else { ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="<?=base_url().'customer/other/membership'?>" class="elementor-item <?=($id == 'membership')?'elementor-item-active':'elementor-item-anchor'?>">Membership</a></li>
			<?php } ?>

			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'customer/contact'?>" class="elementor-item <?=($id == 'contact')?'elementor-item-active':'elementor-item-anchor'?>">CONTACT</a></li>
		</ul>
	</nav>
<?php else:?>
	<nav role="navigation" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-text e--animation-grow">
		<ul id="menu-1-c85f928" class="elementor-nav-menu" data-smartmenus-id="16067532353891304">
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item menu-item-82"><a href="<?=base_url().'customer/home'?>" aria-current="page" class="elementor-item <?=($id == 'home')?'elementor-item-active':'elementor-item-anchor'?>">Home</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/other/wedo'?>" class="elementor-item <?=($id == 'wedo')?'elementor-item-active':'elementor-item-anchor'?>">What We Do</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="<?=base_url().'customer/other/membership'?>" class="elementor-item <?=($id == 'membership')?'elementor-item-active':'elementor-item-anchor'?>">Membership</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="https://elitesdvob.org/find-an-sdvob/" class="elementor-item <?=($id == 'find')?'elementor-item-active':'elementor-item-anchor'?>" target="_blank">Find an SDVOB</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-89"><a href="<?=base_url().'customer/home/page/sdvosb'?>" class="elementor-item <?=($id == 'sdvosb')?'elementor-item-active':'elementor-item-anchor'?>">SDVOSB Programs</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/opportunities'?>" class="elementor-item <?=($id == 'find')?'elementor-item-active':'elementor-item-anchor'?>">OPPORTUNITIES</a></li>

			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/home#who'?>" class="elementor-item <?=($id == 'weare')?'elementor-item-active':'elementor-item-anchor'?>">Who we are</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-88"><a href="<?=base_url().'news'?>" class="elementor-item <?=($id == 'news')?'elementor-item-active':'elementor-item-anchor'?>">News</a></li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'customer/contact'?>" class="elementor-item <?=($id == 'contact')?'elementor-item-active':'elementor-item-anchor'?>">CONTACT</a></li>
		</ul>
	</nav>
<?php endif;?>
