<?php

// Save cart button setting in option.php
function wcatcbll_wccb_options_page() {

	include(WCATCBLL_CART_INC .'wcatcbll_btn_2dhvr.php');

	$catcbll_settings = get_option('_woo_catcbll_all_settings');
	extract($catcbll_settings);
	
	//button display setting
	if(isset($catcbll_both_btn)){$both  = $catcbll_both_btn;}else{$both = '';}
	if(isset($catcbll_add2_cart)){$add2cart = $catcbll_add2_cart;}else{$add2cart= '';}
	if(isset($catcbll_custom)){$custom = $catcbll_custom;}else{$custom  = '';}		
	//display button setting
	if(isset($catcbll_cart_global)){$global = $catcbll_cart_global;}else{$global = '';}
	if(isset($catcbll_cart_shop)){$shop = $catcbll_cart_shop;}else{$shop = '';}
	if(isset($catcbll_cart_single_product)){$single  = $catcbll_cart_single_product;}else{$single = '';}	
	if(isset($catcbll_btn_open_new_tab)){$btn_opnt  = $catcbll_btn_open_new_tab;}else{$btn_opnt = '';}		

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page' ) );
	}
	?>

	<div class="container-fluid pt-3" id="wcatcbll_stng">
		<div class="row">
			<div class="col-md-12">
				<div class='wrap'>
					<div class="catcbll_stng_sidebar">					
						<div class="row mb-3">											
							<div class="col-lg-12 col-12">
								<div class="col-lg-12 col-12 p-0">	
									<h6>Watch Plugin Video</h6>									
								</div>	
								<div class="col-lg-12 col-12 p-0">
									<div class="side_review">	
										<iframe src="https://www.youtube.com/embed/QC1CQ4XIH5Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<p class="mb-0 mt-1 p-1 vido"><a href="https://wordpress.org/support/plugin/woo-custom-cart-button/reviews/" target="_blank">Please Review <i class="fa fa-thumbs-up"></i></a></p>
										<p class="mb-0 mt-1 p-1 vido text-right"><a href="https://www.youtube.com/channel/UClog8CJFaMUqll0X5zknEEQ" class="sub_btn" target="_blank">SUBSCRIBE</a></p>
										<div class="clear"></div>
									</div>
								</div>	
							</div>
						</div>
						<div class="row">											
							<div class="col-lg-12 col-12">	
								<h6>Try Our Other Plugins</h6>								
							</div>
						</div>
						<div class="col-lg-12 col-12">
							<div class="row mb-3">
								<div class="col-lg-12 col-12 p-0 pr-1">	
									<div class="side_review">
										<a href="https://wordpress.org/plugins/text-case-converter/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'text-convertor.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/text-case-converter/" target="_blank">Text Case Converter</a></p>									
									</div>
								</div>
							</div>		
							<div class="row mb-3">											
								<div class="col-lg-12 col-12 p-0 pr-1">
									<div class="side_review">	
										<a href="https://wordpress.org/plugins/awesome-checkout-templates/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'awesome-checkout.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/awesome-checkout-templates/" target="_blank">Awesome Checkout Templates</a></p>
									</div>
								</div>							
							</div>	
							<div class="row mb-3">											
								<div class="col-lg-12 col-12 p-0 pr-1">	
									<div class="side_review">
										<a href="https://wordpress.org/plugins/passwords-manager/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'pasword-manager.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/passwords-manager/" target="_blank">Passwords Manager</a></p>
									</div>
								</div>
							</div>
						</div>					
					</div><!-- close sidemenu-->
					<div id="catcbll_stng_wrap">
						<div id="catcbll_stng_body">
							<?php						
								include(WCATCBLL_CART_INC .'admin/wcatcbll_general_settings.php');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="wcbnl_overlay">
		<div class="cv-spinner">
			<img src="<?php echo WCATCBLL_CART_IMG.'spinner.svg'?>">
		</div>
	</div>
<?php }

?>