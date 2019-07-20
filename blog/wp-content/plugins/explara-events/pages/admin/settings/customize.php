<?php
include 'inc-menu-settings.php';
$customization_data = \explara\ExpGet::getCustomization();
?>
<div class="wrap">
	<div id="customize" class="tabcontent">
		<div class="bg-wht expwht-wrapper">
			<div class="customize-style-blk">
				<h4 class="tabtt2">
				Customization Options Available
				</h4>
				<p >
					We offer you a wide range of customization options which you can configure to match your website’s aesthetics.<br>The configurations you set will be reflected in the UI of your website for events section.
				</p>

				<form id="exp_customization_form" name="exp_customization_form" method="post">
					<div class="updated below-h2 exp-msg exp_success_msg">
						<p>Success</p>
					</div>
					<div class="error below-h2 exp-msg exp_error_msg">
						<p>Failed</p>
					</div>
					<input type="hidden" name="action" value="page_add_customization">
					<div class="expform-group exprow">
						<label class="control-label expcol-30">Event title font color
							<span class="fa fa-info-circle" title="
								Event title’s font color will use the color you choose here.
							"></span></label>
							<div class="expcol-30">
								<input type="color" class="expform-control" name="card_title_color" id="card_title_color" value="<?php echo $customization_data['card_data']['card_title_color']; ?>">
							</div>
						</div>
						<div class="expform-group exprow">
							<label class="control-label expcol-30">
								Event description font color
								<span class="fa fa-info-circle" title="
									Event description font color will use the color you choose here.
								"></span></label>
								<div class="expcol-30">
									<input type="color" class="expform-control" name="card_description_color" id="card_description_color" value="<?php echo $customization_data['card_data']['card_description_color']; ?>">
								</div>
							</div>
							<hr>
							<div class="expform-group exprow">
								<label class="control-label expcol-30">
									Choose font family
									<span class="fa fa-info-circle" title="Please key in the font family which you wish to use. Ideal would be the one you have used across your website. "></span></label>
									<div class="expcol-30">
										<input type="text" class="expform-control" placeholder="Font family" name="font_family" id="token_value" value="<?php echo $customization_data['font_data']['font_family']; ?>">

									</div>
								</div>
								<div class="expform-group exprow">
									<label class="control-label expcol-30">Font style <span class="fa fa-info-circle" title="
										Choose the font style to be applied
									"></span></label>
									<div class="expcol-30">
										<select name="font_style" class="expform-control">
											<option <?php echo ($customization_data['font_data']['font_style'] === 'inherit' ? 'selected' : ''); ?> value="inherit">
												Inherit
											</option>
											<option <?php echo ($customization_data['font_data']['font_style'] === 'initial' ? 'selected' : ''); ?> value="initial">
												Initial
											</option>
											<option <?php echo ($customization_data['font_data']['font_style'] === 'italic' ? 'selected' : ''); ?> value="italic">
												Italic
											</option>
											<option <?php echo ($customization_data['font_data']['font_style'] === 'normal' ? 'selected' : ''); ?> value="normal">
												Normal
											</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="expform-group exprow">
									<label class="control-label expcol-30">
										Button color
										<span class="fa fa-info-circle" title="
											Choose a color for the buttons which will appear across event cards or single view
										"></span></label>
										<div class="expcol-30">
											<input type="color" class="expform-control" name="button_background_color" id="button_background_color" value="<?php echo $customization_data['button_data']['button_background_color']; ?>">
										</div>
									</div>
									<div class="expform-group exprow">
										<label class="control-label expcol-30">Button font color <span class="fa fa-info-circle" title="Choose a color for the button text"></span></label>
										<div class="expcol-30">
											<input type="color" class="expform-control" name="button_color" id="button_color" value="<?php echo $customization_data['button_data']['button_color']; ?>">
										</div>
									</div>
									<div class="pdt-30">
										<div class="exprow">
											<div class="expcol-60">
												<button onClick="ExplaraAdminForm.post('#exp_customization_form')" type="button" class="button button-primary"> Save settings </button>
											</div>
											<div class="expcol-30">
												<div class="text-right">

												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<hr class="mrv-30">
							<div class="templating-blk">
								<h4 class="tabtt2">
								Configure Event Listing Style
								</h4>
								<p class="textinfo">
									You may choose one of the following styles in which event listings will be displayed in your website.
								</p>
								<form id="explara_template_post" method="post">
									<div class="updated below-h2 exp-msg exp_success_msg">
										<p>Success</p>
									</div>
									<div class="error below-h2 exp-msg exp_error_msg">
										<p>Failed</p>
									</div>
									<div class="multiple-select">
										<div class="exprow">
											<div class="expcol-30 text-center nopadding">
												<label>
													<input type="radio" name="template_name" id="estimate-for-card" value="card" class="hidden" autocomplete="off" <?php echo get_option('explara_events_templates', 'card') == 'card' ? 'checked' : ''; ?>>
													<div class="not-checked">
														<div class="bg-img">
															<div class="overlay">
															</div>
															<div class="o-lay-content">
															</div>
														</div>
														<p class="on-hover">
															Card View
														</p>
													</div>
												</label>
											</div>
											<div class="expcol-30 text-center nopadding">
												<label>
													<input type="radio" name="template_name" id="estimate-for-list" value="list" class="hidden" autocomplete="off" <?php echo get_option('explara_events_templates') == 'list' ? 'checked' : ''; ?>>
													<div class="not-checked">
														<div class="bg-img list-view">
															<div class="overlay">
															</div>
															<div class="o-lay-content">
															</div>
														</div>
														<p class="on-hover">
															List View
														</p>
													</div>
												</label>
											</div>
											<div class="expcol-30 text-center nopadding">
												<label>
													<input type="radio" name="template_name" id="estimate-for-calendar" value="calendar" class="hidden" autocomplete="off" <?php echo get_option('explara_events_templates') == 'calendar' ? 'checked' : ''; ?>>
													<div class="not-checked">
														<div class="bg-img list-calender">
															<div class="overlay">
															</div>
															<div class="o-lay-content">
															</div>
														</div>
														<p class="on-hover">
															Calender View
														</p>
													</div>
												</label>
											</div>
										</div>
									</div>
									<div class="pdt-30">
										<input type="hidden" name="action" value="page_template_post">
										<button type="button" onClick="ExplaraAdminForm.post('#explara_template_post')" class="button button-primary">Save changes</button>
									</div>
								</form>
							</div>
							<hr class="mrv-30">
							<div class="templating-blk">
								<h4 class="tabtt2">
								Default Set of Events
								</h4>
								<p class="textinfo">
									Enter number of events to be shown by default in listing page
								</p>
								<form id="explara_events_shown" method="post">
									<div class="updated below-h2 exp-msg exp_success_msg">
										<p>Success</p>
									</div>
									<div class="error below-h2 exp-msg exp_error_msg">
										<p>Failed</p>
									</div>
									<div class="exprow expform-group">
										<label  class="control-label expcol-20">
											Default number of events
										</label>
										<div class="expcol-60">
											<div class="expform-group">
												<input min="1" value="<?php echo get_option('explara_events_shown', 1); ?>" type="number" name="event_shown" class="expform-control" max="50">
											</div>
										</div>
									</div>
									<div class="pdt-30">
										<input type="hidden" name="action" value="page_events_shown">
										<button type="button" onClick="ExplaraAdminForm.post('#explara_events_shown')" class="button button-primary">Save changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>