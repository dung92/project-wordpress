<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	$table_name   = $wpdb->prefix . "rich_web_photo_slider_manager";
	$table_name1  = $wpdb->prefix . "rich_web_photo_slider_instal";
	$table_name2  = $wpdb->prefix . "rich_web_slider_effects_data";
	$table_name3  = $wpdb->prefix . "rich_web_slider_font_family";
	$table_name4  = $wpdb->prefix . "rich_web_slider_id";
	$table_name5  = $wpdb->prefix . "rich_web_slider_effect1";
	$table_name6  = $wpdb->prefix . "rich_web_slider_effect2";
	$table_name7  = $wpdb->prefix . "rich_web_slider_effect3";
	$table_name8  = $wpdb->prefix . "rich_web_slider_effect4";
	$table_name9  = $wpdb->prefix . "rich_web_slider_effect5";
	$table_name10 = $wpdb->prefix . "rich_web_slider_effect6";
	$table_name11 = $wpdb->prefix . "rich_web_slider_effect7";
	$table_name12 = $wpdb->prefix . "rich_web_slider_effect8";
	$table_name13 = $wpdb->prefix . "rich_web_slider_effect9";
	$table_name14 = $wpdb->prefix . "rich_web_slider_effect10";
	$sql='CREATE TABLE IF NOT EXISTS ' .$table_name.' ( id INTEGER(10) UNSIGNED AUTO_INCREMENT, Slider_Title VARCHAR(255) NOT NULL, Slider_Type VARCHAR(255) NOT NULL, Slider_IMGS_Quantity INTEGER(10) NOT NULL, PRIMARY KEY (id) )';
	$sql1='CREATE TABLE IF NOT EXISTS ' .$table_name1.' ( id INTEGER(10) UNSIGNED AUTO_INCREMENT, SL_Img_Title VARCHAR(255) NOT NULL, Sl_Img_Description LONGTEXT NOT NULL, Sl_Img_Url VARCHAR(255) NOT NULL, Sl_Link_Url VARCHAR(255) NOT NULL, Sl_Link_NewTab VARCHAR(255) NOT NULL, Sl_Number INTEGER(10) NOT NULL, PRIMARY KEY (id) )';
	$sql2='CREATE TABLE IF NOT EXISTS ' .$table_name2 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, slider_name VARCHAR(255) NOT NULL,  slider_type VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql3='CREATE TABLE IF NOT EXISTS ' .$table_name3.' ( id INTEGER(10) UNSIGNED AUTO_INCREMENT, Font_family VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql4='CREATE TABLE IF NOT EXISTS ' .$table_name4 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, Slider_ID INTEGER(10) NOT NULL, PRIMARY KEY (id) )';
	$sql5='CREATE TABLE IF NOT EXISTS ' .$table_name5 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, rich_web_Sl1_SlS VARCHAR(255) NOT NULL, rich_web_Sl1_SlSS VARCHAR(255) NOT NULL, rich_web_Sl1_PoH VARCHAR(255) NOT NULL, rich_web_Sl1_W VARCHAR(255) NOT NULL, rich_web_Sl1_H VARCHAR(255) NOT NULL, rich_web_Sl1_BoxS VARCHAR(255) NOT NULL, rich_web_Sl1_BoxSC VARCHAR(255) NOT NULL, rich_web_Sl1_IBW VARCHAR(255) NOT NULL, rich_web_Sl1_IBS VARCHAR(255) NOT NULL, rich_web_Sl1_IBC VARCHAR(255) NOT NULL, rich_web_Sl1_IBR VARCHAR(255) NOT NULL, rich_web_Sl1_TBgC VARCHAR(255) NOT NULL, rich_web_Sl1_TC VARCHAR(255) NOT NULL, rich_web_Sl1_TTA VARCHAR(255) NOT NULL, rich_web_Sl1_TFS VARCHAR(255) NOT NULL, rich_web_Sl1_TFF VARCHAR(255) NOT NULL, rich_web_Sl1_TUp VARCHAR(255) NOT NULL, rich_web_Sl1_ArBgC VARCHAR(255) NOT NULL, rich_web_Sl1_ArOp VARCHAR(255) NOT NULL, rich_web_Sl1_ArType VARCHAR(255) NOT NULL, rich_web_Sl1_ArHBgC VARCHAR(255) NOT NULL, rich_web_Sl1_ArHOp VARCHAR(255) NOT NULL, rich_web_Sl1_ArHEff VARCHAR(255) NOT NULL, rich_web_Sl1_ArBoxW VARCHAR(255) NOT NULL, rich_web_Sl1_NavW VARCHAR(255) NOT NULL, rich_web_Sl1_NavH VARCHAR(255) NOT NULL, rich_web_Sl1_NavPB VARCHAR(255) NOT NULL, rich_web_Sl1_NavBW VARCHAR(255) NOT NULL, rich_web_Sl1_NavBS VARCHAR(255) NOT NULL, rich_web_Sl1_NavBC VARCHAR(255) NOT NULL, rich_web_Sl1_NavBR VARCHAR(255) NOT NULL, rich_web_Sl1_NavCC VARCHAR(255) NOT NULL, rich_web_Sl1_NavHC VARCHAR(255) NOT NULL, rich_web_Sl1_ArPFT VARCHAR(255) NOT NULL, rich_web_Sl1_NavPos VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql7='CREATE TABLE IF NOT EXISTS ' .$table_name7 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, rich_fsl_animation VARCHAR(255) NOT NULL, rich_fsl_SShow VARCHAR(255) NOT NULL, rich_fsl_SShow_Speed VARCHAR(255) NOT NULL, rich_fsl_Anim_Dur VARCHAR(255) NOT NULL, rich_fsl_Ic_Show VARCHAR(255) NOT NULL, rich_fsl_PPL_Show VARCHAR(255) NOT NULL, rich_fsl_Randomize VARCHAR(255) NOT NULL, rich_fsl_Loop VARCHAR(255) NOT NULL, rich_fsl_Width VARCHAR(255) NOT NULL, rich_fsl_Height VARCHAR(255) NOT NULL, rich_fsl_Border_Width VARCHAR(255) NOT NULL, rich_fsl_Border_Style VARCHAR(255) NOT NULL, rich_fsl_Border_Color VARCHAR(255) NOT NULL, rich_fsl_Box_Shadow VARCHAR(255) NOT NULL, rich_fsl_Shadow_Color VARCHAR(255) NOT NULL, rich_fsl_Desc_Show VARCHAR(255) NOT NULL, rich_fsl_Desc_Size VARCHAR(255) NOT NULL, rich_fsl_Desc_Color VARCHAR(255) NOT NULL, rich_fsl_Desc_Font_Family VARCHAR(255) NOT NULL, rich_fsl_Desc_Text_Align VARCHAR(255) NOT NULL, rich_fsl_Desc_Bg_Color VARCHAR(255) NOT NULL, rich_fsl_Desc_Transparency VARCHAR(255) NOT NULL, rich_fsl_Title_Font_Size VARCHAR(255) NOT NULL, rich_fsl_Title_Color VARCHAR(255) NOT NULL, rich_fsl_Title_Text_Shadow VARCHAR(255) NOT NULL, rich_fsl_Title_Font_Family VARCHAR(255) NOT NULL, rich_fsl_Title_Text_Align VARCHAR(255) NOT NULL, rich_fsl_Link_Text VARCHAR(255) NOT NULL, rich_fsl_Link_Border_Width VARCHAR(255) NOT NULL, rich_fsl_Link_Border_Style VARCHAR(255) NOT NULL, rich_fsl_Link_Border_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Font_Size VARCHAR(255) NOT NULL, rich_fsl_Link_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Font_Family VARCHAR(255) NOT NULL, rich_fsl_Link_Bg_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Transparency VARCHAR(255) NOT NULL, rich_fsl_Link_Hover_Border_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Hover_Bg_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Hover_Color VARCHAR(255) NOT NULL, rich_fsl_Link_Hover_Transparency VARCHAR(255) NOT NULL, rich_fsl_Icon_Size VARCHAR(255) NOT NULL, rich_fsl_Icon_Type VARCHAR(255) NOT NULL, rich_fsl_Hover_Icon_Type VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql9='CREATE TABLE IF NOT EXISTS ' .$table_name9 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BoxShShow VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BoxShType VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BoxSh VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_BoxShC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IH VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IBW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IBS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IBC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_IBR VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_ICBW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_ICBS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_ICBC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_TBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_TC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_TFS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_TFF VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_THBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_THC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_OC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BoxShShow VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BoxShType VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BoxSh VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Pop_BoxShC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_BgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_C VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_FS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_HBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_Type VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_Text VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_IType VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_L_FF VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_BgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_C VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_FS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_HBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_Type VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_Text VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_IType VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PI_FF VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_BgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_C VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_FS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_HBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_Type VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_FF VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_IType VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_Next VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_Arr_Prev VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PCI_FS VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PCI_C VARCHAR(255) NOT NULL, Rich_Web_Sl_SC_PCI_Type VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql10='CREATE TABLE IF NOT EXISTS ' .$table_name10 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_BgC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_AP VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_TS VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_PT VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_SS VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_SVis VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_CS VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_SLoop VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_SSc VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_SlPos VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_ShNavBut VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_W VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_H VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BoxShShow VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BoxShType VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BoxSh VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_I_BoxShC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_T_C VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_T_FF VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_Show VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_W VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_H VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_PB VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_CC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Nav_C VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Arr_Show VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Arr_Type VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Arr_S VARCHAR(255) NOT NULL, Rich_Web_Sl_FS_Arr_C VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql11='CREATE TABLE IF NOT EXISTS ' .$table_name11 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_AP VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_PT VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Tr VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_H VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_TFS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_TFF VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_TC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_DFS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_DFF VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_DC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LFS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LFF VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LBW VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LBS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LBC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LBR VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LHC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LHBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_LT VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_Show VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_LT VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_RT VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_C VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_BgC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Arr_HBgC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_W VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_H VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_PB VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_BW VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_BS VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_BC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_BR VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_C VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_HC VARCHAR(255) NOT NULL, Rich_Web_Sl_DS_Nav_CC VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	$sql13='CREATE TABLE IF NOT EXISTS ' .$table_name13 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, rich_web_slider_ID VARCHAR(255) NOT NULL, rich_web_slider_name VARCHAR(255) NOT NULL, rich_web_slider_type VARCHAR(255) NOT NULL, Rich_Web_AcSL_W VARCHAR(255) NOT NULL, Rich_Web_AcSL_H VARCHAR(255) NOT NULL, Rich_Web_AcSL_BW VARCHAR(255) NOT NULL, Rich_Web_AcSL_BS VARCHAR(255) NOT NULL, Rich_Web_AcSL_BC VARCHAR(255) NOT NULL, Rich_Web_AcSL_BSh VARCHAR(255) NOT NULL, Rich_Web_AcSL_BShC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Img_W VARCHAR(255) NOT NULL, Rich_Web_AcSL_Img_BSh VARCHAR(255) NOT NULL, Rich_Web_AcSL_Img_BShC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_FS VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_FF VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_C VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_TSh VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_TShC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Title_BgC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_FS VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_FF VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_C VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_TSh VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_TShC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_BgC VARCHAR(255) NOT NULL, Rich_Web_AcSL_Link_Text VARCHAR(255) NOT NULL, PRIMARY KEY (id) )';
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	dbDelta($sql1);
	dbDelta($sql2);
	dbDelta($sql3);
	dbDelta($sql4);
	dbDelta($sql5);
	dbDelta($sql7);
	dbDelta($sql9);
	dbDelta($sql10);
	dbDelta($sql11);
	dbDelta($sql13);
	$sqla   = 'ALTER TABLE ' . $table_name . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla1  = 'ALTER TABLE ' . $table_name1 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla2  = 'ALTER TABLE ' . $table_name2 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla3  = 'ALTER TABLE ' . $table_name3 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla4  = 'ALTER TABLE ' . $table_name4 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla5  = 'ALTER TABLE ' . $table_name5 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla7  = 'ALTER TABLE ' . $table_name7 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla9  = 'ALTER TABLE ' . $table_name9 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla10 = 'ALTER TABLE ' . $table_name10 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla11 = 'ALTER TABLE ' . $table_name11 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$sqla13 = 'ALTER TABLE ' . $table_name13 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
	$wpdb->query($sqla);
	$wpdb->query($sqla1);
	$wpdb->query($sqla2);
	$wpdb->query($sqla3);
	$wpdb->query($sqla4);
	$wpdb->query($sqla5);
	$wpdb->query($sqla7);
	$wpdb->query($sqla9);
	$wpdb->query($sqla10);
	$wpdb->query($sqla11);
	$wpdb->query($sqla13);
	$Rich_Web_Fonts = array('Abadi MT Condensed Light','Aharoni','Aldhabi','Andalus','Angsana New','AngsanaUPC','Aparajita','Arabic Typesetting','Arial','Arial Black', 'Batang','BatangChe','Browallia New','BrowalliaUPC','Calibri','Calibri Light','Calisto MT','Cambria','Candara','Century Gothic','Comic Sans MS','Consolas', 'Constantia','Copperplate Gothic','Copperplate Gothic Light','Corbel','Cordia New','CordiaUPC','Courier New','DaunPenh','David','DFKai-SB','DilleniaUPC', 'DokChampa','Dotum','DotumChe','Ebrima','Estrangelo Edessa','EucrosiaUPC','Euphemia','FangSong','Franklin Gothic Medium','FrankRuehl','FreesiaUPC','Gabriola', 'Gadugi','Gautami','Georgia','Gisha','Gulim','GulimChe','Gungsuh','GungsuhChe','Impact','IrisUPC','Iskoola Pota','JasmineUPC','KaiTi','Kalinga','Kartika', 'Khmer UI','KodchiangUPC','Kokila','Lao UI','Latha','Leelawadee','Levenim MT','LilyUPC','Lucida Console','Lucida Handwriting Italic','Lucida Sans Unicode', 'Malgun Gothic','Mangal','Manny ITC','Marlett','Meiryo','Meiryo UI','Microsoft Himalaya','Microsoft JhengHei','Microsoft JhengHei UI','Microsoft New Tai Lue', 'Microsoft PhagsPa','Microsoft Sans Serif','Microsoft Tai Le','Microsoft Uighur','Microsoft YaHei','Microsoft YaHei UI','Microsoft Yi Baiti','MingLiU_HKSCS', 'MingLiU_HKSCS-ExtB','Miriam','Mongolian Baiti','MoolBoran','MS UI Gothic','MV Boli','Myanmar Text','Narkisim','Nirmala UI','News Gothic MT','NSimSun','Nyala', 'Palatino Linotype','Plantagenet Cherokee','Raavi','Rod','Sakkal Majalla','Segoe Print','Segoe Script','Segoe UI Symbol','Shonar Bangla','Shruti','SimHei','SimKai', 'Simplified Arabic','SimSun','SimSun-ExtB','Sylfaen','Tahoma','Times New Roman','Traditional Arabic','Trebuchet MS','Tunga','Utsaah','Vani','Vijaya');
	$Rich_WebFontCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id>%d",0));
	if(count($Rich_WebFontCount)==0)
	{
		foreach ($Rich_Web_Fonts as $JFonts) 
		{
			$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Font_family) VALUES (%d, %s)", '', $JFonts));
		}
	}
	//Navigation
	$Rich_SN_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name5 WHERE id>%d",0));
	if(count($Rich_SN_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Slider Navigation', 'Slider Navigation'));
		$Rich_SN_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Slider Navigation'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name5 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, rich_web_Sl1_SlS, rich_web_Sl1_SlSS, rich_web_Sl1_PoH, rich_web_Sl1_W, rich_web_Sl1_H, rich_web_Sl1_BoxS, rich_web_Sl1_BoxSC, rich_web_Sl1_IBW, rich_web_Sl1_IBS, rich_web_Sl1_IBC, rich_web_Sl1_IBR, rich_web_Sl1_TBgC, rich_web_Sl1_TC, rich_web_Sl1_TTA, rich_web_Sl1_TFS, rich_web_Sl1_TFF, rich_web_Sl1_TUp, rich_web_Sl1_ArBgC, rich_web_Sl1_ArOp, rich_web_Sl1_ArType, rich_web_Sl1_ArHBgC, rich_web_Sl1_ArHOp, rich_web_Sl1_ArHEff, rich_web_Sl1_ArBoxW, rich_web_Sl1_NavW, rich_web_Sl1_NavH, rich_web_Sl1_NavPB, rich_web_Sl1_NavBW, rich_web_Sl1_NavBS, rich_web_Sl1_NavBC, rich_web_Sl1_NavBR, rich_web_Sl1_NavCC, rich_web_Sl1_NavHC, rich_web_Sl1_ArPFT, rich_web_Sl1_NavPos) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_SN_EN[0]->id, 'Slider Navigation', 'Slider Navigation', 'true', '3', 'true', '750', '400', 'true', '#0084aa', '10', '#6ecae9', '#ffffff', '0', '#0084aa', '#ffffff', 'center', '10', 'Aldhabi', 'true', '#1e73be', '82', '1', '#1e73be', '80', 'slide out', '50', '8', '8', '8', '1', 'solid', '#ffffff', '20', '#0084aa', '#ffffff', '35', 'bottom'));
	}
	//Fashion
	$Rich_FS_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE id>%d",0));
	if(count($Rich_FS_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Fashion Slider', 'Fashion Slider'));
		$Rich_FS_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Fashion Slider'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name7 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, rich_fsl_animation, rich_fsl_SShow, rich_fsl_SShow_Speed, rich_fsl_Anim_Dur, rich_fsl_Ic_Show, rich_fsl_PPL_Show, rich_fsl_Randomize, rich_fsl_Loop, rich_fsl_Width, rich_fsl_Height, rich_fsl_Border_Width, rich_fsl_Border_Style, rich_fsl_Border_Color, rich_fsl_Box_Shadow, rich_fsl_Shadow_Color, rich_fsl_Desc_Show, rich_fsl_Desc_Size, rich_fsl_Desc_Color, rich_fsl_Desc_Font_Family, rich_fsl_Desc_Text_Align, rich_fsl_Desc_Bg_Color, rich_fsl_Desc_Transparency, rich_fsl_Title_Font_Size, rich_fsl_Title_Color, rich_fsl_Title_Text_Shadow, rich_fsl_Title_Font_Family, rich_fsl_Title_Text_Align, rich_fsl_Link_Text, rich_fsl_Link_Border_Width, rich_fsl_Link_Border_Style, rich_fsl_Link_Border_Color, rich_fsl_Link_Font_Size, rich_fsl_Link_Color, rich_fsl_Link_Font_Family, rich_fsl_Link_Bg_Color, rich_fsl_Link_Transparency, rich_fsl_Link_Hover_Border_Color, rich_fsl_Link_Hover_Bg_Color, rich_fsl_Link_Hover_Color, rich_fsl_Link_Hover_Transparency, rich_fsl_Icon_Size, rich_fsl_Icon_Type, rich_fsl_Hover_Icon_Type) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_FS_EN[0]->id, 'Fashion Slider', 'Fashion Slider', 'fade', '1', '3', '3', '1', 'false', 'false', '1', '750', '390', '0', '#6ecae9', '#ffffff', 'none', '#606060', 'on', '', '', '', '', 'rgba(0,132,170,0.75)', '', '18', '#ffffff', '0', 'Aldhabi', 'center', 'View More', '0', 'solid', '#0084aa', '19', '#0084aa', 'Vijaya', 'rgba(255,255,255,0.65)', '', '#0084aa', '#0084aa', 'rgba(255,255,255,0.65)', '', '30', '1', '12'));
	}
	//Carousel
	$Rich_SC_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name9 WHERE id>%d",0));
	if(count($Rich_SC_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Slider Carousel', 'Slider Carousel'));
		$Rich_FS_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Slider Carousel'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name9 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_SC_BW, Rich_Web_Sl_SC_BS, Rich_Web_Sl_SC_BC, Rich_Web_Sl_SC_BoxShShow, Rich_Web_Sl_SC_BoxShType, Rich_Web_Sl_SC_BoxSh, Rich_Web_Sl_SC_BoxShC, Rich_Web_Sl_SC_IW, Rich_Web_Sl_SC_IH, Rich_Web_Sl_SC_IBW, Rich_Web_Sl_SC_IBS, Rich_Web_Sl_SC_IBC, Rich_Web_Sl_SC_IBR, Rich_Web_Sl_SC_ICBW, Rich_Web_Sl_SC_ICBS, Rich_Web_Sl_SC_ICBC, Rich_Web_Sl_SC_TBgC, Rich_Web_Sl_SC_TC, Rich_Web_Sl_SC_TFS, Rich_Web_Sl_SC_TFF, Rich_Web_Sl_SC_THBgC, Rich_Web_Sl_SC_THC, Rich_Web_Sl_SC_Pop_OC, Rich_Web_Sl_SC_Pop_BW, Rich_Web_Sl_SC_Pop_BC, Rich_Web_Sl_SC_Pop_BoxShShow, Rich_Web_Sl_SC_Pop_BoxShType, Rich_Web_Sl_SC_Pop_BoxSh, Rich_Web_Sl_SC_Pop_BoxShC, Rich_Web_Sl_SC_L_BgC, Rich_Web_Sl_SC_L_C, Rich_Web_Sl_SC_L_FS, Rich_Web_Sl_SC_L_BW, Rich_Web_Sl_SC_L_BS, Rich_Web_Sl_SC_L_BC, Rich_Web_Sl_SC_L_BR, Rich_Web_Sl_SC_L_HBgC, Rich_Web_Sl_SC_L_HC, Rich_Web_Sl_SC_L_Type, Rich_Web_Sl_SC_L_Text, Rich_Web_Sl_SC_L_IType, Rich_Web_Sl_SC_L_FF, Rich_Web_Sl_SC_PI_BgC, Rich_Web_Sl_SC_PI_C, Rich_Web_Sl_SC_PI_FS, Rich_Web_Sl_SC_PI_BW, Rich_Web_Sl_SC_PI_BS, Rich_Web_Sl_SC_PI_BC, Rich_Web_Sl_SC_PI_BR, Rich_Web_Sl_SC_PI_HBgC, Rich_Web_Sl_SC_PI_HC, Rich_Web_Sl_SC_PI_Type, Rich_Web_Sl_SC_PI_Text, Rich_Web_Sl_SC_PI_IType, Rich_Web_Sl_SC_PI_FF, Rich_Web_Sl_SC_Arr_BgC, Rich_Web_Sl_SC_Arr_C, Rich_Web_Sl_SC_Arr_FS, Rich_Web_Sl_SC_Arr_BW, Rich_Web_Sl_SC_Arr_BS, Rich_Web_Sl_SC_Arr_BC, Rich_Web_Sl_SC_Arr_BR, Rich_Web_Sl_SC_Arr_HBgC, Rich_Web_Sl_SC_Arr_HC, Rich_Web_Sl_SC_Arr_Type, Rich_Web_Sl_SC_Arr_FF, Rich_Web_Sl_SC_Arr_IType, Rich_Web_Sl_SC_Arr_Next, Rich_Web_Sl_SC_Arr_Prev, Rich_Web_Sl_SC_PCI_FS, Rich_Web_Sl_SC_PCI_C, Rich_Web_Sl_SC_PCI_Type) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_FS_EN[0]->id, 'Slider Carousel', 'Slider Carousel', '2', '#6ecae9', '#ffffff', 'true', 'true', '15', '#0084aa', '270', '150', '4', '', '#ffffff', '0', '0', '', '#b5b5b5', '#0084aa', '#ffffff', '23', 'Vijaya', '#ffffff', '#0084aa', 'rgba(0,132,170,0.85)', '10', '#ffffff', 'true', 'false', '50', '#ffffff', 'rgba(255,255,255,0.7)', '#0084aa', '18', '0', 'solid', '#ffffff', '3', 'rgba(0,132,170,0.7)', '#ffffff', 'text', 'More', 'link', 'Vijaya', 'rgba(0,132,170,0.7)', '#ffffff', '18', '0', '', '#0084aa', '3', 'rgba(255,255,255,0.7)', '#0084aa', 'text', 'Picture', 'picture-o', 'Gabriola', 'rgba(255,255,255,0.6)', '#0084aa', '20', '0', 'solid', '#6a90d8', '10', 'rgba(0,132,170,0.6)', '#ffffff', 'icon', 'Gabriola', 'angle', 'Next', 'Prev', '35', '#0084aa', 'home'));
	}
	//Flexible
	$Rich_FlexS_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name10 WHERE id>%d",0));
	if(count($Rich_FlexS_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Flexible Slider', 'Flexible Slider'));
		$Rich_FS_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Flexible Slider'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name10 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_FS_BgC, Rich_Web_Sl_FS_AP, Rich_Web_Sl_FS_TS, Rich_Web_Sl_FS_PT, Rich_Web_Sl_FS_SS, Rich_Web_Sl_FS_SVis, Rich_Web_Sl_FS_CS, Rich_Web_Sl_FS_SLoop, Rich_Web_Sl_FS_SSc, Rich_Web_Sl_FS_SlPos, Rich_Web_Sl_FS_ShNavBut, Rich_Web_Sl_FS_I_W, Rich_Web_Sl_FS_I_H, Rich_Web_Sl_FS_I_BW, Rich_Web_Sl_FS_I_BS, Rich_Web_Sl_FS_I_BC, Rich_Web_Sl_FS_I_BR, Rich_Web_Sl_FS_I_BoxShShow, Rich_Web_Sl_FS_I_BoxShType, Rich_Web_Sl_FS_I_BoxSh, Rich_Web_Sl_FS_I_BoxShC, Rich_Web_Sl_FS_T_C, Rich_Web_Sl_FS_T_FF, Rich_Web_Sl_FS_Nav_Show, Rich_Web_Sl_FS_Nav_W, Rich_Web_Sl_FS_Nav_H, Rich_Web_Sl_FS_Nav_BW, Rich_Web_Sl_FS_Nav_BS, Rich_Web_Sl_FS_Nav_BC, Rich_Web_Sl_FS_Nav_BR, Rich_Web_Sl_FS_Nav_PB, Rich_Web_Sl_FS_Nav_CC, Rich_Web_Sl_FS_Nav_HC, Rich_Web_Sl_FS_Nav_C, Rich_Web_Sl_FS_Arr_Show, Rich_Web_Sl_FS_Arr_Type, Rich_Web_Sl_FS_Arr_S, Rich_Web_Sl_FS_Arr_C) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_FS_EN[0]->id, 'Flexible Slider', 'Flexible Slider', '#0084aa', 'true', '400', '4', '1', '', '6', 'true', '200', 'center', 'true', '225', '225', '5', '#6ecae9', '#ffffff', '134', 'true', 'false', '33', '#0084aa', '#0084aa', 'Aldhabi', 'true', '15', '10', '1', '', '#0084aa', '15', '3', '#0084aa', '#0066bf', '#ffffff', 'true', 'angle', '40', '#ffffff'));
	}
	//Dynamic
	$Rich_DS_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name11 WHERE id>%d",0));
	if(count($Rich_DS_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Dynamic Slider', 'Dynamic Slider'));
		$Rich_FS_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Dynamic Slider'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name11 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_Sl_DS_AP, Rich_Web_Sl_DS_PT, Rich_Web_Sl_DS_Tr, Rich_Web_Sl_DS_H, Rich_Web_Sl_DS_BW, Rich_Web_Sl_DS_BS, Rich_Web_Sl_DS_BC, Rich_Web_Sl_DS_TFS, Rich_Web_Sl_DS_TFF, Rich_Web_Sl_DS_TC, Rich_Web_Sl_DS_DFS, Rich_Web_Sl_DS_DFF, Rich_Web_Sl_DS_DC, Rich_Web_Sl_DS_LFS, Rich_Web_Sl_DS_LFF, Rich_Web_Sl_DS_LC, Rich_Web_Sl_DS_LBgC, Rich_Web_Sl_DS_LBW, Rich_Web_Sl_DS_LBS, Rich_Web_Sl_DS_LBC, Rich_Web_Sl_DS_LBR, Rich_Web_Sl_DS_LHC, Rich_Web_Sl_DS_LHBgC, Rich_Web_Sl_DS_LT, Rich_Web_Sl_DS_Arr_Show, Rich_Web_Sl_DS_Arr_LT, Rich_Web_Sl_DS_Arr_RT, Rich_Web_Sl_DS_Arr_C, Rich_Web_Sl_DS_Arr_BgC, Rich_Web_Sl_DS_Arr_BW, Rich_Web_Sl_DS_Arr_BS, Rich_Web_Sl_DS_Arr_BC, Rich_Web_Sl_DS_Arr_BR, Rich_Web_Sl_DS_Arr_HC, Rich_Web_Sl_DS_Arr_HBgC, Rich_Web_Sl_DS_Nav_W, Rich_Web_Sl_DS_Nav_H, Rich_Web_Sl_DS_Nav_PB, Rich_Web_Sl_DS_Nav_BW, Rich_Web_Sl_DS_Nav_BS, Rich_Web_Sl_DS_Nav_BC, Rich_Web_Sl_DS_Nav_BR, Rich_Web_Sl_DS_Nav_C, Rich_Web_Sl_DS_Nav_HC, Rich_Web_Sl_DS_Nav_CC) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_FS_EN[0]->id, 'Dynamic Slider', 'Dynamic Slider', 'true', '5', 'true', '250', '4', '#6ecae9', '#ffffff', '15', 'Aldhabi', '#ffffff', '', '', '', '16', 'Aldhabi', '#ffffff', '#dd3333', '0', 'dotted', '#4a1fc1', '0', '#dd3333', '#ffffff', 'View', 'true', 'Prev', 'Next', '#ffffff', '#0084aa', '0', 'solid', '#16a309', '46', '#ffffff', '#5598aa', '11', '12', '5', '1', '', '#ffffff', '50', '#0084aa', '#dd3333', '#ffffff'));
	}
	//Accordion
	$Rich_AcSL_Count_TG=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name13 WHERE id>%d",0));
	if(count($Rich_AcSL_Count_TG) == 0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, slider_name, slider_type) VALUES (%d, %s, %s)", '', 'Accordion', 'Accordion Slider'));
		$Rich_FS_EN=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s", 'Accordion'));
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name13 (id, rich_web_slider_ID, rich_web_slider_name, rich_web_slider_type, Rich_Web_AcSL_W, Rich_Web_AcSL_H, Rich_Web_AcSL_BW, Rich_Web_AcSL_BS, Rich_Web_AcSL_BC, Rich_Web_AcSL_BSh, Rich_Web_AcSL_BShC, Rich_Web_AcSL_Img_W, Rich_Web_AcSL_Img_BSh, Rich_Web_AcSL_Img_BShC, Rich_Web_AcSL_Title_FS, Rich_Web_AcSL_Title_FF, Rich_Web_AcSL_Title_C, Rich_Web_AcSL_Title_TSh, Rich_Web_AcSL_Title_TShC, Rich_Web_AcSL_Title_BgC, Rich_Web_AcSL_Link_FS, Rich_Web_AcSL_Link_FF, Rich_Web_AcSL_Link_C, Rich_Web_AcSL_Link_TSh, Rich_Web_AcSL_Link_TShC, Rich_Web_AcSL_Link_BgC, Rich_Web_AcSL_Link_Text) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Rich_FS_EN[0]->id, 'Accordion', 'Accordion Slider', '720', '350', '7', '#6ecae9', '#eaeaea', '14', '#0084aa', '596', '2', '#eaeaea', '16', 'Aldhabi', '#ffffff', '3', '#ffffff', 'rgba(0,132,170,0.65)', '16', 'Vijaya', '#0084aa', '3', '#0084aa', 'rgba(255,255,255,0.6)', 'View . . .'));
	}
	//Check Int or String Type
$RichWeb_ImgSl_ID = '';
$RW_ImgSl_DigitCheck = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d",0));
if (is_numeric($RW_ImgSl_DigitCheck[0]->Slider_Type) != TRUE) {
	for ($i=0; $i < count($RW_ImgSl_DigitCheck); $i++) { 
		$RichWeb_ImgSl_ID = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE slider_name=%s order by id asc limit 1", $RW_ImgSl_DigitCheck[$i]->Slider_Type));
		$wpdb->query($wpdb->prepare("UPDATE $table_name set Slider_Type=%s WHERE id=%s", $RichWeb_ImgSl_ID[0]->id, $RW_ImgSl_DigitCheck[$i]->id));
	}
}
//Check for new Update	
$Rich_Web_IS_Options=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2"));
$Rich_Web_IS_inserted_opt = [];
$Rich_Web_Opt_Exploded = $Rich_Web_IS_Opt_T = "";
for ($i=0; $i < count($Rich_Web_IS_Options); $i++) {
		$Rich_Web_Opt_Exploded = explode(" ", $Rich_Web_IS_Options[$i]->slider_type);
		$Rich_Web_IS_Opt_T = ($Rich_Web_Opt_Exploded[0] == "Slider") ? $Rich_Web_Opt_Exploded[1] : $Rich_Web_Opt_Exploded[0];
		array_push($Rich_Web_IS_inserted_opt, $Rich_Web_IS_Opt_T);
		$Rich_Web_Opt_Exploded = $Rich_Web_IS_Opt_T = "";
}
$Rich_Web_IS_Ins_Uni = array_values(array_unique($Rich_Web_IS_inserted_opt));
$filename = $filename1 = $filename2 = '';
$RW_IS_New_C = 'true';
$Rich_Web_IS_insert_php =  $Rich_Web_IS_insert_js =  $Rich_Web_IS_insert_css = [];
for ($c=0; $c < count($Rich_Web_IS_Ins_Uni); $c++) { 
	if($Rich_Web_IS_Ins_Uni[$c] === 'Content' || $Rich_Web_IS_Ins_Uni[$c] === 'Circle' || $Rich_Web_IS_Ins_Uni[$c] === 'Thumbnails' || $Rich_Web_IS_Ins_Uni[$c] === 'Animation') { $RW_IS_New_C = 'false'; }
	$filename = plugin_dir_path( __FILE__ ) . 'PHP/RW_Img_Slider_'.$Rich_Web_IS_Ins_Uni[$c].'.php';
	$filename1 = plugin_dir_path( __FILE__ ) . 'Scripts/RW_Img_Slider_'.$Rich_Web_IS_Ins_Uni[$c].'.js.php';
	$filename2 = plugin_dir_path( __FILE__ ) . 'Style/RW_Img_Slider_'.$Rich_Web_IS_Ins_Uni[$c].'.css.php';
	if (file_exists($filename) != TRUE) { array_push($Rich_Web_IS_insert_php, $Rich_Web_IS_Ins_Uni[$c]); }
	if (file_exists($filename1) != TRUE){ array_push($Rich_Web_IS_insert_js, $Rich_Web_IS_Ins_Uni[$c]);	 }
	if (file_exists($filename2) != TRUE){ array_push($Rich_Web_IS_insert_css, $Rich_Web_IS_Ins_Uni[$c]); }
	$filename = $filename1 = $filename2 =  '';
}
$file_1 = $rename_to1 =plugin_dir_path( __FILE__ ) . 'Rich-Web-Slider-Admin.php';
$file_2 = $rename_to2 =plugin_dir_path( __FILE__ ) . 'Scripts/Rich-Web-Slider-Admin.js';
$file_3 = $rename_to3 =plugin_dir_path( __FILE__ ) . 'Rich-Web-Slider-Ajax.php';
$file_p_1 = $rename_from1 = plugin_dir_path( __FILE__ ) . 'Rich-Web-Slider-Admin_two.php';
$file_p_2 = $rename_from2 = plugin_dir_path( __FILE__ ) . 'Scripts/Rich-Web-Slider-Admin_two.js';
$file_p_3 = $rename_from3 = plugin_dir_path( __FILE__ ) . 'Rich-Web-Slider-Ajax_two.php';
if ($RW_IS_New_C == 'false' && file_exists($file_p_1)  && file_exists($file_p_2) && file_exists($file_p_3)) {
	unlink($file_1);unlink($file_2);unlink($file_3);
	rename($rename_from1, $rename_to1); rename($rename_from2, $rename_to2); rename($rename_from3, $rename_to3);
}else if($RW_IS_New_C == 'true'){
	unlink($file_p_1);unlink($file_p_2);unlink($file_p_3);
}
$folderName = '';
$dir_name =  plugin_dir_path( __FILE__ );
if(count($Rich_Web_IS_insert_php) != 0){
	$folderName = plugin_dir_path( __FILE__ ) . 'RW_Img_Slider';
	$ch = curl_init();
	$source = "https://rich-web.org/is.org-free/RW_Img_Slider.zip";
	curl_setopt($ch, CURLOPT_URL, $source);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	curl_close ($ch);
	$destination = "RW_Photo_Slider.zip"; 
	$file = fopen($destination, "w+");
	fputs($file, $data);
	fclose($file);
	$zip = new ZipArchive;
	$res = $zip->open('RW_Photo_Slider.zip');
	if ($res === TRUE) {
		$zip->extractTo($dir_name); // directory to extract contents to
		$zip->close();
		unlink('RW_Photo_Slider.zip');
	}
	$move_from = $move_to = '';
	for ($i=0; $i < count($Rich_Web_IS_insert_php); $i++) { 
		$move_from = plugin_dir_path( __FILE__ ) . 'RW_Img_Slider/RW_Img_Slider_'.$Rich_Web_IS_insert_php[$i].'.php';
		$move_to = plugin_dir_path( __FILE__ ) . 'PHP/RW_Img_Slider_'.$Rich_Web_IS_insert_php[$i].'.php';
		rename ($move_from, $move_to);
		$move_from = $move_to = '';
	}
	for ($i=0; $i < count($Rich_Web_IS_insert_js); $i++) { 
		$move_from = plugin_dir_path( __FILE__ ) . 'RW_Img_Slider/RW_Img_Slider_'.$Rich_Web_IS_insert_js[$i].'.js.php';
		$move_to = plugin_dir_path( __FILE__ ) . 'Scripts/RW_Img_Slider_'.$Rich_Web_IS_insert_js[$i].'.js.php';
		rename ($move_from, $move_to);
		$move_from = $move_to = '';
	}
	for ($i=0; $i < count($Rich_Web_IS_insert_css); $i++) { 
		$move_from = plugin_dir_path( __FILE__ ) . 'RW_Img_Slider/RW_Img_Slider_'.$Rich_Web_IS_insert_css[$i].'.css.php';
		$move_to = plugin_dir_path( __FILE__ ) . 'Style/RW_Img_Slider_'.$Rich_Web_IS_insert_css[$i].'.css.php';
		rename ($move_from, $move_to);
		$move_from = $move_to = '';
	}
	if (is_dir($folderName)){
		$folderHandle = opendir($folderName);
	}
	if (!$folderHandle){
		return false;
	}
	while($file = readdir($folderHandle)) {
		if ($file != "." && $file != "..") {
			 if (!is_dir($folderName."/".$file)){
				unlink($folderName."/".$file);
			 }
			 else{
				removeFolder($folderName.'/'.$file);
			 }
		}
  	}
	closedir($folderHandle);
	rmdir($folderName);
	$folderName = '';
} ?>