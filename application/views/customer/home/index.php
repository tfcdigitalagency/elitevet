<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10"
     data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <section class="elementor-element elementor-element-f454b1c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
                     data-id="f454b1c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-background-overlay" style=""></div>
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-row">
                        <div class="elementor-element elementor-element-4db43e2 elementor-column elementor-col-100 elementor-top-column"
                             data-id="4db43e2" data-element_type="column">
                            <div class="elementor-column-wrap  elementor-element-populated">
								<div class="video_home elementor-widget-wrap" style="">
									<div class="elementor-element elementor-element-7db41f7 elementor-widget elementor-widget-heading"
										 data-id="7db41f7" data-element_type="widget" data-widget_type="heading.default">
										<div class="elementor-widget-container">
											<h2 class="elementor-heading-title elementor-size-default">Training Videos</h2>
										</div>
									</div>
									<?php $count = 0; ?>
									<?php for($i=0;$i<count($training);$i++){ ?>
										<?php if($training[$i]['show_on_landing_page'] == 1){ $count++; if($count > 4) break; ?>
											<div class="elementor-element elementor-element-12c62fb elementor-widget elementor-widget-pp-flipbox"
												 data-id="12c62fb" data-element_type="widget" data-widget_type="pp-flipbox.default">
												<div class="elementor-widget-container">
													<div class="pp-flipbox-container pp-animate-fade pp-direction-">
														<div class="pp-flipbox-flip-card">
															<div>
																<iframe class="embed-responsive-item" allowfullscreen="true" frameborder="0" mozallowfullscreen="" src="<?=$training[$i]['video_link']?>" webkitallowfullscreen=""></iframe>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="elementor-element elementor-element-bf65a59 elementor-widget elementor-widget-heading"
												 data-id="bf65a59" data-element_type="widget" data-widget_type="heading.default">
												<div class="elementor-widget-container">
													<h2 class="elementor-heading-title elementor-size-default"><?php echo $training[$i]['title']; ?></h2>
												</div>
											</div>
										<?php } ?>
									<?php } ?>

								</div>
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-813fe9c elementor-widget elementor-widget-heading"
                                         data-id="813fe9c" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">We Support and Advocate for
                                                <br>Service Disabled Veteran Owned Businesses</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-33052e3 elementor-widget elementor-widget-heading"
                                         data-id="33052e3" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">CELEBRATING OVER 20 YEARS SERVING THE VETERAN BUSINESS COMMUNITY</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-04b9758 elementor-align-center elementor-widget elementor-widget-button"
                                         data-id="04b9758" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a href="/customer/other/membership" class="elementor-button-link elementor-button elementor-size-sm"
                                                   role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text"><strong> Learn About Membership</strong></span>
		</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-b32bc03 elementor-hidden-phone elementor-widget elementor-widget-spacer"
                                         data-id="b32bc03" data-element_type="widget" data-widget_type="spacer.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-spacer">
                                                <div class="elementor-spacer-inner"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <section class="elementor-element elementor-element-d7e4dbf elementor-section-height-min-height elementor-hidden-phone elementor-section-boxed elementor-section-height-default elementor-section elementor-inner-section"
                                             data-id="d7e4dbf" data-element_type="section">
                                        <div class="elementor-background-overlay"></div>
                                        <div class="elementor-container elementor-column-gap-no">
                                            <div class="elementor-row">
                                                <div class="elementor-element elementor-element-9da26fa elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="9da26fa" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-2c0767d elementor-widget elementor-widget-heading"
                                                                 data-id="2c0767d" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Elite disable veterans</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-2a8a67f elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="2a8a67f" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-68c1775 elementor-widget elementor-widget-pp-divider"
                                                                 data-id="68c1775" data-element_type="widget" data-widget_type="pp-divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-divider-wrap">
                                                                        <div class="pp-divider pp-divider-vertical vertical pp-divider-solid solid"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-3d4766a elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="3d4766a" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-1a1d828 elementor-widget elementor-widget-heading"
                                                                 data-id="1a1d828" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">ELite NCD Veterans Group Webinar System</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-ac7ee1e elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="ac7ee1e" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-5661bc2 elementor-widget elementor-widget-pp-divider"
                                                                 data-id="5661bc2" data-element_type="widget" data-widget_type="pp-divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-divider-wrap">
                                                                        <div class="pp-divider pp-divider-vertical vertical pp-divider-solid solid"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-80bb4f9 elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="80bb4f9" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-87d1e71 elementor-widget elementor-widget-heading"
                                                                 data-id="87d1e71" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">DV Digital Engagements Portal</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="elementor-element elementor-element-5d67be5 elementor-section-height-min-height elementor-hidden-desktop elementor-hidden-tablet elementor-section-boxed elementor-section-height-default elementor-section elementor-inner-section"
                                             data-id="5d67be5" data-element_type="section">
                                        <div class="elementor-background-overlay"></div>
                                        <div class="elementor-container elementor-column-gap-no">
                                            <div class="elementor-row">
                                                <div class="elementor-element elementor-element-eb16d6e elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="eb16d6e" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-350c770 elementor-widget elementor-widget-heading"
                                                                 data-id="350c770" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Elite disable veterans</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-e80bba6 elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="e80bba6" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-ed82d06 elementor-widget elementor-widget-pp-divider"
                                                                 data-id="ed82d06" data-element_type="widget" data-widget_type="pp-divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-divider-wrap">
                                                                        <div class="pp-divider pp-divider-horizontal horizontal pp-divider-solid solid"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-bf01097 elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="bf01097" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-a67e5de elementor-widget elementor-widget-heading"
                                                                 data-id="a67e5de" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">ELite NCD Veterans Group Webinar System</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-93971d1 elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="93971d1" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-388d1a1 elementor-widget elementor-widget-pp-divider"
                                                                 data-id="388d1a1" data-element_type="widget" data-widget_type="pp-divider.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-divider-wrap">
                                                                        <div class="pp-divider pp-divider-horizontal horizontal pp-divider-solid solid"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-5a2f17e elementor-column elementor-col-20 elementor-inner-column"
                                                     data-id="5a2f17e" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-0984f4d elementor-widget elementor-widget-heading"
                                                                 data-id="0984f4d" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">DV Digital Engagements Portal</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="elementor-element elementor-element-35edeb1 elementor-section-full_width elementor-hidden-desktop elementor-hidden-tablet elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
                     data-id="35edeb1" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                        <div class="elementor-element elementor-element-1bb791a elementor-column elementor-col-100 elementor-top-column"
                             data-id="1bb791a" data-element_type="column">
                            <div class="elementor-column-wrap  elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-1a36385 elementor-widget elementor-widget-heading"
                                         data-id="1a36385" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">Training Videos</h2>
                                        </div>
                                    </div>
                                    <section class="elementor-element elementor-element-1d8dbce elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                                             data-id="1d8dbce" data-element_type="section">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">
                                                <div class="elementor-element elementor-element-b38d378 elementor-column elementor-col-25 elementor-inner-column"
                                                     data-id="b38d378" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-fae1eed elementor-widget elementor-widget-pp-flipbox"
                                                                 data-id="fae1eed" data-element_type="widget" data-widget_type="pp-flipbox.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-flipbox-container pp-animate-fade pp-direction-">
                                                                        <div class="pp-flipbox-flip-card">
                                                                            <div class="pp-flipbox-front">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <h3 class="pp-flipbox-heading"></h3>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="pp-flipbox-back">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image-back pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-216012a elementor-widget elementor-widget-heading"
                                                                 data-id="216012a" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Disabled Veterans Training Video 1</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-0cf2ca9 elementor-column elementor-col-25 elementor-inner-column"
                                                     data-id="0cf2ca9" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-124508b elementor-widget elementor-widget-pp-flipbox"
                                                                 data-id="124508b" data-element_type="widget" data-widget_type="pp-flipbox.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-flipbox-container pp-animate-fade pp-direction-">
                                                                        <div class="pp-flipbox-flip-card">
                                                                            <div class="pp-flipbox-front">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <h3 class="pp-flipbox-heading"></h3>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="pp-flipbox-back">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image-back pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-fbda1dc elementor-widget elementor-widget-heading"
                                                                 data-id="fbda1dc" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Disabled Veterans Training Video 2</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-f50b87e elementor-column elementor-col-25 elementor-inner-column"
                                                     data-id="f50b87e" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-91a118a elementor-widget elementor-widget-pp-flipbox"
                                                                 data-id="91a118a" data-element_type="widget" data-widget_type="pp-flipbox.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-flipbox-container pp-animate-fade pp-direction-">
                                                                        <div class="pp-flipbox-flip-card">
                                                                            <div class="pp-flipbox-front">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <h3 class="pp-flipbox-heading"></h3>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="pp-flipbox-back">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image-back pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-a950982 elementor-widget elementor-widget-heading"
                                                                 data-id="a950982" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Disabled Veterans Training Video 3</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-b6953a3 elementor-column elementor-col-25 elementor-inner-column"
                                                     data-id="b6953a3" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-97f746a elementor-widget elementor-widget-pp-flipbox"
                                                                 data-id="97f746a" data-element_type="widget" data-widget_type="pp-flipbox.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="pp-flipbox-container pp-animate-fade pp-direction-">
                                                                        <div class="pp-flipbox-flip-card">
                                                                            <div class="pp-flipbox-front">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <h3 class="pp-flipbox-heading"></h3>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="pp-flipbox-back">
                                                                                <div class="pp-flipbox-overlay">
                                                                                    <div class="pp-flipbox-inner">
                                                                                        <div class="pp-flipbox-icon-image-back pp-icon">
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                        </div>
                                                                                        <div class="pp-flipbox-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-0aa57ba elementor-widget elementor-widget-heading"
                                                                 data-id="0aa57ba" data-element_type="widget" data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h2 class="elementor-heading-title elementor-size-default">Disabled Veterans Training Video 4</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-element elementor-element-7a6acfd elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
                     data-id="7a6acfd" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" id="who">
                <div class="elementor-background-overlay"></div>
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                        <div class="elementor-element elementor-element-ab09ef2 elementor-column elementor-col-100 elementor-top-column"
                             data-id="ab09ef2" data-element_type="column">
                            <div class="elementor-column-wrap  elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-8f76776 elementor-widget elementor-widget-heading"
                                         data-id="8f76776" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <!--<h2 class="elementor-heading-title elementor-size-default">Know Us</h2>-->
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-b418086 elementor-widget elementor-widget-pp-divider"
                                         data-id="b418086" data-element_type="widget" data-widget_type="pp-divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="pp-divider-wrap">
                                                <div class="pp-divider pp-divider-horizontal horizontal pp-divider-solid solid"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-e041ca2 elementor-widget elementor-widget-heading"
                                         data-id="e041ca2" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                <strong>WHO WE</strong> ARE</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-7368419 elementor-view-default elementor-widget elementor-widget-icon"
                                         data-id="7368419" data-element_type="widget" data-widget_type="icon.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-wrapper">
                                                <div class="elementor-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="166" height="5" viewBox="0 0 166 5">
                                                        <defs>
                                                            <style>
                                                                .a, .b, .c {
                                                                    fill:none;
                                                                    stroke-linecap:round;
                                                                    stroke-width:5px;
                                                                }
                                                                .a {
                                                                    stroke:#000;
                                                                }
                                                                .b {
                                                                    stroke:#868482;
                                                                }
                                                                .c {
                                                                    stroke:#707070;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <g transform="translate(-2866 -1376)">
                                                            <line class="a" x2="71" transform="translate(2868.5 1378.5)"></line>
                                                            <line class="b" x2="62" transform="translate(2952.5 1378.5)"></line>
                                                            <line class="c" x2="4" transform="translate(3025.5 1378.5)"></line>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-da1bba8 elementor-widget elementor-widget-text-editor"
                                         data-id="da1bba8" data-element_type="widget" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-text-editor elementor-clearfix">
                                                <p>The Northern California Chapter of Elite Service-Disabled Veteran Network is a nonprofit tax-deductible 501(c)19 organization.
The Nor-Cal Elite  Network is on a mission to provide educational, training, resources, and outreach to help Disable Veterans in business succeed.
<br/>
During these challenging times, the Veteran needs your support more than ever. Through sponsorship,
<br/>
<bold>Your financial support and partnership help Disable Veterans succeed. </bold>

<br/>
Sponsor today!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-8d89065 elementor-align-center elementor-widget elementor-widget-button"
                                         data-id="8d89065" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a href="/customer/contact" class="elementor-button-link elementor-button elementor-size-sm"
                                                   role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">About Us</span>
		</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-element elementor-element-d5cba8b elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
                     data-id="d5cba8b" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                        <div class="elementor-element elementor-element-72eaa11 elementor-column elementor-col-100 elementor-top-column"
                             data-id="72eaa11" data-element_type="column">
                            <div class="elementor-column-wrap  elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-bdc790a elementor-widget elementor-widget-heading"
                                         data-id="bdc790a" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">Know Us</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-445ec5c elementor-widget elementor-widget-pp-divider"
                                         data-id="445ec5c" data-element_type="widget" data-widget_type="pp-divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="pp-divider-wrap">
                                                <div class="pp-divider pp-divider-horizontal horizontal pp-divider-solid solid"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-275a231 elementor-widget elementor-widget-heading"
                                         data-id="275a231" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">OUR
                                                <strong>SPONSORS</strong>
                                            </h2>
											<?php if(!$check_sponsor){?>
											<div class="float-right" style="position: relative; z-index: 9">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerSponsor">
													Become a Sponsor
												</button>
											</div>
											<?php }else{?>
												<div class="float-right" style="position: relative; z-index: 9">
													You are sponsor
													<a  class="btn btn-primary"  style="color: #fff" href="<?php echo site_url('customer/sponsor/ads/'.$check_sponsor->id)?>">View Ads</a>
												</div>
											<?php }?>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-ca72c94 elementor-view-default elementor-widget elementor-widget-icon"
                                         data-id="ca72c94" data-element_type="widget" data-widget_type="icon.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-wrapper">
                                                <div class="elementor-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="166" height="5" viewBox="0 0 166 5">
                                                        <defs>
                                                            <style>
                                                                .a, .b, .c {
                                                                    fill:none;
                                                                    stroke-linecap:round;
                                                                    stroke-width:5px;
                                                                }
                                                                .a {
                                                                    stroke:#000;
                                                                }
                                                                .b {
                                                                    stroke:#868482;
                                                                }
                                                                .c {
                                                                    stroke:#707070;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <g transform="translate(-2866 -1376)">
                                                            <line class="a" x2="71" transform="translate(2868.5 1378.5)"></line>
                                                            <line class="b" x2="62" transform="translate(2952.5 1378.5)"></line>
                                                            <line class="c" x2="4" transform="translate(3025.5 1378.5)"></line>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-719f574 elementor-widget elementor-widget-image-carousel"
                                         data-id="719f574" data-element_type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;6&quot;,&quot;navigation&quot;:&quot;none&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;direction&quot;:&quot;ltr&quot;}"
                                         data-widget_type="image-carousel.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-image-carousel-wrapper swiper-container swiper-container-initialized swiper-container-horizontal"
                                                 dir="ltr">
                                                <div class="elementor-image-carousel swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-1840px, 0px, 0px);">
                                                    <?php $count = 0;?>
                                                    <?php foreach($sponsor as $item):?>
                                                    <div class="swiper-slide"
                                                         data-swiper-slide-index="<?=$count;?>" style="width: 230px;">
                                                        <figure class="swiper-slide-inner">
															<a href="<?php echo $item['url']?$item['url']:'#'?>" target="_blank">
                                                            <img class="swiper-slide-image" src="<?=base_url().$item['icon']?>"
                                                                 alt="<?=$item['name']?>">
																 </a>
                                                        </figure>
                                                    </div>
                                                    <?php $count++;?>
                                                    <?php endforeach;?>
                                                </div>
                                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="elementor-element elementor-element-ae3ff87 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
                     data-id="ae3ff87" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-background-overlay"></div>
                <div class="elementor-container elementor-column-gap-default">
                    <div class="elementor-row">
                        <div class="elementor-element elementor-element-59214cb elementor-column elementor-col-100 elementor-top-column"
                             data-id="59214cb" data-element_type="column">
                            <div class="elementor-column-wrap  elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-element-0bd8022 elementor-widget elementor-widget-heading"
                                         data-id="0bd8022" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">Have Question</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-5fbec2d elementor-widget elementor-widget-pp-divider"
                                         data-id="5fbec2d" data-element_type="widget" data-widget_type="pp-divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="pp-divider-wrap">
                                                <div class="pp-divider pp-divider-horizontal horizontal pp-divider-solid solid"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-3f4dea7 elementor-widget elementor-widget-heading"
                                         data-id="3f4dea7" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                <strong>CONTACT</strong>US</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-a7d7f95 elementor-view-default elementor-widget elementor-widget-icon"
                                         data-id="a7d7f95" data-element_type="widget" data-widget_type="icon.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-wrapper">
                                                <div class="elementor-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="166" height="5" viewBox="0 0 166 5">
                                                        <defs>
                                                            <style>
                                                                .a, .b, .c {
                                                                    fill:none;
                                                                    stroke-linecap:round;
                                                                    stroke-width:5px;
                                                                }
                                                                .a {
                                                                    stroke:#000;
                                                                }
                                                                .b {
                                                                    stroke:#868482;
                                                                }
                                                                .c {
                                                                    stroke:#707070;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <g transform="translate(-2866 -1376)">
                                                            <line class="a" x2="71" transform="translate(2868.5 1378.5)"></line>
                                                            <line class="b" x2="62" transform="translate(2952.5 1378.5)"></line>
                                                            <line class="c" x2="4" transform="translate(3025.5 1378.5)"></line>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <section class="elementor-element elementor-element-ace2796 elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                                             data-id="ace2796" data-element_type="section">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div class="elementor-row">

                                                <div class="elementor-element elementor-element-a99874d elementor-column elementor-col-33 elementor-inner-column"
                                                     data-id="a99874d" data-element_type="column">
                                                    <div class="elementor-column-wrap  elementor-element-populated">
                                                        <div class="elementor-widget-wrap">
                                                            <div class="elementor-element elementor-element-e06b8df elementor-button-align-center elementor-widget elementor-widget-form"
                                                                 data-id="e06b8df" data-element_type="widget" data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width_mobile&quot;:&quot;100&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                                                                 data-widget_type="form.default">
                                                                <div class="elementor-widget-container">
                                                                    <form class="form-validate-jquery" method="post" name="New Form">
                                                                        <input type="hidden" name="post_id" value="10">
                                                                        <input type="hidden" name="form_id" value="e06b8df">
                                                                        <input type="hidden" name="queried_id" value="10">
                                                                        <div class="elementor-form-fields-wrapper elementor-labels-">
                                                                            <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-33">
                                                                                <label for="form-field-name" class="elementor-field-label elementor-screen-only">Name</label>
                                                                                <input size="1" type="text" name="name" id="name"
                                                                                       class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Name">
                                                                            </div>
                                                                            <div class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-email elementor-col-33 elementor-field-required">
                                                                                <label for="form-field-email" class="elementor-field-label elementor-screen-only">Email</label>
                                                                                <input size="1" type="email" name="email" id="email"
                                                                                       class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Email"
                                                                                       required="required" aria-required="true">
                                                                            </div>
                                                                            <div class="elementor-field-type-number elementor-field-group elementor-column elementor-field-group-field_71002b9 elementor-col-33 elementor-field-required">
                                                                                <label for="form-field-field_71002b9" class="elementor-field-label elementor-screen-only">Phone</label>
                                                                                <input type="number" name="phone" id="phone"
                                                                                       class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Phone" required>
                                                                            </div>
                                                                            <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-message elementor-col-100">
                                                                                <label for="form-field-message" class="elementor-field-label elementor-screen-only">
                                                                                    <br>
                                                                                </label>
                                                                                <textarea class="elementor-field-textual elementor-field  elementor-size-sm"
                                                                                          name="message" id="message" rows="4" placeholder="Message"></textarea>
                                                                            </div>
                                                                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons elementor-sm-100">
                                                                                <button type="button" class="elementor-button btn-primary elementor-size-xs" style="border: 0!important; border-radius:7px; " onclick="send_message()">
                                                                                            <span>
                                                                                                <span class=" elementor-button-icon"></span>
                                                                                                <span class="elementor-button-text">SUBMIT</span>
                                                                                            </span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<!-- Modal -->
<div class="modal fade" id="registerSponsor" tabindex="-1" role="dialog" aria-labelledby="Sponsor" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Become a Sponsor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('customer/sponsor/purchase')?>" id="sponsor_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="modal-body">
				<div class="row form-group">
					<div class="col-md-4">
						<label>Company</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="company"  placeholder="Company name" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Your Name</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="fullname"  placeholder="Name"  required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Email</label>
					</div>
					<div class="col-md-8">
						 <input type="email" class="form-control input" name="email"  placeholder="Email"  required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Your Phone</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="phone"  placeholder="Phone number"  required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Ads Link</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="url"  placeholder="URL sponsor"  required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Logo/Image</label>
					</div>
					<div class="col-md-8">
						 <input type="file" name="userfile" class="input" size="20" style="display: inline-block;"  required />
					</div>
				</div>


				<div class="paymentWrap">
					<h3 class="header-profile">
						<div>
							Payment Info							</div>
					</h3>
					<div class="row">
						<div class="col-md-12">
							<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
							<div id="payment-errors"></div>

							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Select Package</label>
								<div class="col-md-8 col-xs-4 col-sm-8 ">
									<select id="selectPackage" name="package_id" class="form-control">
										<?php foreach ($sponsors_package as $p){?>
										<option value="<?php echo $p->id?>" data-cost="<?php echo $p->cost?>"><?php echo $p->name?></option>
										<?php }?>
									</select>
								</div>

							</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>

								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label">  <span id="display_amount"></span> USD </label>
								</div>
							</div>
							<!--div class="row form-group" id="show_hide_div">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
								<div class="col-md-8 col-xs-8 col-sm-8 ">
									<button type="button" onclick="show_coupon();" class="btn btn-default center">Have a coupon?</button>
								</div>
							</div-->
							<div id="coupon-div" style="display: none;">
								<div class="row form-group">
									<label for="text" class="col-md-3 col-xs-4 col-sm-4 control-label">Discount Coupon</label>

									<div class="col-md-6 col-xs-6 col-sm-6 ">  <input type="text" class="form-control" name="coupon_name" id="coupon_name" value="" placeholder="Enter Coupon Code">
									</div>
									<div class="col-md-1 col-xs-1 col-sm-1 pull-left" id="coupon-result">
									</div>
								</div>
								<div class="row">
									<hr>
								</div>
								<div class="row">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">(-) Discount</label>

									<div class="col-md-8 col-xs-8 col-sm-8 " id="discount">
									</div>
								</div>
								<div class="row">
									<hr>
								</div>
								<div class="row">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Total</label>

									<div class="col-md-8 col-xs-8 col-sm-8" id="total"><label class="control-label">  200 USD</label>
									</div>
								</div>

								<div class="row">
									<hr>

								</div>
							</div>

							<div class="" id="paymentResponse" style="color: red; margin: 10px 0;">
								<?php echo $this->session->flashdata('error');?>
							</div>

							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Card Number</label>
								<div class="col-md-8 col-xs-8 col-sm-8 ">
									<div id="card_number" class="form-control ctrl-textbox"></div>
								</div>
							</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Card CVV </label>
								<div class="col-md-8 col-xs-8 col-sm-8 ">
									<div id="card_cvc" class="form-control ctrl-textbox"></div>
								</div>
							</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Expiration (MM/YYYY)</label>
								<div class="col-md-4 col-xs-4 col-sm4">
									<div id="card_expiry" class="form-control ctrl-textbox"></div>
								</div>
							</div>

							<input type="hidden" name="form_reg" id="form_reg" value="">
							<input type="hidden" name="action" value="stripe">



						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<div id="loading-3" style="display: none;"><img src="https://elitesdvob.org/wp-content/plugins/directory-pro/admin/files/images/loader.gif"></div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<input type="submit" value="Submit" class="btn btn-primary" id="btn_register_sponsor" />
			</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('#display_amount').text($('#selectPackage :selected').data('cost'));
	$('#selectPackage').change(function (){
		var t = $('#selectPackage :selected').data('cost');
		$('#display_amount').text(t);
	})
	// Create an instance of the Stripe object
	// Set your publishable API key
	var stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');

	// Create an instance of elements
	var elements = stripe.elements();

	var style = {
		base: {
			fontWeight: 400,
			fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
			fontSize: '16px',
			lineHeight: '1.4',
			color: '#555',
			backgroundColor: '#fff',
			'::placeholder': {
				color: '#888',
			},
		},
		invalid: {
			color: '#eb1c26',
		}
	};

	var cardElement = elements.create('cardNumber', {
		style: style
	});
	cardElement.mount('#card_number');

	var exp = elements.create('cardExpiry', {
		'style': style
	});
	exp.mount('#card_expiry');

	var cvc = elements.create('cardCvc', {
		'style': style
	});
	cvc.mount('#card_cvc');

	// Validate input of the card elements
	var resultContainer = document.getElementById('paymentResponse');
	cardElement.addEventListener('change', function(event) {
		if (event.error) {
			resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
		} else {
			resultContainer.innerHTML = '';
		}
	});

	// Get payment form element
	var form = document.getElementById('sponsor_form');

	// Create a token when the form is submitted.
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		createToken();
	});

	// Create single-use token to charge the user
	function createToken() {
		stripe.createToken(cardElement).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error
				resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
			} else {
				// Send the token to your server
				stripeTokenHandler(result.token);
			}
		});
	}

	// Callback to handle the response from stripe
	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);

		// Submit the form
		form.submit();
	}
