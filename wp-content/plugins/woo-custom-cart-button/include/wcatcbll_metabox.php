<?php
//Adding meta box to product page
function catcbll_atc_register_meta_box() {
		add_meta_box( 'wcatc_meta_box', esc_html__(__('Product Custom Button Settings', 'catcbll') ), 'catcbll_atc_meta_box_callback', 'product', 'advanced', 'high' );
}
add_action( 'add_meta_boxes', 'catcbll_atc_register_meta_box');

// Meta box HTML.
if ( ! function_exists( 'catcbll_atc_meta_box_callback' ) ){
	function catcbll_atc_meta_box_callback( $meta_id ) {
		wp_nonce_field(basename(__FILE__), "wcatcbnl-nonce");
		$catcbll_btn_lbl = get_post_meta( $meta_id->ID, '_catcbll_btn_label',true );
		$catcbll_btn_act = get_post_meta( $meta_id->ID,'_catcbll_btn_link',true );			
		// button label
		if(isset($catcbll_btn_lbl)){$btn_lbl = $catcbll_btn_lbl;} else{$btn_lbl = "";}
		// button url
		if(isset($catcbll_btn_act)){$btn_url = $catcbll_btn_act;}else{$btn_url = "";}
		
		// if label exist count label
		if((isset($btn_lbl)) && ($btn_lbl !='')){$btn_lbl_count = count($btn_lbl);}else{$btn_lbl_count = 0;}
		// if label count >= 1
		if($btn_lbl_count >= 1){
			$outline = '';
			$outline .='<div class="catcbll_clone">';
			$outline .='<button id="catcbll_add_btn" class="catcbll_add_btn">'. esc_html__(__('Add New', 'catcbll')) .'</button>';
			$outline .='</div>';
			for ($y = 0; $y < $btn_lbl_count; $y++) {
				$outline .='<div id="main_fld_'.$y.'" class="main_prd_fld"><div id="wcatcbll_wrap_'.$y.'" class="wcatcbll_wrap">';
				$outline .='<div class="wcatcbll" id="wcatcbll_prdt_'.$y .'" >';
				$outline .='<div class="wcatcbll_mr_100"><span class="tgl-indctr" aria-hidden="true"></span><button id="btn_remove_' . $y .'" class="btn_remove top_prd_btn" data-field="'.$y.'">'. esc_html__(__('Remove', 'catcbll')) .'</button></div>';
				$outline .='</div>';
				$outline .='</div>';
				$outline .='<div class="wcatcbll_content" id="wcatcbll_fld_'.$y.'"><div class="wcatcbll_p-20">';
				$outline .= '<label for="wcatcbll_atc_text" style="width:150px; display:inline-block;">'. esc_html__(__('Label', 'catcbll')) .'</label>';

				$outline .= '<input type="text" name="wcatcbll_wcatc_atc_text[]" class="title_field" value="'. esc_attr($btn_lbl[$y]) .'" style="width:300px;" placeholder="'.__('Add To Basket or Shop Now or Shop on Amazon','catcbll').'"/>&nbsp;<div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext">'.  esc_html__(__('This text will be shown on the button linking to the external product', 'catcbll')) .'</span></div>';
				$outline .= '<br><br>';
				$outline .= '<label for="title_field" style="width:150px; display:inline-block;">'. esc_html__(__('Url', 'catcbll')) .'</label>';
				$outline .= '<input type="url" name="wcatcbll_wcatc_atc_action[]" class="title_field" value="'. esc_url_raw($btn_url[$y]) .'" style="width:300px;" placeholder="https://hirewebxperts.com"/>&nbsp;<div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext">'.  esc_html__(__('Enter the external URL to the product', 'catcbll')) .'</span></div>';
				$outline .='</div></div></div>';
			}// end for each
			$outline .='<div id="wcatcbll_repeat" class="wcatcbll_repeat"></div> ';				
		}else{
			$outline = '';
			$outline .='<div class="catcbll_clone" style="background:#fff">';
			$outline .='<input type="hidden"  name="catcbll_hidden_counter" id="catcbll_hide_value" value="0" /><button id="catcbll_add_btn" class="catcbll_add_btn">'. esc_html__(__('Add New', 'catcbll')) .'</button>';
			$outline .='</div>';
			$outline .='<div id="main_fld_0" class="main_prd_fld"><div id="wcatcbll_wrap_0" class="wcatcbll_wrap">';
			$outline .='<div class="wcatcbll" id="wcatcbll_prdt_0" style="display:none">';
			$outline .='<div class="wcatcbll_mr_100"><span class="tgl-indctr" aria-hidden="true"></span><button class="btn_remove top_prd_btn" data-field="1">'. esc_html__(__('Remove', 'catcbll')) .'</button></div></div>';
			$outline .='</div>';
			$outline .='<div class="wcatcbll_content" id="wcatcbll_fld_0"><div class="wcatcbll_p-20">';
			$outline .= '<label for="wcatcbll_atc_text" style="width:150px; display:inline-block;">'. esc_html__(__('Label', 'catcbll')) .'</label>';

			$outline .= '<input type="text" name="wcatcbll_wcatc_atc_text[]" class="title_field" value="" style="width:300px;" placeholder="'.__('Add To Basket or Shop Now or Shop on Amazon','catcbll').'"/>&nbsp;<div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext">'.  esc_html__(__('This text will be shown on the button linking to the external product', 'catcbll')) .'</span></div>';
			$outline .= '<br><br>';
			$outline .= '<label for="title_field" style="width:150px; display:inline-block;">'. esc_html__(__('Url', 'catcbll')) .'</label>';

			$outline .= '<input type="url" name="wcatcbll_wcatc_atc_action[]" class="title_field" value="" style="width:300px;" placeholder="https://hirewebxperts.com"/>&nbsp;<div class="wcatcblltooltip"><i class="fa fa-question-circle" aria-hidden="true"></i><span class="wcatcblltooltiptext">'.  esc_html__(__('Enter the external URL to the product', 'catcbll')) .'</span></div>';

			$outline .='</div></div></div>';
			$outline .='<div id="wcatcbll_repeat" class="wcatcbll_repeat"></div> ';			
		}//end else
		echo $outline;
	}
}

