<?php
//about theme info
add_action( 'admin_menu', 'vw_furniture_carpenter_gettingstarted' );
function vw_furniture_carpenter_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Furniture Carpenter', 'vw-furniture-carpenter'), esc_html__('About VW Furniture Carpenter', 'vw-furniture-carpenter'), 'edit_theme_options', 'vw_furniture_carpenter_guide', 'vw_furniture_carpenter_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function vw_furniture_carpenter_admin_theme_style() {
   wp_enqueue_style('vw-furniture-carpenter-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
   wp_enqueue_script('vw-furniture-carpenter-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
   wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'vw_furniture_carpenter_admin_theme_style');

//guidline for about theme
function vw_furniture_carpenter_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'vw-furniture-carpenter' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to VW Furniture Carpenter Theme', 'vw-furniture-carpenter' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-furniture-carpenter'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Furniture Carpenter at 20% Discount','vw-furniture-carpenter'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-furniture-carpenter'); ?> ( <span><?php esc_html_e('vwpro20','vw-furniture-carpenter'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-furniture-carpenter' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
			<button class="tablinks" onclick="vw_furniture_carpenter_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'vw-furniture-carpenter' ); ?></button>
		  	<button class="tablinks" onclick="vw_furniture_carpenter_open_tab(event, 'theme_lite')"><?php esc_html_e( 'Setup With Customizer', 'vw-furniture-carpenter' ); ?></button>		  
		  	<button class="tablinks" onclick="vw_furniture_carpenter_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'vw-furniture-carpenter' ); ?></button>
		  	<button class="tablinks" onclick="vw_furniture_carpenter_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'vw-furniture-carpenter' ); ?></button>
		</div>

		<!-- Tab content -->
		<div id="block_pattern" class="tabcontent open">
			<div class="block-pattern-img">
				<h3><?php esc_html_e( 'Block Patterns', 'vw-furniture-carpenter' ); ?></h3>
				<hr class="h3hr">
				<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','vw-furniture-carpenter'); ?></p>
	          	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','vw-furniture-carpenter'); ?></span></b></p>
	          	<div class="vw-furniture-carpenter-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>" target="_blank" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','vw-furniture-carpenter'); ?></a>
			    </div>
	          	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />	
	        </div>

	        <div class="block-pattern-link-customizer">
              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-furniture-carpenter' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-furniture-carpenter'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-furniture-carpenter'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-furniture-carpenter'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-furniture-carpenter'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-furniture-carpenter'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-furniture-carpenter'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-furniture-carpenter'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-furniture-carpenter'); ?></a>
								</div> 
							</div>
						</div>
				</div>	
			</div>
		</div>
		
		<div id="theme_lite" class="tabcontent">
			<h3><?php esc_html_e( 'Lite Theme Information', 'vw-furniture-carpenter' ); ?></h3>
			<hr class="h3hr">
		  	<p><?php esc_html_e('VW Furniture Carpenter is a wonderful choice when it comes to excelling the business of the furniture shop and selling the furniture products across a wider platform of e-business. This WordPress theme is also an excellent choice for the interior shop or in case you have opened a wood shop related to house decoration furniture, you can but this one and it is a good choice for your furniture business and besides this, it is available at an affordable rate in the market. This WordPress Wood theme is also a preferable choice for the carpenters and joiners and also for builders and constructors who provide the finest solutions in the area of wood manufacturing and carpentry business. It is also applicable to the core in a case you are interested to make a professional and apt website related to the renovation services. Furniture and carpentry theme from VW is a good option for the home repair business as well as door and window installations. It also has a tremendous use for the air conditioning and solar system services. The credit goes to its string features like the multipurpose nature and besides this, it is  not only minimal but sophisticated and elegant as well. ','vw-furniture-carpenter'); ?></p>
		  	<div class="col-left-inner">
		  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-furniture-carpenter' ); ?></h4>
				<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-furniture-carpenter' ); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-furniture-carpenter' ); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Theme Customizer', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-furniture-carpenter'); ?></a>
				</div>
				<hr>				
				<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-furniture-carpenter'); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Reviews & Testimonials', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-furniture-carpenter'); ?>  </p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-furniture-carpenter'); ?></a>
				</div>
		  		<div class="link-customizer">
					<h3><?php esc_html_e( 'Link to customizer', 'vw-furniture-carpenter' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-furniture-carpenter'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Section','vw-furniture-carpenter'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-welcome-write-blog"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_topbar') ); ?>" target="_blank"><?php esc_html_e('Contact Section','vw-furniture-carpenter'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-furniture-carpenter'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-furniture-carpenter'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=vw_furniture_carpenter_typography') ); ?>" target="_blank"><?php esc_html_e('Typography','vw-furniture-carpenter'); ?></a>
							</div>
						</div>

						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-furniture-carpenter'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-furniture-carpenter'); ?></a>
							</div> 
						</div>
						
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_furniture_carpenter_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-furniture-carpenter'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-furniture-carpenter'); ?></a>
							</div> 
						</div>
					</div>
				</div>
		  	</div>
			<div class="col-right-inner">
				<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-furniture-carpenter'); ?></h3>
			  	<hr class="h3hr">
				<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-furniture-carpenter'); ?></p>
                <ul>
                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','vw-furniture-carpenter'); ?></span><?php esc_html_e(' Go to ','vw-furniture-carpenter'); ?>
				  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','vw-furniture-carpenter'); ?></b></p>

                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','vw-furniture-carpenter'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-furniture-carpenter'); ?></span><?php esc_html_e(' Go to ','vw-furniture-carpenter'); ?>
				  	<b><?php esc_html_e(' Settings >> Reading ','vw-furniture-carpenter'); ?></b></p>
				  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','vw-furniture-carpenter'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
                  	<p><?php esc_html_e(' Once you are done with this, then follow the','vw-furniture-carpenter'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-vw-furniture-carpenter/" target="_blank"><?php esc_html_e('Documentation','vw-furniture-carpenter'); ?></a></p>
                </ul>
		  	</div>
		</div>	

		<div id="theme_pro" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-furniture-carpenter' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('Premium carpenter WordPress theme is one of the special choices for you that are perfect in all angles in establishing your carpentry business and taking your wood business to an altogether different level with the expansion possibilities to the different regions of the globe. It is minimalistic and sophisticated one and is also applicable to the allied business like some construction sectors or the renovation services. Because of the responsive nature of the carpenter WordPress theme, it has achieved global acclaim and apart from that it is not only professional but also has the personalization options accompanied with it. It is beautiful and comes with the optimised codes and besides that, it has the call to action button [CTA] and clean and secure code. It is mobile friendly and operates on the Bootstrap technology apart from being translation ready. It has WooCommerce feature making it fit for online shops for global sales.','vw-furniture-carpenter'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-furniture-carpenter'); ?></a>
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'vw-furniture-carpenter'); ?></a>
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-furniture-carpenter'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-furniture-carpenter' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-furniture-carpenter'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-furniture-carpenter'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><?php esc_html_e('16', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-furniture-carpenter'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'vw-furniture-carpenter'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-furniture-carpenter'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-furniture-carpenter'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-furniture-carpenter'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-furniture-carpenter'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-furniture-carpenter'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'vw-furniture-carpenter'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-furniture-carpenter'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_FURNITURE_CARPENTER_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-furniture-carpenter'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>