</script>

<script>
    var validator;

    var FormValidation = function() {
        // Validation config
        var _componentValidation = function() {
            if (!$().validate) {
                console.warn('Warning - validate.min.js is not loaded.');
                return;
            }

            // Initialize
            validator = $('.form-validate-jquery').validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                success: function(label) {
                    label.addClass('validation-valid-label').text('success.'); // remove to hide Success message
                },

                // Different components require proper error label placement
                errorPlacement: function(error, element) {

                    // Unstyled checkboxes, radios
                    if (element.parents().hasClass('form-check')) {
                        error.appendTo( element.parents('.form-check').parent() );
                    }

                    // Input with icons and Select2
                    else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                        error.appendTo( element.parent() );
                    }

                    // Input group, styled file input
                    else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                        error.appendTo( element.parent().parent() );
                    }

                    // Other elements
                    else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    message: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: 'Please insert your name.'
                    },
                    email: {
                        required: 'Please insert your email.'
                    },
                    phone: {
                        required: 'Please insert your phone number.'
                    },
                    message: {
                        required: 'Please insert your message.'
                    },
                }
            });
        };

        return {
            init: function() {
                _componentValidation();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        FormValidation.init();
    });

    function send_message(){
        var check = validator.checkForm();

        if (!check)
            validator.showErrors();
        else{
            $.ajax({
                url: base_url+'customer/contact/insert_Contact',
                type : 'POST',
                data : {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    content:$('#message').val(),
                },
                cache: false,
                success: function(result) {

                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'We received your message and we will get back to you soon.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });
                    location.reload();
                }
            });
        }
    }

	/*$("#sponsor_form").submit(function (event) {
            event.preventDefault();
            var form_data = new FormData($('#sponsor_form')[0]);

            jQuery.ajax({
                type: "POST",
                url: $('#sponsor_form').attr('action'),
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if (res) {
                        if (res.status == 1) {
							$('#sponsor_message').html('');
                            alert('Thank you for your sponsor. We will contact you soon.');
							$('#registerSponsor').modal('hide');
							$('#sponsor_form .input').val('');
                        } else {
                            $('#sponsor_message').css({color: 'red'}).html(res.error.error);
                        }

                    }
                }
            });

			return false;
        });*/
</script>
