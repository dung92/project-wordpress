<?php
	class Rich_Web_Photo_Slider extends WP_Widget
	{
		function __construct()
		{
			$params=array('name'=>'Rich-Web Slider','description'=>'This is the widget of Rich-Web Slider plugin');
			parent::__construct('Rich_Web_Photo_Slider','',$params);
		}
		function form($instance)
		{
			$defaults = array('Rich_Web_Slider'=>'');
			$instance = wp_parse_args((array)$instance, $defaults);
			$Rich_Web_Slider = $instance['Rich_Web_Slider'];
			?>
			<div>
				<p>
					Slider Title:
					<select name="<?php echo $this->get_field_name('Rich_Web_Slider');?>" class="widefat">
						<?php
							global $wpdb;
							$table_name = $wpdb->prefix . "rich_web_photo_slider_manager";
							$Rich_Web_Slider=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d", 0));
							foreach ($Rich_Web_Slider as $Rich_Web_Slider1)
							{
								?> <option value="<?php echo $Rich_Web_Slider1->id;?>"> <?php echo $Rich_Web_Slider1->Slider_Title;?> </option> <?php 
							}
						?>
					</select>
				</p>
			</div>
			<?php
		}
		function widget($args,$instance)
		{
			extract($args);
			$Rich_Web_Slider = empty($instance['Rich_Web_Slider']) ? '' : $instance['Rich_Web_Slider'];
			
			global $wpdb;
			$table_name   = $wpdb->prefix . "rich_web_photo_slider_manager";
			$table_name1  = $wpdb->prefix . "rich_web_photo_slider_instal";
			$table_name1_1  = $wpdb->prefix . "rich_web_photo_slider_instal_video";
			$table_name2  = $wpdb->prefix . "rich_web_slider_effects_data";

			require_once( 'Rich-Web-Slider-Check.php' );
			$Rich_Web_Slider_Manager=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $Rich_Web_Slider));
			$Rich_Web_Slider_Images=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE Sl_Number = %s order by id", $Rich_Web_Slider));
			$Rich_Web_Slider_Videos=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1_1 WHERE Sl_Number = %s order by id", $Rich_Web_Slider));
			$Rich_Web_Slider_Effects=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id = %s", $Rich_Web_Slider_Manager[0]->Slider_Type));
			$RW_IS_queries_arr = ["Slider Navigation"   => "rich_web_slider_effect1,rich_web_slider_ID,rich_web_slider_ID","Content Slider"	  => "rich_web_slider_effect2,richideo_EN_ID,rich_web_slider_ID","Fashion Slider"	  => "rich_web_slider_effect3,rich_web_slider_ID,rich_web_slider_ID", "Circle Thumbnails"  => "rich_web_slider_effect4,rich_web_slider_ID,rich_web_slider_ID"	,"Slider Carousel"	  => "rich_web_slider_effect5,rich_web_slider_ID,rich_web_slider_ID","Flexible Slider"	  => "rich_web_slider_effect6,rich_web_slider_ID,rich_web_slider_ID","Dynamic Slider"	  => "rich_web_slider_effect7,rich_web_slider_ID,rich_web_slider_ID","Thumbnails Slider & Lightbox"	=> "rich_web_slider_effect8,rich_web_slider_ID,rich_web_slider_ID","Accordion Slider"  => "rich_web_slider_effect9,rich_web_slider_ID,rich_web_slider_ID"	,"Animation Slider"	  => "rich_web_slider_effect10,rich_web_slider_ID,rich_web_slider_ID"];
			$query_array = explode(",",$RW_IS_queries_arr[$Rich_Web_Slider_Effects[0]->slider_type]);
			$RW_IS_Q_Table = $wpdb->prefix  . $query_array[0];
			$RW_IS_Load_Q_Table = $wpdb->prefix  . $query_array[0] . "_Loader";
			$Rich_Web_Slider_Effect=$wpdb->get_results($wpdb->prepare("SELECT * FROM $RW_IS_Q_Table WHERE $query_array[1] = %s ",$Rich_Web_Slider_Effects[0]->id));
			$Rich_Web_Slider_Effect_Loader=$wpdb->get_results($wpdb->prepare("SELECT * FROM $RW_IS_Load_Q_Table WHERE $query_array[2] = %s", $Rich_Web_Slider_Effects[0]->id));
			$rich_CS_BIB = ($Rich_Web_Slider_Effect[0]->rich_CS_BIB=='true') ? 'true' : 'false' ;
			$rich_CS_P   =  ($Rich_Web_Slider_Effect[0]->rich_CS_P=='true')  ? 'true'  : 'false' ;
			$rich_CS_Video_TShow   =  ($Rich_Web_Slider_Effect[0]->rich_CS_Video_TShow=='true')  ? 'block'  : 'none' ;
			$rich_CS_Video_DShow   =  ($Rich_Web_Slider_Effect[0]->rich_CS_Video_DShow=='true')  ? 'block'  : 'none' ;
			$padLeft   =  ($rich_CS_Video_Show == '0')  ? '0'  : '10' ;
			switch ($Rich_Web_Slider_Effect[0]->rich_CS_Icon) {
				case 1:  $Rich_PS_Left_Icon='rich_web rich_web-angle-double-left'; $Rich_PS_Right_Icon='rich_web rich_web-angle-double-right';  break;
				case 2:  $Rich_PS_Left_Icon='rich_web rich_web-angle-left'; $Rich_PS_Right_Icon='rich_web rich_web-angle-right';  break;
				case 3:  $Rich_PS_Left_Icon='rich_web rich_web-arrow-circle-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-circle-right';   break;
				case 4:  $Rich_PS_Left_Icon='rich_web rich_web-arrow-circle-o-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-circle-o-right';  break;
				case 5:  $Rich_PS_Left_Icon='rich_web rich_web-arrow-left'; $Rich_PS_Right_Icon='rich_web rich_web-arrow-right';  break;
				case 6:	  $Rich_PS_Left_Icon='rich_web rich_web-caret-left'; $Rich_PS_Right_Icon='rich_web rich_web-caret-right';  break;						
				case 7:	  $Rich_PS_Left_Icon='rich_web rich_web-caret-square-o-left';	$Rich_PS_Right_Icon='rich_web rich_web-caret-square-o-right';  break;						
				case 8:	  $Rich_PS_Left_Icon='rich_web-chevron-circle-left'; $Rich_PS_Right_Icon='rich_web-chevron-circle-right';  break;						
				case 9:	  $Rich_PS_Left_Icon='rich_web rich_web-chevron-left'; $Rich_PS_Right_Icon='rich_web rich_web-chevron-right';  break;						
				case 10:  $Rich_PS_Left_Icon='rich_web rich_web-hand-o-left'; $Rich_PS_Right_Icon='rich_web rich_web-hand-o-right';  break;						
				case 11:  $Rich_PS_Left_Icon='rich_web rich_web-long-arrow-left'; $Rich_PS_Right_Icon='rich_web rich_web-long-arrow-right';  break;												
			}
			$rich_CS_Video_ArrShow   =  ($Rich_Web_Slider_Effect[0]->rich_CS_Video_ArrShow=='true')  ? 'inline-block'  : 'none' ;
			$rich_fsl_SShow	=($Rich_Web_Slider_Effect[0]->rich_fsl_SShow=='false')  ?  false   : true ;
			$rich_fsl_Ic_Show	=($Rich_Web_Slider_Effect[0]->rich_fsl_Ic_Show=='false')  ? false  : true ;
			$rich_fsl_PPL_Show	=($Rich_Web_Slider_Effect[0]->rich_fsl_PPL_Show=='false')  ?  false  : true ;
			$rich_fsl_Randomize	=($Rich_Web_Slider_Effect[0]->rich_fsl_Randomize=='false')  ?  false  : true ;
			$rich_fsl_Loop	=($Rich_Web_Slider_Effect[0]->rich_fsl_Loop=='false')  ? false  : true ;
			$rich_fsl_Desc_Show	=($Rich_Web_Slider_Effect[0]->rich_fsl_Desc_Show=='')  ?  'false' : 'true' ;
			$RW_IS_Divide = explode(" ", $Rich_Web_Slider_Effects[0]->slider_type);
			$RW_IS_Style_Name = ($RW_IS_Divide[0] == "Slider") ? $RW_IS_Divide[1] : $RW_IS_Divide[0] ;
					require( 'Style/RW_Img_Slider_'.$RW_IS_Style_Name.'.css.php' ); 
					require( 'PHP/RW_Img_Slider_'.$RW_IS_Style_Name.'.php' );
					require( 'Scripts/RW_Img_Slider_'.$RW_IS_Style_Name.'.js.php' );
			echo $after_widget;
		}
	}
?>