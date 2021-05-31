<?php
/*
*
* Forms
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('WLFVN_Forms')) {
	class WLFVN_Forms {
		
		protected $options, 
				$post_data, 
				$col_layout = 3,
				$domain = 'shipping-checkout-localized-for-vietnam';
	
		/**
		* Class Construct
		*/
		public function __construct(array $options = array(), array $post_data = array()) {
			$this->options = $options;
			$this->post_data = $post_data;
		}
		
		public function set_col(int $col = 3) {
			$this->col_layout = $col;
		}
		
		public function get_options() {
			return $this->options;
		}
		
		public function get_forms() {
			ob_start();
			
			echo $this->get_form_items();
			
			return ob_get_clean();
		}
		
		function get_form_items() {
			$form = '';
			
			if (count($this->options) === 0) return $form;
			
			foreach ($this->options as $option) {
				$form .= $this->get_form_item($option);
			}
			
			return $form;
		}
		
		function get_form_item(array $data = array()) {
			$control = '';
			$col_layout = (empty($data['col_layout'])) ? $this->col_layout : (int) $data['col_layout'];
			
			if (empty(@$data['type'])) return $control;
			
			if ($data['type'] === 'group') {
				$control .= $this->get_form_item_group($data);
			} else {
				extract($data);
				$layout = @$data['layout'] ?? 'row';
				$col_header = (!empty($title)); // boolean
				$col_content_class = 'col-content col-md-' . (($col_header) ? (12 - $col_layout) : 12);
				$col_content_class .= $class_content_wrapper ?? '';
				
				$control .= '<div class="' . esc_attr($layout) . '">';
				
				if ($col_header) { 
					$control .= $this->get_form_item_header($data);
				}
				
				$control .= '<div class="' . esc_attr($col_content_class) . '">';
				switch ($data['type']) {
					case 'checkbox':
					case 'color':
					case 'date':
					case 'number':
					case 'radio':
					case 'text':
						$control .= $this->get_form_item_input($data);
						break;
						
					case 'select':
						$control .= $this->get_form_item_select($data);
						break;
						
					case 'wc_default_address_fields':
						$control .= $this->get_form_item_wc_address_fields($data);
						break;
						
					default:
						$control .= '';
				}
				if (!empty($description)) {
					$control .= '<p class="description">' . $description . '</p>';
				}
				$control .= '</div>';
				$control .= '</div>';
			}			
			
			return apply_filters('bc_form_'.$data['type'], $control, $data);
		}
		
		function get_form_item_header(array $data = array()) {
			extract($data);
			$col_layout = (empty($col_layout)) ? $this->col_layout : (int) $col_layout;
			
			ob_start(); ?>
				<div class="col-md-<?php echo $col_layout; ?> col-header"><?php echo ($title === 'inherit') ? '' : $title; ?></div>
			<?php return ob_get_clean();
		}
		
		function get_form_item_group(array $data = array()) {
			if (empty(@$data['items'])) return '';
			
			ob_start(); ?>
				<div class="form-group">
				<?php foreach ($data['items'] as $item) {
					echo $this->get_form_item($item);
				} ?>
				</div>			
			<?php return ob_get_clean();
		}
		
		function get_form_item_input(array $data = array()) {
			extract($data);
			$data_value = @$this->post_data[$name];
			$input_class = 'form-control ' . ($class_input ?? '');
			$required = (isset($required)) ? (bool) $required : false;
			
			if (isset($default_value) && !isset($data_value)) {
				$data_value = $default_value;
			}
			
			ob_start(); ?>
			
			<?php if ($type === 'checkbox') { ?>
				<p>
					<label for="<?php echo esc_attr($name); ?>">
						<input name="<?php echo esc_attr($name); ?>" type="hidden" value="0" />
						<input type="<?php echo esc_attr($type); ?>"
							id="<?php echo esc_attr($name); ?>"
							name="<?php echo esc_attr($name); ?>"
							class="<?php echo esc_attr($input_class); ?>"
							<?php checked($data_value, 1); ?>
							value="1" />
						<?php echo $label; ?>
					</label>
				</p>
			<?php } else { ?>
				<input type="<?php echo esc_attr($type); ?>"
					id="<?php echo esc_attr($name); ?>"
					name="<?php echo esc_attr($name); ?>"
					class="<?php echo esc_attr($input_class); ?>"
					value="<?php echo esc_attr($data_value); ?>"
					placeholder="<?php echo esc_attr($label); ?>"
					<?php $this->is_required($required); ?> />
			<?php } ?>
				
			<?php return ob_get_clean();
		}
		
		function get_form_item_select(array $data = array()) {
			extract($data);
			$data_value = @$this->post_data[$name];
			$input_class = 'form-control ' . ($class_input ?? '');
			$required = (isset($required)) ? (bool) $required : false;
			
			if (isset($default_value) && !isset($data_value)) {
				$data_value = $default_value;
			}
			
			ob_start(); ?>
			
				<select id="<?php echo esc_attr($name); ?>"
						name="<?php echo esc_attr($name); ?>"
						class="<?php echo esc_attr($input_class); ?>">
				<?php foreach ($select_items as $val => $text) { ?>
					<option value="<?php echo esc_attr($val); ?>" <?php selected($data_value, $val); ?>><?php echo $text; ?></option>
				<?php } ?>
				</select>
			<?php return ob_get_clean();
		}
		
		function get_form_item_wc_address_fields(array $data = array()) {
			extract($data);
			
			$html = '';
			
			foreach ($items as $key => $name) {
				$html .= $this->get_form_item(
					array(
						'type' => 'select',
						'name' => $key.'_status',
						'title' => $name,
						'select_items' => array(
							WLFVN_ShippingCheckout::WC_CHECKOUT_FIELD_STATUS_DEFAULT => __('Default'),
							WLFVN_ShippingCheckout::WC_CHECKOUT_FIELD_STATUS_REQUIRED => sprintf(
								__('Field [%s] is required', $this->domain),
								$name
							),
							WLFVN_ShippingCheckout::WC_CHECKOUT_FIELD_STATUS_OPTIONAL => sprintf(
								__('Field [%s] is optional', $this->domain),
								$name
							),
							WLFVN_ShippingCheckout::WC_CHECKOUT_FIELD_STATUS_HIDDEN => sprintf(
								__('Field [%s] is hidden', $this->domain),
								$name
							),
						),
						'required' => false,
						'class_input' => 'form-control-small',
						'col_layout' => 2,
						'layout' => 'form-row',
					)				
				);
				$html .= $this->get_form_item(
					array(
						'type' => 'text',
						'name' => $key.'_text',
						'title' => 'inherit',
						'label' => sprintf(
							__('Please enter your custom text for [%s]', $this->domain),
							$name
						),
						'required' => false,	
						'class_input' => 'form-control-small',
						'col_layout' => 2,
						'layout' => 'form-row',
					)				
				);
			}
			
			return $html;
		}
		
		function is_required(bool $flag = true) {
			echo ($flag) ? 'required' : '';
		}
		
	}	
}
