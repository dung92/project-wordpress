function addSliderJ(number)
{
	jQuery('.Table_Data_rich_web1').css('display','none');
	jQuery('.RW_Support_btn').parent().css({'left':'8px','right':'initial',});
	jQuery('.JAddSlider').addClass('JAddSliderAnim');
	jQuery('.Table_Data_rich_web2').css('display','block');
	jQuery('.JSaveSlider').addClass('JSaveSliderAnim');
	jQuery('.JCanselSlider').addClass('JCanselSliderAnim');
	jQuery('.rich_web_Slider_ID').html('[Rich_Web_Slider id="'+number+'"]   <span class="RW_IS_C_TTip" >Copy to clipboard</span>');
	jQuery('.JMBSL').html('&lt;?php echo do_shortcode(&apos;[Rich_Web_Slider id="'+number+'"]&apos;);?&gt;  <span class="RW_IS_C_TTip" >Copy to clipboard</span> ');
	Rich_Web_Slider_Editor();
	
}
function canselSliderJ() { location.reload(); }
function rich_web_Video_Src_Clicked()
{
	jQuery('#rich_webVideoSrc').parent().html('<a href="https://rich-web.org/wp-image-slider/" class="button" target="_blank" style="border:1px solid rgba(0, 73, 107, 0.8); color:rgba(0, 73, 107, 0.8); background-color:#f4f4f4"  title="Pro Option"><span></span>Pro Option</a>');
}
function rich_web_Img_Src_Clicked()
{
	var zInt = setInterval(function(){
		var code = jQuery('#rich_web_imgSrc_1').val();
		if(code.indexOf('img')>0)
		{
			var s=code.split('src="');
			var src=s[1].split('"');
			jQuery('#rich_web_imgSrc_2').val(src[0]);
			if(jQuery('#rich_web_imgSrc_2').val().length>0) { jQuery('#rich_web_imgSrc_1').val(''); clearInterval(zInt); }
		}
	},100)
}
function rich_web_Res()
{
	jQuery('.JSlInput2').val('');
	jQuery('#rich_web_imgSrc_2').val('');
	jQuery('.jChB').attr('checked',false);
	tinymce.get('JSliderImageDesc').setContent('');
}
function checkVideoOrNot(str){
	if(str == "" || str == undefined || str == "undefined"){
		return "";
	}else{
		return "<i class='rich_web rich_web-play'></i>";
	}
}
function rw_return_admin_html(n, title, imgSrc,  link, newTab){
	return '<tr id="tr_'+n+'"><td name="number_name_'+n+'" id="number_name_'+n+'" >'+n+'</td><td id="JAdd_Img_'+n+'"><div class="rw_admin_imgVideo"><img src="'+imgSrc+'" id="JAdd_Img_Src_'+n+'" name="JAdd_Img_Src_'+n+'" style="height:60px;"></div></td><td id="JAdd_Title_'+n+'" name="JAdd_Title_'+n+'">'+title+'</td><td id="tdClone_'+n+'"><i class="jIcFileso rich_web rich_web-files-o" onclick="jambCloneId('+n+')"></i></td><td id="tdEdit_'+n+'"><i class="jIcPencil rich_web rich_web-pencil" onclick="jambEditId('+n+')"></i></td><td id="tdDelete_'+n+'"><i class="jIcDel rich_web rich_web-trash" onclick="jambDelId('+n+')"></i><input type="text" style="display:none;" class="add_title" id="JADD_Tit_'+n+'" name="JADD_Tit_'+n+'" value="'+title+'"/><input type="text" style="display:none;" class="add_description" id="JAdd_Description_'+n+'" name="JAdd_Description_'+n+'" value=""/><input type="text" style="display:none;" class="add_img" id="JAdd_src_'+n+'" name="JAdd_src_'+n+'" value="'+imgSrc+'"/><input type="text" style="display:none" class="add_link" id="JADD_Link_'+n+'" name="JADD_Link_'+n+'" value="'+link+'"><input type="text" style="display:none;" class="NewTab" id="JAdd_NewTab_'+n+'" name="JAdd_NewTab_'+n+'" value="'+newTab+'"/></td></tr>';
}
function descAndCountNumber(n, desc){
	jQuery('#JAdd_Description_'+n).val(desc);
	jQuery('#JumboHidNum').val(n);
}
function rich_web_Save()
{
	var JumboHidNum = jQuery('#JumboHidNum').val();
	var JSliderImageTitle = jQuery('#JSliderImageTitle').val();
	var rich_web_imgSrc_2 = jQuery('#rich_web_imgSrc_2').val();
	var JSliderImageLink = jQuery('#JSliderImageLink').val();
	var JSliderImageDesc = tinymce.get('JSliderImageDesc').getContent();
	var JNewTab = jQuery('#JNewTab').attr('checked');
	var html = rw_return_admin_html(parseInt(parseInt(JumboHidNum)+1), JSliderImageTitle, rich_web_imgSrc_2,  JSliderImageLink, JNewTab);
	jQuery('.rich_web_SaveSl_Table3').append(html);
	descAndCountNumber(parseInt(parseInt(JumboHidNum)+1), JSliderImageDesc);
	rich_web_Res();
}
function jambEditId(editNumber)
{
	rich_web_Res();
	var title = jQuery('#JAdd_Title_'+editNumber).text();
	var src = jQuery('#JAdd_Img_Src_'+editNumber).attr('src');
	var description = jQuery('#JAdd_Description_'+editNumber).val();
	var link = jQuery('#JADD_Link_'+editNumber).val();
	var newTab = jQuery('#JAdd_NewTab_'+editNumber).val();
	jQuery('#JumboHidUpd').val(editNumber);
	jQuery('.JSVBut').hide();
	jQuery('.JUPBut').show();
	jQuery('#JSliderImageTitle').val(title);
	jQuery('#rich_web_imgSrc_2').val(src);
	tinymce.get('JSliderImageDesc').setContent(description);
	jQuery('#JSliderImageLink').val(link);
	if(newTab=='checked') { jQuery('#JNewTab').attr('checked',true); } else { jQuery('#JNewTab').attr('checked',false); }
}
function rich_web_Update()
{
	updateNumber=jQuery('#JumboHidUpd').val();
	var src = jQuery('#rich_web_imgSrc_2').val();
	var title = jQuery('#JSliderImageTitle').val();
	var description = tinymce.get('JSliderImageDesc').getContent();
	var link = jQuery('#JSliderImageLink').val();
	var newTab = jQuery('#JNewTab').attr('checked');
	jQuery('#JAdd_Img_Src_'+updateNumber).attr('src',src);
	jQuery('#JADD_Tit_'+updateNumber).val(title);
	jQuery('#JAdd_Title_'+updateNumber).text(title);
	jQuery('#JAdd_src_'+updateNumber).val(src);
	jQuery('#JAdd_Description_'+updateNumber).val(description);
	jQuery('#JADD_Link_'+updateNumber).val(link);
	jQuery('#JAdd_NewTab_'+updateNumber).val(newTab);
	jQuery('.JSVBut').show();
	jQuery('.JUPBut').hide();
	if(jQuery('#JAdd_Img_'+updateNumber+' div i')){
		jQuery('#JAdd_Img_'+updateNumber+' div i').remove();
	}
	rich_web_Res();
}
function rw_sortNumbering(el,n){
	jQuery(el).attr('id','tr_'+n);
	jQuery(el).find('td:nth-child(1)').html(n);
	jQuery(el).find('td:nth-child(1)').attr('name','number_name_'+n);
	jQuery(el).find('td:nth-child(1)').attr('id','number_name_'+n);
	jQuery(el).find('td:nth-child(2)').attr('id','JAdd_Img_'+n);
	jQuery(el).find('td:nth-child(2) img').attr('id','JAdd_Img_Src_'+n);
	jQuery(el).find('td:nth-child(2) img').attr('name','JAdd_Img_Src_'+n);
	jQuery(el).find('td:nth-child(3)').attr('id','JAdd_Title_'+n);
	jQuery(el).find('td:nth-child(3)').attr('name','JAdd_Title_'+n);
	jQuery(el).find('td:nth-child(4)').attr('id','tdClone_'+n);
	jQuery(el).find('td:nth-child(4) i').attr('onclick','jambCloneId('+n+')');
	jQuery(el).find('td:nth-child(5)').attr('id','tdEdit_'+n);
	jQuery(el).find('td:nth-child(5) i').attr('onclick','jambEditId('+n+')');
	jQuery(el).find('td:nth-child(6)').attr('id','tdDelete_'+n);
	jQuery(el).find('td:nth-child(6) i').attr('onclick','jambDelId('+n+')');
	jQuery(el).find('.add_title').attr('id','JADD_Tit_'+n);
	jQuery(el).find('.add_title').attr('name','JADD_Tit_'+n);
	jQuery(el).find('.add_description').attr('id','JAdd_Description_'+n);
	jQuery(el).find('.add_description').attr('name','JAdd_Description_'+n);
	jQuery(el).find('.add_img').attr('id','JAdd_src_'+n);
	jQuery(el).find('.add_img').attr('name','JAdd_src_'+n);
	jQuery(el).find('.add_link').attr('id','JADD_Link_'+n);
	jQuery(el).find('.add_link').attr('name','JADD_Link_'+n);
	jQuery(el).find('.NewTab').attr('id','JAdd_NewTab_'+n);
	jQuery(el).find('.NewTab').attr('name','JAdd_NewTab_'+n);
}
function jambCloneId(CloneNumber)
{
	var title = jQuery('#JAdd_Title_'+CloneNumber).text();
	var src = jQuery('#JAdd_Img_Src_'+CloneNumber).attr('src');
	var description = jQuery('#JAdd_Description_'+CloneNumber).val();
	var link = jQuery('#JADD_Link_'+CloneNumber).val();
	var newTab = jQuery('#JAdd_NewTab_'+CloneNumber).val();
	var JumboHidNum = jQuery('#JumboHidNum').val();
	var html = rw_return_admin_html(parseInt(parseInt(JumboHidNum)+1), title, src,  link, newTab);	
	jQuery('#tr_'+CloneNumber).after(html);
	descAndCountNumber(parseInt(parseInt(JumboHidNum)+1), description);
	jQuery('.rich_web_SaveSl_Table3 tr').each(function(){
		rw_sortNumbering(this,parseInt(parseInt(jQuery(this).index())+1));
	})
}
function jambDelId(removeNumber)
{
	var RWSIRSI = removeNumber;
	jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeIn();
	jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeIn();
	jQuery('.Rich_Web_SliderIm_Relative_No').click(function(){
		jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();
		jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
		RWSIRSI = null;
	})
	jQuery('.Rich_Web_SliderIm_Relative_Yes').click(function(){
		if(RWSIRSI != null)
		{
			jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();
			jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
			jQuery('#tr_'+removeNumber).remove();
			jQuery('#JumboHidNum').val(jQuery('#JumboHidNum').val()-1);
			jQuery('.rich_web_SaveSl_Table3 tr').each(function(){
				rw_sortNumbering(this,parseInt(parseInt(jQuery(this).index())+1));
			})
		}
		RWSIRSI = null;
	})
}
function rich_webSortable()
{
	jQuery('.rich_web_SaveSl_Table3').sortable({
		update: function( event, ui ){
			jQuery(this).find('tr').each(function(i){
				rw_sortNumbering(this,(i+1));
			});
		}
	})
}

