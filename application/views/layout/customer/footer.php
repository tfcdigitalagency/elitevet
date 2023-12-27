
<div class="footer_menu p-3" style="position:relative;">
	<div class="container">
		<footer class="fusion-footer-widget-area fusion-widget-area" >
			<div class="fusion-row">
				<section class="elementor-element elementor-element-bcf19d5 elementor-section-full_width elementor-section-height-min-height elementor-hidden-tablet elementor-hidden-phone elementor-section-height-default elementor-section-items-middle elementor-section elementor-top-section" data-id="bcf19d5" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
					<div class="elementor-container elementor-column-gap-default">
						<div class="elementor-row mt-3">
							<div class="col-md-4">
								<div class="elementor-image">
									<img width="198" height="68" src="<?=base_url().'assets/customer_assets'?>/Group-9.png" class="attachment-large size-large" alt="" loading="lazy">
								</div>
								<div class="fusion-social-networks boxed-icons mt-4">
									<div class="social_menu mt-2 mb-2">
										<a class="fa fa-facebook" style="" data-placement="top" data-title="Facebook"
										   data-toggle="tooltip" title="" href="https://www.facebook.com/elitesdvobnetworkusa/"
										   target="_blank" rel="noopener noreferrer" data-original-title="Facebook"><span
													class="screen-reader-text">Facebook</span></a>
										<a class="fa fa-twitter" style="" data-placement="top" data-title="Twitter"
										   data-toggle="tooltip" title="" href="https://twitter.com/elitesdvobusa?lang=en"
										   target="_blank" rel="noopener noreferrer" data-original-title="Twitter"><span
													class="screen-reader-text">Twitter</span></a>
										<a class="fa fa-instagram" style="" data-placement="top" data-title="Instagram"
										   data-toggle="tooltip" title="" href="https://www.instagram.com/elitesdvobnetwork/"
										   target="_blank" rel="noopener noreferrer" data-original-title="Instagram"><span
													class="screen-reader-text">Instagram</span></a>
										<a class="fa fa-youtube" style="" data-placement="top" data-title="YouTube"
										   data-toggle="tooltip" title=""
										   href="https://www.youtube.com/channel/UCn0l1CT67W1jU2zYu8FxYbg" target="_blank"
										   rel="noopener noreferrer" data-original-title="YouTube"><span
													class="screen-reader-text">YouTube</span></a>
										<a class="fa fa-linkedin" style="" data-placement="top" data-title="LinkedIn"
										   data-toggle="tooltip" title="" href="https://www.linkedin.com/in/elitesdvob/"
										   target="_blank" rel="noopener noreferrer" data-original-title="LinkedIn"><span
													class="screen-reader-text">LinkedIn</span></a></div>
								</div>
								<div>
									&copy; Copyright 2012 - <?php echo date("Y");?>
									All Rights Reserved
								</div>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-3 footer_group">
										<h3>About us</h3>
										<ul>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item menu-item-82"><a href="<?=base_url().'customer/home'?>" aria-current="page" class="elementor-item <?=($id == 'home')?'elementor-item-active':'elementor-item-anchor'?>">Home</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/other/about'?>" class="elementor-item <?=($id == 'about')?'elementor-item-active':'elementor-item-anchor'?>">About Us</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/other/wedo'?>" class="elementor-item <?=($id == 'wedo')?'elementor-item-active':'elementor-item-anchor'?>">What We Do</a></li>
											
											<?php if(@$this->session->userdata('user')['membership_id'] > 0){ ?>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/event'?>" class="elementor-item <?=($id == 'event')?'elementor-item-active':'elementor-item-anchor'?>">EVENT</a></li>
											<?php } ?>

											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'news'?>" class="elementor-item <?=($id == 'news')?'elementor-item-active':'elementor-item-anchor'?>">NEWS</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'activity'?>" class="elementor-item <?=($id == 'activity')?'elementor-item-active':'elementor-item-anchor'?>">GALLERY</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'customer/home/page/memberboard'?>" class="elementor-item <?=($id == 'memberboard')?'elementor-item-active':'elementor-item-anchor'?>">Board Members</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-87"><a href="<?=base_url().'customer/contact'?>" class="elementor-item <?=($id == 'contact')?'elementor-item-active':'elementor-item-anchor'?>">CONTACT</a></li>
										</ul>
									</div>
									<div class="col-md-3 footer_group">
										<h3>Members Area</h3>
										<ul>
											<?php if(@$this->session->userdata('user')['membership_id'] > 0){ ?>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/training'?>" class="elementor-item <?=($id == 'training')?'elementor-item-active':'elementor-item-anchor'?>">TRAINING</a></li>
											<?php } else { ?>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="<?=base_url().'customer/other/membership'?>" class="elementor-item <?=($id == 'membership')?'elementor-item-active':'elementor-item-anchor'?>">Membership</a></li>
											<?php } ?>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/webinar'?>" class="elementor-item <?=($id == 'webinar')?'elementor-item-active':'elementor-item-anchor'?>">WEBINAR</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/opportunities'?>" class="elementor-item <?=($id == 'opportunities')?'elementor-item-active':'elementor-item-anchor'?>">OPPORTUNITIES</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="<?=base_url().'customer/other/benefit'?>" class="elementor-item <?=($id == 'benefit')?'elementor-item-active':'elementor-item-anchor'?>">SPONSORS</a></li>

											<?php if(check_sponsor()){ ?>
												<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=site_url('/customer/other/search_cap_sta')?>" class="elementor-item <?=($id == 'search_cap_sta')?'elementor-item-active':'elementor-item-anchor'?>">DOWNLOAD CAP-STA</a></li>
											<?php }
											?>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="<?=base_url().'customer/home/referral'?>" class="elementor-item <?=($id == 'wedo')?'elementor-item-active':'elementor-item-anchor'?>">Referral</a></li>

										</ul>
									</div>
									<div class="col-md-4 footer_group">
										<h3>Useful Links</h3>
										<ul>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="https://elitesdvob.org/find-an-sdvob/" class="elementor-item <?=($id == 'find')?'elementor-item-active':'elementor-item-anchor'?>" target="_blank">Find an SDVOB</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/home/page/sdvosb'?>" class="elementor-item <?=($id == 'sdvosb')?'elementor-item-active':'elementor-item-anchor'?>">SDVOSB Programs</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url().'customer/other/review'?>" class="elementor-item <?=($id == 'sdvosb')?'elementor-item-active':'elementor-item-anchor'?>">Sponsorship Review</a></li>
											<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="<?=base_url('/customer/home/digital')?>" class="elementor-item">Digital Magazine</a></li>
										</ul>
									</div>
								</div>

							</div>
						</div>
					</div>
				</section>
			</div> <!-- fusion-row -->
			<style>
				.dig_wrap{ 
					position:absolute;
					width:220px; 
					top:30px;
					right:30px; 
				}
			</style>
			<div class="dig_wrap">
			<?php
				$dig = get_home_dig();
				if($dig){
					$urlImg = $dig->photo;
					if(strpos($urlImg,'https://')=== false){
						$urlImg = base_url().$urlImg;
					}
					$link = (!$dig->type)?  site_url('/customer/home/document/?id=').$dig->id : base_url().$dig->pdf;
					?><a target="_blank" style="display:inline-block;width:100%;" class="dig_item" data-id="<?php echo $dig->id ?>" title="Dig Mag" href="<?php echo $link; ?>">
					<table style="display:block;width:100%;border:1px solid #666;" cellspacing=0 cellpadding=0><tr><td style="padding:0px;">
					<img style="width:100%;height:100%;" src="<?php echo  $urlImg?>"/>
					</td><td style="padding:10px; text-align:center;color:#fff">
					<b>View Digital Magazine</b>
					</td>
					</tr></table></a>
					<?php
				}
			?>
			</div>
			
		</footer> <!-- fusion-footer-widget-area -->


	</div>
