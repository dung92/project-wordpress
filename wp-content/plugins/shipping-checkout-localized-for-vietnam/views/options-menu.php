<?php
/*
*
* View Name: Plugin options menu view
*
*/

if (!defined('ABSPATH')) exit; ?> 

	<div class="col-md-12 ufa-nav">
		<ul class="nav">
		<?php foreach ($this->settings_page_menu() as $k => $menu_item) { ?>
			<li class="nav-item <?php echo (@$_GET['page'] == $k) ? 'active' : ''; ?>" style="margin-right: 1.5em;">
				<a href="<?php echo admin_url('admin.php?page='.$k); ?>"><?php echo $menu_item; ?></a>
			</li>
		<?php } ?>
		
			<li class="nav-item nav-item-support">
				<a href="mailto:support@bluecoral.vn" data-toggle="tooltip" data-placement="top" title="<?php _e('Need Support ?', $this->domain); ?>">
					<i class="dashicons dashicons-sos"></i> 
					<span class="label"><?php _e('Need Support ?', $this->domain); ?></span>
				</a>
			</li>
			<li class="nav-item nav-item-beer">
				<a href="https://go.bluecoral.vn/buymeabeer" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php _e('Buy me a beer!', $this->domain); ?>">
					<i class="dashicons dashicons-beer"></i>
					<span class="label"><?php _e('Buy me a beer!', $this->domain); ?></span>
				</a>
			</li>
		</ul>
	</div>