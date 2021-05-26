<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<script>
	function RW_IS_Filter_Options(x) {
		event.preventDefault();
        if (x == 'all') {
            jQuery('.Rich_Web_IS_Opt_Content').css('display', '');
        } else{
            jQuery('.Rich_Web_IS_Opt_Content').css('display', 'none');
            jQuery('.'+x).css('display', '');
        } 
        jQuery('.RW_IS_Nav_Bar_Button').removeClass('active')
        jQuery('.RW_IS_Nav_Bar .' + x).addClass('active')
    }
	function Rich_Web_IS_DPre(x){
		event.preventDefault();
		var link = {Navigation:"https://rich-web.org/wp-image-slider-navigation",Fashion:"https://rich-web.org/wp-image-slider-fashion",Carousel:"https://rich-web.org/wp-image-slider-carousel/",Flexible:"https://rich-web.org/wp-image-slider-flexible/",Dynamic:"https://rich-web.org/wp-image-slider-dynamic",Accordion:"https://rich-web.org/wp-image-slider-accordion",Animation:"https://rich-web.org/wp-image-slider-animation/",Circle:"https://rich-web.org/wp-image-slider-circle-thumbnails/",Thumbnails:"https://rich-web.org/wp-image-slider-thumbnail-lightbox/",Content:"https://rich-web.org/wp-image-slider-content"};
		window.open(link[x],'_blank');
	}
	function Rich_Web_IS_Insert(Option_Type){
		event.preventDefault();
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_Type).addClass("Rich_Web_IS_Opt_Content_H");
		jQuery('#Rich_Web_IS_Icon_Opt_'+Option_Type).html('<button class="rw_is_icon_spinner"><i class="rich_web rich_web-refresh  rich_web_imgslide-spin"></i>Inserting</button>');
		if(!navigator.onLine) {
			jQuery('#Rich_Web_IS_Icon_Opt_'+Option_Type).html('<button class="rw_is_icon_spinner" style="background-color: #ff7878;background-image: linear-gradient(315deg, #ff7878 0%, #ff0000 74%);" ><i class="rich_web rich_web-warning  " style="margin-right:10px;animation: scaledAnim 0.5s alternate infinite ease-in; color:#ffffff;" ></i>No Internet</button>');
   		 } else {
		var ajaxurl = object.ajaxurl;
		var data = {
        	action: 'Rich_Web_IS_Insert_Option',
        	Type: Option_Type,
    	};
		jQuery.post(ajaxurl, data, function(response) {
			responseData = jQuery.parseJSON(response); 
			jQuery('#Rich_Web_IS_Icon_Opt_'+Option_Type).children('button').html('<i class="Rich_Web_Tabs_Install rich_web rich_web-check"></i> Inserted');
			setTimeout(() => {
			jQuery('#Rich_Web_IS_Opt_Content_'+Option_Type).removeAttr('id').attr('id','Rich_Web_IS_Opt_Content_'+responseData.id);
			jQuery('#Rich_Web_IS_Opt_Content_'+responseData.id).removeClass("Rich_Web_IS_Opt_Content_H");
			jQuery('#Rich_Web_IS_Opt_Content_'+responseData.id).children('img').attr('alt',responseData.slider_name);
			jQuery('#Rich_Web_IS_Icon_Opt_'+Option_Type).removeAttr('id').attr('id','Rich_Web_IS_Icon_Opt_'+responseData.id);
			jQuery('#Rich_Web_IS_Icon_Opt_'+responseData.id).html('<div class="Rich_Web_IS_Icon"   onclick="Rich_Web_IS_Edit_Opt('+responseData.id+')"><i class="Rich_Web_IS_Edit rich_web rich_web-pencil"></i></div>	<div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Copy_Opt('+responseData.id+')"><i class="Rich_Web_IS_Copy rich_web rich_web-files-o"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Delete_Opt('+responseData.id+')"><i class="Rich_Web_IS_Del rich_web rich_web-trash"></i></div>')
			jQuery('#Rich_Web_IS_Opt_Content_'+responseData.id).children('h4').text(responseData.slider_name);
			}, 600);
		});
	}
	}
	function addSliderJ2()
	{
		jQuery( "#JAddSlider2" ).attr('onclick',"window.open('https://rich-web.org/wp-image-slider/','_blank')").attr('style','box-shadow: 0px 0px 2px #af0000;    background-color: #990000; background-image: linear-gradient(147deg, #990000 0%, #ff0000 74%); width:initial; ').html('<i class="rich_web rich_web-warning  " style="margin-right:10px;animation: scaledAnim 0.5s alternate infinite ease-in; color:#ffffff;" ></i>Pro Option');
	}
	function stugel_rw(str)
	{
		if(jQuery("#Rich_Web_"+str+"_L_T").val() == "Type 1") { jQuery(".Loder_1_Option").show(); } else { jQuery(".Loder_1_Option").hide(); }
	}
	function stugel_rw_lt(str)
	{
		if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 1") { jQuery(".rw_text_color").hide(); jQuery(".rw_text_color1").show(); }
		else if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 2") { jQuery(".rw_text_color").hide(); jQuery(".rw_text_color2").show(); }
		else if(jQuery("#Rich_Web_"+str+"_LT_T").val() == "Type 3") { jQuery(".rw_text_color").hide(); jQuery(".rw_text_color3").show(); }
		else { jQuery(".rw_text_color").hide(); }
	}
	function change_rw_tr(str) { stugel_rw(str); }
	function change_rw_ltt(str) { stugel_rw_lt(str); }
	function canselSliderJ2() { location.reload(); }

	function Rich_Web_IS_Edit_Opt(Option_ID)
	{		
		event.preventDefault();
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).addClass("Rich_Web_IS_Opt_Content_H");
		jQuery('#Rich_Web_IS_Icon_Opt_'+Option_ID).html('<button class="rw_is_icon_spinner"><i class="rich_web rich_web-refresh  rich_web_imgslide-spin"></i>Editing</button>');
		jQuery(".rw_loading_c").show();
		jQuery('#rw_is_name_hid_in').attr('value',Option_ID);
		var ajaxurl = object.ajaxurl;
		var data = {
		action: 'rich_web_Edit_Option', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: Option_ID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			var data = JSON.parse(response)
			jQuery("input[name='rich_web_Slider_UP_ID']").val(data[0][0]['richideo_EN_ID']);
			for(i=0;i<data.length;i++)
			{
				for(var key in data[i][0])
				{
					if( data[i][0][key] == 'true' || data[i][0][key] == 'on' ) { jQuery("#"+key).attr('checked',true); }
					else if( data[i][0][key] == 'false' || data[i][0][key] == '' || data[i][0][key] == 'none' ) { jQuery("#"+key).attr('checked',false); }
					else { jQuery("#"+key).val(data[i][0][key]); }
					if(jQuery("."+key).val()) { jQuery("."+key).val(data[i][0][key]); }
				}
			}
			var answer = data[0][0]['rich_web_slider_type'];
			if(answer=='Slider Navigation') { jQuery('.rich_web_SaveSl_Table_2_1').show(); stugel_rw("NSL"); stugel_rw_lt("NSL"); }
			else if(answer=='Content Slider') { jQuery('.rich_web_SaveSl_Table_2_2').show(); stugel_rw("ContSl"); stugel_rw_lt("ContSl"); }
			else if(answer=='Fashion Slider') { jQuery('.rich_web_SaveSl_Table_2_3').show(); stugel_rw("FSl"); stugel_rw_lt("FSl"); }
			else if(answer=='Circle Thumbnails') { jQuery('.rich_web_SaveSl_Table_2_4').show(); stugel_rw("CircleSl"); stugel_rw_lt("CircleSl"); }
			else if(answer=='Slider Carousel') { jQuery('.rich_web_SaveSl_Table_2_5').show(); stugel_rw("CarSl"); stugel_rw_lt("CarSl"); }
			else if(answer=='Flexible Slider') { jQuery('.rich_web_SaveSl_Table_2_6').show(); stugel_rw("FlexibleSl"); stugel_rw_lt("FlexibleSl"); }
			else if(answer=='Dynamic Slider') { jQuery('.rich_web_SaveSl_Table_2_7').show(); stugel_rw("DynamicSl"); stugel_rw_lt("DynamicSl"); }
			else if(answer=='Thumbnails Slider & Lightbox') { jQuery('.rich_web_SaveSl_Table_2_8').show(); stugel_rw("ThSl"); stugel_rw_lt("ThSl"); }
			else if(answer=='Accordion Slider') { jQuery('.rich_web_SaveSl_Table_2_9').show(); stugel_rw("AccSl"); stugel_rw_lt("AccSl"); }
			else if(answer=='Animation Slider') { jQuery('.rich_web_SaveSl_Table_2_10').show(); stugel_rw("AnimSl"); stugel_rw_lt("AnimSl"); }
			jQuery('#rich_web_slider_type').hide();
			rangeSlider();
			jQuery('#JAddSlider2').remove();
			jQuery( 'input.alpha-color-picker' ).alphaColorPicker();
			jQuery('.wp-color-result').attr('title','Select');
			jQuery('.wp-color-result').attr('data-current','Selected');
			jQuery(".rw_loading_c").hide();
		})
		setTimeout(function(){
			jQuery('.Table_Data_rich_web1_2').css('display','none');
			jQuery('.JAddSlider2').addClass('JAddSlider2Anim');
			jQuery('.RW_Support_btn').parent().css({'left':'8px','right':'initial',});
			jQuery('.Table_Data_rich_web2_2').css('display','block');
			jQuery('.JUpdateSlider2').addClass('JSaveSlider2Anim');
			jQuery('.JCanselSlider2').addClass('JCanselSlider2Anim');
		},1000)
	}
	function Rich_Web_IS_Delete_Opt(Option_ID)
	{	
		event.preventDefault();
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).addClass("Rich_Web_IS_Opt_Content_H");
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).children('.Rich_Web_IS_Name').html('<i class="Rich_Web_IS_Trash rich_web rich_web-trash"></i>Are you sure you want to remove ?');
		jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).html('<button class="rw_is_but_cancel" onclick="Rich_Web_IS_Delete_Opt_No('+Option_ID+')" >Cancel</button><button class="rw_is_but_delete" onclick="Rich_Web_IS_Delete_Opt_Yes('+Option_ID+')" > Delete</button>');
		jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).css('top','65%');
	}
	function Rich_Web_IS_Delete_Opt_No(Option_ID)
	{
		event.preventDefault();
		var Option_Name = jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).children('img').attr('alt');
		var Opt_Icons = "<div class='Rich_Web_IS_Icon' onclick='Rich_Web_IS_Edit_Opt(" + Option_ID +")'><i class='Rich_Web_Tabs_Edit rich_web rich_web-pencil'></i></div><div class='Rich_Web_IS_Icon'onclick='Rich_Web_IS_Copy_Opt(" +Option_ID +")'><i class='Rich_Web_Tabs_Copy rich_web rich_web-files-o'></i></div><div class='Rich_Web_IS_Icon' onclick='Rich_Web_IS_Delete_Opt(" +Option_ID + ")'><i class='Rich_Web_Tabs_Del rich_web rich_web-trash'></i></div>";
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).children('.Rich_Web_IS_Name').html(Option_Name);
		jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).html(Opt_Icons);
		jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).css('top','37%');
		jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).removeClass("Rich_Web_IS_Opt_Content_H");
	}
	function Rich_Web_IS_Delete_Opt_Yes(Option_ID)
	{
	event.preventDefault();
	jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).children('.Rich_Web_IS_Name').html(jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID).children('img').attr('alt'));
	jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).css('top','37%');
	jQuery('#Rich_Web_IS_Icon_Opt_' + Option_ID).html('<button class="rw_is_icon_spinner"><i class="rich_web rich_web-refresh  rich_web_imgslide-spin"></i>Deleting</button>');
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Del_Option', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: Option_ID, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) { 
		jQuery('#Rich_Web_IS_Opt_Content_' + Option_ID).remove();
	 });				
	}
	function Rich_Web_IS_Copy_Opt(Option_ID)
	{
		event.preventDefault();
		var Rich_Web_IS_Opt_El = jQuery('#Rich_Web_IS_Opt_Content_'+Option_ID)
		Rich_Web_IS_Opt_El.addClass("Rich_Web_IS_Opt_Content_H");
		var Rich_Web_IS_Opt_Img = Rich_Web_IS_Opt_El.children('img').attr('src');
		var RW_IS_Icons = jQuery("#Rich_Web_IS_Icon_Opt_"+Option_ID);
		RW_IS_Icons.html('<button class="rw_is_icon_spinner"><i class="rich_web rich_web-refresh  rich_web_imgslide-spin"></i>Copying</button>');
		var ajaxurl = object.ajaxurl;
		var data = {
			action: 'rich_web_Copy_Sl2', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: Option_ID, // translates into $_POST['foobar'] in PHP
		};
		jQuery.post(ajaxurl, data, function(response) {
			responseData = jQuery.parseJSON(response); 
			console.log(responseData)
			RW_IS_Icons.children('button').html('<i class="Rich_Web_Tabs_Install rich_web rich_web-check"></i> Copied');
                        setTimeout(() => {
			Rich_Web_IS_Opt_El.after('<div id="Rich_Web_IS_Opt_Content_'+responseData.id+'" class="Rich_Web_IS_Opt_Content">	<img src="'+Rich_Web_IS_Opt_Img+'" alt="'+responseData.slider_name+'" class="Rich_Web_IS_Image"><div class="Rich_Web_IS_All_Icons"> <div class="Rich_Web_IS_Icon_Opt" id="Rich_Web_IS_Icon_Opt_'+responseData.id+'"><div class="Rich_Web_IS_Icon"   onclick="Rich_Web_IS_Edit_Opt('+responseData.id+')"><i class="Rich_Web_IS_Edit rich_web rich_web-pencil"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Copy_Opt('+responseData.id+')"><i class="Rich_Web_IS_Copy rich_web rich_web-files-o"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Delete_Opt('+responseData.id+')"><i class="Rich_Web_IS_Del rich_web rich_web-trash"></i></div></div></div><h4 class="Rich_Web_IS_Name ">'+responseData.slider_name+'</h4></div>');
			Rich_Web_IS_Opt_El.removeClass("Rich_Web_IS_Opt_Content_H"); 
			if (responseData.copiedOptionID > 6) {
				RW_IS_Icons.html('<div class="Rich_Web_IS_Icon"   onclick="Rich_Web_IS_Edit_Opt('+ Option_ID +')"><i class="Rich_Web_IS_Edit rich_web rich_web-pencil"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Copy_Opt('+Option_ID+')"><i class="Rich_Web_IS_Copy rich_web rich_web-files-o"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Delete_Opt('+Option_ID+')"><i class="Rich_Web_IS_Del rich_web rich_web-trash"></i></div>' );
			}else{
				RW_IS_Icons.html('<div class="Rich_Web_IS_Icon"   onclick="Rich_Web_IS_Edit_Opt('+ Option_ID +')"><i class="Rich_Web_IS_Edit rich_web rich_web-pencil"></i></div><div class="Rich_Web_IS_Icon"  onclick="Rich_Web_IS_Copy_Opt('+Option_ID+')"><i class="Rich_Web_IS_Copy rich_web rich_web-files-o"></i></div>' );
			}
                        }, 600);
		
			})
		
	}
	var rangeSlider = function()
	{
		var slider = jQuery('.range-slider'), range = jQuery('.range-slider__range'), value = jQuery('.range-slider__value');
		slider.each(function()
		{
			value.each(function()
			{
				var value = jQuery(this).prev().attr('value');
				jQuery(this).html(value);
			});
			range.on('input', function()
			{
				jQuery(this).next(value).html(this.value);
			});
		});
	};
	rangeSlider();

	function Rich_Web_IS_Name_Available(){
			var RW_IS_name = jQuery('#rich_web_slider_name').val();
			// console.log(RW_IS_name)
			var RW_IS_id = jQuery('#rw_is_name_hid_in').val();
			// console.log(RW_IS_id)

			var ajaxurl = object.ajaxurl;
				var data = {
				action: 'Rich_Web_IS_Name_Available', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				RW_IS_name: RW_IS_name, 
				RW_IS_id: RW_IS_id,
				};
				jQuery.post(ajaxurl, data, function(response) {
					console.log(response);
					if (response == 'true') {
						jQuery('.RW_IS_Name_ErrorAl').hide();
						jQuery('#rich_web_slider_name').removeClass('RW_IS_InputError');
						jQuery(".JSaveSlider2Anim").attr("disabled", false);	
					} else if(response == 'false'){
						jQuery('.RW_IS_Name_ErrorAl').show();
						jQuery('#rich_web_slider_name').addClass('RW_IS_InputError');
						jQuery(".JSaveSlider2Anim").attr("disabled", true);
					}
				})
	}	

	jQuery(document).ready(function() {
		if(!navigator.onLine) {
			jQuery('.Rich_Web_IS_Opt_Content img').each(function() {
				jQuery(this).attr('src','<?php echo plugin_dir_url( __DIR__ ).'Images/ConFailed_Photo_Slider.jpg';?>');
			})
		}
	})

</script>