function rich_web_Edit_Sl(number)
{
	jQuery('.Table_Data_rich_web1').css('display','none');
	jQuery('.RW_Support_btn').parent().css({'left':'8px','right':'initial',});
	jQuery('.JAddSlider').addClass('JAddSliderAnim');
	jQuery('.Table_Data_rich_web2').css('display','block');
	jQuery('.JUpdateSlider').addClass('JSaveSliderAnim');
	jQuery('.JCanselSlider').addClass('JCanselSliderAnim');
	jQuery('#upd_id').val(number);
	jQuery('.rich_web_Slider_ID').html('[Rich_Web_Slider id="'+number+'"] <span class="RW_IS_C_TTip" >Copy to clipboard</span>');
	jQuery('.JMBSL').html('&lt;?php echo do_shortcode(&apos;[Rich_Web_Slider id="'+number+'"]&apos;);?&gt; <span class="RW_IS_C_TTip" >Copy to clipboard</span>');
	Rich_Web_Slider_Editor();
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Edit', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var arr=Array();
		var spl=response.split('=>');
		for(var i=3;i<spl.length;i++)
		{
			arr[arr.length]=spl[i].split('[')[0].trim(); 
		}
		arr[arr.length-1]=arr[arr.length-1].split(')')[0].trim();
		jQuery('.JSliderName').val(arr[0]);
		jQuery('.JSType').val(arr[1]);
		jQuery('#JumboHidNum').val(arr[2]);
	})
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Edit_ImDescTit', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var data = JSON.parse(response);
		var data1 = data[0];
		var data2 = data[1];

		for(var i=0;i<data1.length;i++) {
			var html = rw_return_admin_html((i+1), data1[i]['SL_Img_Title'], data1[i]['Sl_Img_Url'], data1[i]['Sl_Link_Url'], data1[i]['Sl_Link_NewTab']);
			jQuery('.rich_web_SaveSl_Table3').append(html);
			jQuery('#JAdd_Description_'+(i+1)).val(data1[i]['Sl_Img_Description']);
		}
	})
}
function rich_web_Delete_Sl(number)
{
	var RWSIRS = number;
	jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeIn();
	jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeIn();
	jQuery('.Rich_Web_SliderIm_Relative_No').click(function(){
		jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();
		jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
		RWSIRS = null;
	})
	jQuery('.Rich_Web_SliderIm_Relative_Yes').click(function(){
		if(RWSIRS != null)
		{
			jQuery('.Rich_Web_SliderIm_Fixed_Div').fadeOut();
			jQuery('.Rich_Web_SliderIm_Absolute_Div').fadeOut();
			var ajaxurl = object.ajaxurl;
			var data = {
				action: 'rich_web_Del', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: number, // translates into $_POST['foobar'] in PHP
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('.RW_IS_Table_Tr_' + number).remove();
				jQuery('.rich_web_Tit_Table_Tr2').each(function(i){
					jQuery(this).find('td:nth-child(1)').html((i+1));
					});
				// location.reload(); 
			
			})
		}
		RWSIRS = null;
	})
}
function rich_web_Copy_Sl(number)
{
	event.preventDefault();
	var ajaxurl = object.ajaxurl;
	var data = {
		action: 'rich_web_Copy_Sl', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
		foobar: number, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) { 
		responseData = jQuery.parseJSON(response) ;
		jQuery('.rich_web_Tit_Table_Tr2').last().after('<tr class="rich_web_Tit_Table_Tr2 RW_IS_Table_Tr_'+responseData.id+' "><td></td><td>'+responseData.Slider_Title+'</td>			<td>'+responseData.Slider_Type+'</td><td>'+responseData.Slider_IMGS_Quantity+'</td><td onclick="rich_web_Copy_Sl('+responseData.id+')"><i class="jIcFileso rich_web rich_web-files-o"></i></td><td onclick="rich_web_Edit_Sl('+responseData.id+')"><i class="jIcPencil rich_web rich_web-pencil"></i></td><td onclick="rich_web_Delete_Sl('+responseData.id+')"><i class="jIcDel rich_web rich_web-trash"></i></td></tr>');
		jQuery('.rich_web_Tit_Table_Tr2').each(function(i){
			jQuery(this).find('td:nth-child(1)').html((i+1));
			});
		var rw_is_short_id = +responseData.id + 1;
		jQuery('.JAddSlider').attr('onclick','addSliderJ('+rw_is_short_id+')')
	})
}
jQuery(document).ready(function() {jQuery('.rich_web_Slider_ID , .JMBSL').bind('contextmenu', function() {return false;}); 
jQuery('.wp-media-buttons').first().html('<div  class="wp-media-buttons"><a href="#" class="button  " style="border:1px solid rgba(0, 73, 107, 0.8); color:rgba(0, 73, 107, 0.8); background-color:#f4f4f4"  title="Add Video" id="rich_webVideoSrc" onclick="rich_web_Video_Src_Clicked()"><span></span>Add Video</a>')
jQuery('#rich_web_videoSrc_1 , #Rich_Web_SlVid_Vid_1').remove()})
function Rich_Web_Slider_Editor()
{
	tinymce.init({
		selector: '#JSliderImageDesc',
		menubar: false,
		statusbar: false,
		height: 250,
		plugins: [
			'advlist autolink lists link image charmap print preview hr',
			'searchreplace wordcount code media ',
			'insertdatetime media save table contextmenu directionality',
			'paste textcolor colorpicker textpattern imagetools codesample'
		],
		toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect",
		toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink image media code | insertdatetime preview | forecolor backcolor",
		toolbar3: "table | hr | subscript superscript | charmap | print | codesample ",
		fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px',
		font_formats: 'Abadi MT Condensed Light = abadi mt condensed light; Aharoni = aharoni; Aldhabi = aldhabi; Andalus = andalus; Angsana New = angsana new; AngsanaUPC = angsanaupc; Aparajita = aparajita; Arabic Typesetting = arabic typesetting; Arial = arial; Arial Black = arial black; Batang = batang; BatangChe = batangche; Browallia New = browallia new; BrowalliaUPC = browalliaupc; Calibri = calibri; Calibri Light = calibri light; Calisto MT = calisto mt; Cambria = cambria; Candara = candara; Century Gothic = century gothic; Comic Sans MS = comic sans ms; Consolas = consolas; Constantia = constantia; Copperplate Gothic = copperplate gothic; Copperplate Gothic Light = copperplate gothic light; Corbel = corbel; Cordia New = cordia new; CordiaUPC = cordiaupc; Courier New = courier new; DaunPenh = daunpenh; David = david; DFKai-SB = dfkai-sb; DilleniaUPC = dilleniaupc; DokChampa = dokchampa; Dotum = dotum; DotumChe = dotumche; Ebrima = ebrima; Estrangelo Edessa = estrangelo edessa; EucrosiaUPC = eucrosiaupc; Euphemia = euphemia; FangSong = fangsong; Franklin Gothic Medium = franklin gothic medium; FrankRuehl = frankruehl; FreesiaUPC = freesiaupc; Gabriola = gabriola; Gadugi = gadugi; Gautami = gautami; Georgia = georgia; Gisha = gisha; Gulim = gulim; GulimChe = gulimche; Gungsuh = gungsuh; GungsuhChe = gungsuhche; Impact = impact; IrisUPC = irisupc; Iskoola Pota = iskoola pota; JasmineUPC = jasmineupc; KaiTi = kaiti; Kalinga = kalinga; Kartika = kartika; Khmer UI = khmer ui; KodchiangUPC = kodchiangupc; Kokila = kokila; Lao UI = lao ui; Latha = latha; Leelawadee = leelawadee; Levenim MT = levenim mt; LilyUPC = lilyupc; Lucida Console = lucida console; Lucida Handwriting Italic = lucida handwriting italic; Lucida Sans Unicode = lucida sans unicode; Malgun Gothic = malgun gothic; Mangal = mangal; Manny ITC = manny itc; Marlett = marlett; Meiryo = meiryo; Meiryo UI = meiryo ui; Microsoft Himalaya = microsoft himalaya; Microsoft JhengHei = microsoft jhenghei; Microsoft JhengHei UI = microsoft jhenghei ui; Microsoft New Tai Lue = microsoft new tai lue; Microsoft PhagsPa = microsoft phagspa; Microsoft Sans Serif = microsoft sans serif; Microsoft Tai Le = microsoft tai le; Microsoft Uighur = microsoft uighur; Microsoft YaHei = microsoft yahei; Microsoft YaHei UI = microsoft yahei ui; Microsoft Yi Baiti = microsoft yi baiti; MingLiU_HKSCS = mingliu_hkscs; MingLiU_HKSCS-ExtB = mingliu_hkscs-extb; Miriam = miriam; Mongolian Baiti = mongolian baiti; MoolBoran = moolboran; MS UI Gothic = ms ui gothic; MV Boli = mv boli; Myanmar Text = myanmar text; Narkisim = narkisim; Nirmala UI = nirmala ui; News Gothic MT = news gothic mt; NSimSun = nsimsun; Nyala = nyala; Palatino Linotype = palatino linotype; Plantagenet Cherokee = plantagenet cherokee; Raavi = raavi; Rod = rod; Sakkal Majalla = sakkal majalla; Segoe Print = segoe print; Segoe Script = segoe script; Segoe UI Symbol = segoe ui symbol; Shonar Bangla = shonar bangla; Shruti = shruti; SimHei = simhei; SimKai = simkai; Simplified Arabic = simplified arabic; SimSun = simsun; SimSun-ExtB = simsun-extb; Sylfaen = sylfaen; Tahoma = tahoma; Times New Roman = times new roman; Traditional Arabic = traditional arabic; Trebuchet MS = trebuchet ms; Tunga = tunga; Utsaah = utsaah; Vani = vani; Vijaya = vijaya'
	});
}
function rw_is_copy(elem) {
	var newInputElem = document.createElement("input");
	var rw_is_c =  jQuery(elem).attr('class');
	var CopiedText = jQuery('.'+rw_is_c).text(); 
	CopiedText= CopiedText.replace('Copy to clipboard','');
	CopiedText= CopiedText.replace('Copied to clipboard','');
	CopiedText = CopiedText.replace("&lt;", "<");
	CopiedText = CopiedText.replace("&gt;", ">");
	CopiedText = CopiedText.replace("&#039;", "'");
	CopiedText = CopiedText.replace("&#039;", "'");
	newInputElem.setAttribute("value", CopiedText);
	document.body.appendChild(newInputElem);
	newInputElem.select();
	document.execCommand("copy");
	document.body.removeChild(newInputElem);
	jQuery('.'+rw_is_c).children('span').text('Copied to clipboard'); 
}
function rw_is_copied(clicked) {
	var rw_is_c =  jQuery(clicked).attr('class');
	jQuery('.'+rw_is_c).children('span').text('Copy to clipboard'); 
}

