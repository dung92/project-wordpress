<?php
/*
*
* View Name: Plugin options view
*
*/

if (!defined('ABSPATH')) exit;

global $lwc_options; ?>

	<div class="wrap ufa-wrap">
	<?php do_action('lwc_option_screen_header'); ?>
	
		<div class="ufa-container">
		<?php $this->render_view('options-header'); ?>
			
		<?php $this->render_view('options-menu'); ?>
		
			<div class="col-md-12">
				<form method="POST" autocompleted="off" class="ufa-form">
					<div class="form-header">
						<div class="row">
							<div class="col-md-12 col-border-bottom border-margin">
								<h2><?php _e('General Settings', $this->domain); ?></h2>
							</div>
						</div>
					</div>
					
				<?php do_action('lwc_option_form_header'); ?>
					
					<div class="form-content">
					<?php $form = new WLFVN_Forms(
						array(
							array(
								'type' => 'group',
								'items' => array(
									array(
										'type' => 'checkbox',
										'name' => 'enabled_symbol',
										'title' => __('Currency symbol', $this->domain),
										'label' => __('Enable/Disable currency symbol', $this->domain),
									),
									array(
										'type' => 'text',
										'name' => 'symbol_text',
										'title' => 'inherit',
										'label' => __('Please enter your currency symbol.', $this->domain),
										'required' => true,										
										'default_value' => 'vnđ',
										'description' => sprintf(
											__('You can change the currency position or number separator at <a href="%s" target="_blank">Woocommerce setting</a>.', $this->domain), 
											admin_url('admin.php?page=wc-settings#woocommerce_currency_pos')
										),
										'class_input' => 'form-control-small',
									),
								),
							),
							array(
								'type' => 'group',
								'items' => array(
									array(
										'type' => 'checkbox',
										'name' => 'enabled_rate',
										'title' => __('Supporting Paypal Standard Gateway', $this->domain),
										'label' => __('Enable/Disable supporting feature for Paypal Standard.', $this->domain),
									),
									array(
										'type' => 'number',
										'name' => 'rate_value',
										'title' => 'inherit',
										'label' => __('Example: 23500', $this->domain),
										'required' => true,										
										'default_value' => 'vnđ',
										'description' => sprintf(
											__('You can input currency exchange rate to VNĐ. Configure <a href="%s" target="_blank">your Paypal Standard Gateway</a>.', $this->domain),
											admin_url('admin.php?page=wc-settings&tab=checkout&section=paypal')
										),
										'class_input' => 'form-control-small',
									),
								),
							),
							array(
								'type' => 'group',
								'items' => array(
									array(
										'type' => 'wc_default_address_fields',
										'title' => __('WC Address field', $this->domain),
										'items' => $this->get_wc_fields(),
									),
								),
							),
							array(
								'type' => 'group',
								'items' => array(
									array(
										'type' => 'checkbox',
										'name' => 'enabled_vn_ward',
										'title' => __('Vietnamese Wards', $this->domain),
										'label' => __('Enable/Disable supporting feature for Vietnamese wards and commune.', $this->domain),
										'description' => sprintf(
											__('Plugin <a href="%s" target="_blank">States, Cities, and Places for WooCommerce</a> is required.', $this->domain), 
											'https://wordpress.org/plugins/states-cities-and-places-for-woocommerce/'
										),
									),
								),
							),
						),
						$lwc_options
					); 
					echo $form->get_forms(); ?>
					</div>
					
				<?php do_action('lwc_option_form_end'); ?>
					
					<div class="form-footer">
						<button type="submit" name="submit_lwc" id="submit" class="btn btn-primary" value="Save Changes"><?php _e('Save Changes'); ?></button>
					</div>
					
				<?php do_action('lwc_option_form_footer'); ?>
				</form>
				
			</div>
		
		</div>
	
	<?php do_action('lwc_option_screen_footer'); ?>
	</div>