</div>

<footer id="site-footer" class="site-footer" role="contentinfo"></footer>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/wp-embed.min.js"
		id="wp-embed-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/jquery.smartmenus.min.js"
		id="smartmenus-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/frontend.js"
		id="powerpack-frontend-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/frontend-modules.min.js"
		id="elementor-frontend-modules-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/jquery.sticky.min.js"
		id="elementor-sticky-js"></script>
<script type="text/javascript" id="elementor-pro-frontend-js-before">
	var ElementorProFrontendConfig = {
		"ajaxurl": "https:\/\/elitencdveterans.org\/wp-admin\/admin-ajax.php",
		"nonce": "5f72076e13",
		"i18n": {
			"toc_no_headings_found": "No headings were found on this page."
		},
		"shareButtonsNetworks": {
			"facebook": {
				"title": "Facebook",
				"has_counter": true
			},
			"twitter": {
				"title": "Twitter"
			},
			"google": {
				"title": "Google+",
				"has_counter": true
			},
			"linkedin": {
				"title": "LinkedIn",
				"has_counter": true
			},
			"pinterest": {
				"title": "Pinterest",
				"has_counter": true
			},
			"reddit": {
				"title": "Reddit",
				"has_counter": true
			},
			"vk": {
				"title": "VK",
				"has_counter": true
			},
			"odnoklassniki": {
				"title": "OK",
				"has_counter": true
			},
			"tumblr": {
				"title": "Tumblr"
			},
			"delicious": {
				"title": "Delicious"
			},
			"digg": {
				"title": "Digg"
			},
			"skype": {
				"title": "Skype"
			},
			"stumbleupon": {
				"title": "StumbleUpon",
				"has_counter": true
			},
			"mix": {
				"title": "Mix"
			},
			"telegram": {
				"title": "Telegram"
			},
			"pocket": {
				"title": "Pocket",
				"has_counter": true
			},
			"xing": {
				"title": "XING",
				"has_counter": true
			},
			"whatsapp": {
				"title": "WhatsApp"
			},
			"email": {
				"title": "Email"
			},
			"print": {
				"title": "Print"
			}
		},
		"facebook_sdk": {
			"lang": "en_US",
			"app_id": ""
		},
		"lottie": {
			"defaultAnimationUrl": "https:\/\/elitencdveterans.org\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"
		}
	};