/**
* Insert values in postmeta table.
*/
if ( ! function_exists( 'wcatcbnl_wcatc_atc_save_postdata' ) ){
	function wcatcbnl_wcatc_atc_save_postdata($post_id, $post, $update){
		if (!isset($_POST["wcatcbnl-nonce"]) || !wp_verify_nonce($_POST["wcatcbnl-nonce"], basename(__FILE__)))
			return $post_id;

		if(!current_user_can("edit_post", $post_id))
			return $post_id;

		if(isset($_POST) && !empty($_POST['action']) && $_POST['action'] == 'editpost'){
			if(!empty($_POST['wcatcbll_wcatc_atc_text']) || !empty($_POST['wcatcbll_wcatc_atc_action'])){
				
				foreach($_POST['wcatcbll_wcatc_atc_text'] as $lbl_key => $lbl_val){
					$btn_lbl_name[] = sanitize_text_field($lbl_val);					
				}// end foreach for label

				foreach($_POST['wcatcbll_wcatc_atc_action'] as $url_key => $url_val){
					$btn_act_url[] = sanitize_trackback_urls($url_val);
					
				}//end forech for url				
				update_post_meta($post_id,'_catcbll_btn_label',$btn_lbl_name);
				update_post_meta($post_id,'_catcbll_btn_link',$btn_act_url);
			}//end if !empty
		}// end if isset($_POST)
	}//end function
}// end !function_exists
add_action('save_post', 'wcatcbnl_wcatc_atc_save_postdata',10,3);
?>