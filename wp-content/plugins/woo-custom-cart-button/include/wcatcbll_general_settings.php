<div class="catcbll_stng_cntnt"><!-- start general setting-->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="catcbll_general_tab">
			<div class="tabpane_inner">										
				<form method="post" id="wcatbltn_option_save" class="">
					<section class="catcbll_general_sec">
						<div class="container-fluid">
							<div class="row mb-3">
								<div class="col-12 p-0">
									<div class="btn_preview_div">															
									<?php 
									if($catcbll_btn_icon_psn == 'right'){?>
								<button type="button" class="btn <?php echo esc_attr($catcbll_hide_2d_trans).' '.esc_attr($catcbll_hide_btn_bghvr)?> btn-lg wccbtn" id="btn_prvw"><?php echo __('Add to Cart', 'catcbll') ?> <?php if(esc_html($catcbll_btn_icon_cls) != ""){echo '<i class="fa '.esc_html($catcbll_btn_icon_cls).'"></i>';}?></button>
									<?php }else{?> 
									<button type="button" class="btn <?php echo esc_attr($catcbll_hide_2d_trans).' '.esc_attr($catcbll_hide_btn_bghvr)?> btn-lg wccbtn" id="btn_prvw"><?php if(esc_html($catcbll_btn_icon_cls) != ""){echo '<i class="fa '.esc_html($catcbll_btn_icon_cls).'"></i>';}?> <?php echo __('Add to Cart', 'catcbll') ?></button>
									<?php }?>
									</div>
								</div>
							</div>
							<div class="row mb-3">														
								<!-- save button section start-->														
								<div class="col-lg-6 col-12">															
									<div class="row">
										<div class="col-12 p-0">
											<h2 class="hd_bd_styl"><?php echo __("Cart Button's Settings","catcbll");?></h2>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-8 py-2">
											<label><?php echo __("Both","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="button1" name="catcbll_both_btn" <?php if($both == 'both') echo "checked='checked'";  ?> value="both"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Default Add to cart per Product","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="button2" id="wcatcbll_add2_cart" name="catcbll_add2_cart" <?php if($add2cart == 'add2cart') echo "checked='checked'";?> value="add2cart"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Custom Button per Product","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="button3" id="wcatcbll_custom" name="catcbll_custom" <?php if($custom == 'custom') echo "checked='checked'";  ?> value="custom"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Custom button position","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i>
												<span class="wcatcblltooltiptext"><?php echo __("custom button position", 'catcbll') ?></span>
											</div></label>
										</div>
										<div class="col-4">
											<select name="catcbll_custom_btn_position" id="wcatcbll_custom_btn_position" class="selectbox">
												<option <?php if($catcbll_custom_btn_position == 'up') echo "selected='selected'";  ?> value="up">Up</option>
												<option <?php if($catcbll_custom_btn_position == 'down') echo "selected='selected'";  ?> value="down">Down</option>
											</select>
											
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Custom button position","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i>
												<span class="wcatcblltooltiptext"><?php echo __("custom button alignment", 'catcbll') ?></span>
											</div></label>
										</div>
										<div class="col-4">
											<select name="catcbll_custom_btn_alignment" id="wcatcbll_custom_btn_aligment" class="selectbox">
												<option <?php if($catcbll_custom_btn_alignment == 'left') echo "selected='selected'";  ?> value="left">Left</option>
												<option <?php if($catcbll_custom_btn_alignment == 'center') echo "selected='selected'";  ?> value="center">Center</option>
												<option <?php if($catcbll_custom_btn_alignment == 'right') echo "selected='selected'";  ?> value="right">Right</option>
											</select>											
										</div>
									</div>
									<!-- custom button display-->
									<div class="row mt-2">
										<div class="col-12 p-0">
											<h2 class="hd_bd_styl"><?php echo __("Custom Button Display","catcbll");?></h2>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-8 py-2">
											<label><?php echo __("Global","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="class1" name="catcbll_cart_global" <?php if($global == 'global') echo "checked='checked'";?> value="global"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Shop","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="class2" id="wcatcbll_cart_shop" name="catcbll_cart_shop" <?php if($shop == 'shop') echo "checked='checked'";?> value="shop"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Single Product","catcbll");?></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="class3" id="wcatcbll_cart_single_product" name="catcbll_cart_single_product" <?php if($single == 'single-product') echo "checked='checked'";  ?> value="single-product"/>
													<span class="slider round"></span>
											</label>
										</div>
									</div>	
										<div class="row">
										<div class="col-8 py-2">
											<label><?php echo __("Open link in new tab","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i>
												<span class="wcatcblltooltiptext"><?php echo __('If checkbox is check then button link open in new tab', 'catcbll') ?></span>
											</div></label>
										</div>
										<div class="col-4">
											<label class="switch">
												<input type="checkbox" class="class4" name="catcbll_btn_open_new_tab" <?php if($btn_opnt == '1') echo "checked='checked'";  ?> value="1"/>
													<span class="slider round"></span>
											</label>																	
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-12 col_scroll">														
									<div class="row">
										<div class="col-12 p-0">
											<h2 class="hd_bd_styl"><?php echo __("Custom Button Style","catcbll");?></h2>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-6 py-2">
											<label><?php echo __("Text Font Size","catcbll");?></label>
										</div>
										<div class="col-6">
											<div class="wcatcbll_range_slider">
												<input class="wcatcbll_range_slider_range" id="catcbll_btn_fsize" type="range" value="<?php echo $catcbll_btn_fsize;?>" name="catcbll_btn_fsize" min="5" max="50">
												<span class="wcatcbll_range_slider_value"><?php esc_attr_e($catcbll_btn_fsize);?></span>
											</div>
										</div>
									</div>
									<div class="row ">
										<div class="col-6 py-2">
											<label><?php echo __("Border Size","catcbll");?></label>
										</div>
										<div class="col-6">
											<div class="wcatcbll_range_slider">
												<input class="wcatcbll_range_slider_range" id="catcbll_border_size" type="range" value="<?php echo $catcbll_border_size;?>" name="catcbll_border_size" min="0" max="20">
												<span class="wcatcbll_range_slider_value" id="ccbtn_border_size"><?php esc_attr_e($catcbll_border_size);?></span>
											</div>
										</div>
									</div>															
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Border Radius","catcbll");?></label>
										</div>
										<div class="col-6">
											<div class="wcatcbll_range_slider">
												<input class="wcatcbll_range_slider_range" id="catcbll_btn_radius" type="range" value="<?php echo $catcbll_btn_radius;?>" name="catcbll_btn_radius" min="1" max="50">
												<span class="wcatcbll_range_slider_value" id="brdr_rds"><?php esc_attr_e($catcbll_btn_radius);?></span>
											</div>																	
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Button Background","catcbll");?></label>
										</div>
										<div class="col-6">
											<input class="color-picker" data-alpha="true" type="text" name="catcbll_btn_bg" id="catcbll_btn_bg" value="<?php echo $catcbll_btn_bg;?>"/>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Text Font Color","catcbll");?></label>
										</div>
										<div class="col-6">
											<input class="color-picker" id="catcbll_btn_fclr" data-alpha="true" type="text" name="catcbll_btn_fclr" value="<?php echo $catcbll_btn_fclr;?>"/>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Border color","catcbll");?></label>
										</div>
										<div class="col-6">
											<input class="color-picker" id="catcbll_btn_border_clr" data-alpha="true" type="text" name="catcbll_btn_border_clr" value="<?php echo $catcbll_btn_border_clr;?>"/>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Hover Color","catcbll");?></label>
										</div>
										<div class="col-6">
											<input class="color-picker" id="catcbll_btn_hvrclr" data-alpha="true" type="text" name="catcbll_btn_hvrclr" value="<?php if($catcbll_btn_hvrclr == ''){} else{echo $catcbll_btn_hvrclr;}?>"/>
										</div>
									</div>															
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Button Padding","catcbll");?> <div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i>
												<span class="wcatcblltooltiptext"><?php echo __('Button padding', 'catcbll') ?></span>
											</div></label>
										</div>
										<div class="col-6">
											<ul class="btnpd_st">
												<li>
													<input type="number" name="catcbll_padding_top_bottom" value="<?php echo $catcbll_padding_top_bottom ?>" class="btn_pv">
													<label><?php echo __("Vertically","catcbll");?></label>
												</li>
												<li>
													<input type="number" name="catcbll_padding_left_right" value="<?php echo $catcbll_padding_left_right ?>" class="btn_ph">
													<label><?php echo __("Horizontally","catcbll");?></label>
												</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Button Margin","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i>
												<span class="wcatcblltooltiptext"><?php echo __('Button margin', 'catcbll') ?></span>
											</div></label>
										</div>
										<div class="col-6">
											<ul class="btnmd_st">
												<li>
													<input type="number" name="catcbll_margin_top" value="<?php echo $catcbll_margin_top ?>" class="btn_mt">
													<label><?php echo __("Top","catcbll");?></label>
												</li>
												<li>
													<input type="number" name="catcbll_margin_right" value="<?php echo $catcbll_margin_right ?>" class="btn_mr">
													<label><?php echo __("Right","catcbll");?></label>
												</li>
												<li>
													<input type="number" name="catcbll_margin_bottom" value="<?php echo $catcbll_margin_bottom ?>" class="btn_mb">
													<label><?php echo __("Bottom","catcbll");?></label>
												</li>
												<li>
													<input type="number" name="catcbll_margin_left" value="<?php echo $catcbll_margin_left ?>" class="btn_ml">
													<label><?php echo __("Left","catcbll");?></label>
												</li>
											</ul>
										</div>
									</div>															
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Button icon","catcbll");?></label>
										</div>
										<div class="col-6">
										<select name="catcbll_btn_icon_cls" id="wcatcll_font_icon">
											<?php
												foreach($wcatcbll_icons as $wcatcbll_key => $wcatcbll_val){?>
												<option <?php if($catcbll_btn_icon_cls == $wcatcbll_key) echo "selected='selected'";  ?>  value="<?php echo $wcatcbll_key;?>"><?php echo $wcatcbll_val;?></option>
												<?php }
											?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Button icon Position","catcbll");?></label>
										</div>
										<div class="col-6">
										<select name="catcbll_btn_icon_psn" id="wcatcbll_btn_icon_psn">
											<option <?php if($catcbll_btn_icon_psn == 'left') echo "selected='selected'";  ?> value="left">Left</option>
											<option <?php if($catcbll_btn_icon_psn == 'right') echo "selected='selected'";  ?> value="right">Right</option>
										</select>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("2D Transitions","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext"><?php echo __('2D Transitions hover on Add to Cart Button', 'catcbll') ?></span></div></label>
										</div>
										<div class="col-6">
											<select name="catcbll_btn_2dhvr" id="wcatcbll_btn_2Dhvr">
												<?php
													foreach($wcatcbll_btn_2dhvrs as $wcatcbll_hvr_key => $wcatcbll_hvr_val){?>
													<option <?php if($catcbll_btn_2dhvr == $wcatcbll_hvr_key) echo "selected='selected'";  ?>  value="<?php echo $wcatcbll_hvr_key;?>"><?php echo $wcatcbll_hvr_val;?></option>
													<?php }
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-6 py-2">
											<label><?php echo __("Background Transitions","catcbll");?><div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext"><?php echo __('Add to Cart Button Background Transitions on hover', 'catcbll') ?></span></div></label>
										</div>
										<div class="col-6">
											<select name="catcbll_btn_bghvr" id="wcatcbll_btn_bghvr">
												<?php
													foreach($wcatcbll_btn_bghvrs as $wcatcbll_bghvr_key => $wcatcbll_bghvr_val){?>
													<option <?php if($catcbll_btn_bghvr == $wcatcbll_bghvr_key) echo "selected='selected'";  ?>  value="<?php echo $wcatcbll_bghvr_key;?>"><?php echo $wcatcbll_bghvr_val;?></option>
													<?php }
												?>
											</select>
										</div>
									</div>
								
								</div>
								
							</div>
						</div>
					</section>									
					<div class="col-md-12 col-12 p-2 stgrcol save_btn order1 mb-3 text-right">
						<input type="submit" name="submit" id="submit_settings" class="button button-primary" value="Save Changes"/>
						<input type="hidden" id="hide_2d_trans" name="catcbll_hide_2d_trans" value="<?php echo $catcbll_btn_2dhvr;?>"/>
						<input type="hidden" id="hide_btn_bghvr" name="catcbll_hide_btn_bghvr" value="<?php echo $catcbll_btn_bghvr;?>"/>										
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- close general setting-->