</script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/frontend.min.js"
		id="elementor-pro-frontend-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/position.min.js"
		id="jquery-ui-position-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/dialog.min.js"
		id="elementor-dialog-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/waypoints.min.js"
		id="elementor-waypoints-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/swiper.min.js"
		id="swiper-js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/share-link.min.js"
		id="share-link-js"></script>
<script type="text/javascript" id="elementor-frontend-js-before">
	var elementorFrontendConfig = {
		"environmentMode": {
			"edit": false,
			"wpPreview": false
		},
		"i18n": {
			"shareOnFacebook": "Share on Facebook",
			"shareOnTwitter": "Share on Twitter",
			"pinIt": "Pin it",
			"downloadImage": "Download image"
		},
		"is_rtl": false,
		"breakpoints": {
			"xs": 0,
			"sm": 480,
			"md": 768,
			"lg": 1025,
			"xl": 1440,
			"xxl": 1600
		},
		"version": "2.9.11",
		"urls": {
			"assets": "https:\/\/elitencdveterans.org\/wp-content\/plugins\/elementor\/assets\/"
		},
		"settings": {
			"page": [],
			"general": {
				"elementor_global_image_lightbox": "yes",
				"elementor_lightbox_enable_counter": "yes",
				"elementor_lightbox_enable_fullscreen": "yes",
				"elementor_lightbox_enable_zoom": "yes",
				"elementor_lightbox_enable_share": "yes",
				"elementor_lightbox_title_src": "title",
				"elementor_lightbox_description_src": "description"
			},
			"editorPreferences": []
		},
		"post": {
			"id": 10,
			"title": "",
			"excerpt": "",
			"featuredImage": false
		}
	};
</script>
<script>
	$('.menuMobile').click(function (){
		$('.elementor-nav-menu').toggleClass('mobile_nav');
	});
	
	$('.dig_item').click(function(){
		var id = $(this).data('id');
		$.ajax({
			url: '<?php echo site_url("customer/home/hit_dig");?>',
			type: 'POST',
			data: 'id=' + id,
			success: function (data) {
				 
			},
			error: function (e) {
				console.log(e.message);
			}
		});
	});
</script>
<script type="text/javascript" src="<?= base_url() . 'assets/customer_assets' ?>/frontend.min(2).js"
		id="elementor-frontend-js"></script>
<span id="elementor-device-mode" class="elementor-screen-only"
	  style=""></span>
<div data-pafe-ajax-url="https://elitencdveterans.org/wp-admin/admin-ajax.php"></div>
</body>

</html>
