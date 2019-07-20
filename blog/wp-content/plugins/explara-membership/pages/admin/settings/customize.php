<?php
include 'inc-menu-settings.php';
$customization_data = \explara\ExpMembershipGet::getCustomization();
?>
<div class="wrap">
	<div id="customize" class="tabcontent">
		<div class="bg-wht expwht-wrapper-membership">
			<div id="customize-style-blk-membership-plugin">
				<h4 class="tabtt2">
				Customization Options Available
				</h4>
				<p >
					We offer you a wide range of customization options which you can configure to match your website’s aesthetics.<br>The configurations you set will be reflected in the UI of your website for group section.
				</p>
				<form id="exp_membership_customization_form" name="exp_membership_customization_form" method="post">
					<div class="updated below-h2 exp-msg exp_success_msg">
						<p>Success</p>
					</div>
					<div class="error below-h2 exp-msg exp_error_msg">
						<p>Failed</p>
					</div>
					<input type="hidden" name="action" value="page_exp_member_add_customization">
					<div class="expform-group exprow">
						<label class="control-label expcol-30">Group title font color
							<span class="fa fa-info-circle" title="
								Group title’s font color will use the color you choose here.
							"></span></label>
							<div class="expcol-30">
								<input type="color" class="expform-control" name="card_title_color" id="card_title_color" value="<?php echo $customization_data['card_data']['card_title_color']; ?>">
							</div>
						</div>
						<div class="expform-group exprow">
							<label class="control-label expcol-30">
								Group description font color
								<span class="fa fa-info-circle" title="
									Group description font color will use the color you choose here.
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
												<button onClick="ExplaraMembershipAdminForm.post('#exp_membership_customization_form')" type="button" class="button button-primary"> Save settings </button>
											</div>
											<div class="expcol-30">
												<div class="text-right">
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>