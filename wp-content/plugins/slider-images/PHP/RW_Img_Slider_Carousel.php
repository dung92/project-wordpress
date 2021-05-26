<?php if(!empty($Rich_Web_Slider_Effect_Loader)){ ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>"
    style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 1") { ?>
        <div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?>">
            <div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider;?>" id="loader_Navigation1">
            </div>
            <div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider;?>" id="loader_Navigation2">
            </div>
            <div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider;?>" id="loader_Navigation3">
            </div>
            <div class="loader_Navigation4" id="loader_Navigation4"></div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 2") { ?>
        <div class="overlay-loader<?php echo $Rich_Web_Slider;?>">
            <div class="loader<?php echo $Rich_Web_Slider;?>">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 3") { ?>
        <div class="windows8<?php echo $Rich_Web_Slider;?>">
            <div class="wBall" id="wBall_1">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_2">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_3">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_4">
                <div class="wInnerBall"></div>
            </div>
            <div class="wBall" id="wBall_5">
                <div class="wInnerBall"></div>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_L_T == "Type 4") { ?>
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 1") { ?>
        <div class="cssload-loader<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT;?></div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 2") { ?>
        <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>">
            <?php foreach($text_array as $key=>$v){ ?>
            <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>"
                class="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>"><?php Print $v;?></div>
            <?php } ?>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 3") { ?>
        <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>-box">
                <?php foreach($text_array as $key=>$v){ ?>
                <div><?php Print $v;?></div>
                <?php } ?>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT_T == "Type 4") { ?>
        <div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_LT;?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<?php } else { ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
    </div>
</div>
<?php } ?>
<div class="your-slider-wrap your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id;?>" style="display: none;">
    <a class="Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id;?> slider-nav-arrow slider-arrow_left_<?php echo $Rich_Web_Slider_Manager[0]->id;?> slider-nav-arrow_disable"
        href="javascript:void(0)">
        <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Type=='text'){ ?>
        <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Prev;?>
        <?php }else{ ?>
        <i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_IType;?>-left'></i>
        <?php }?>
    </a>
    <a class="Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id;?> slider-nav-arrow slider-arrow_right_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
        href="javascript:void(0)">
        <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Type=='text'){ ?>
        <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_Next;?>
        <?php }else{ ?>
        <i class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_Arr_IType;?>-right'></i>
        <?php } ?>
    </a>
    <div class="your-slider responsiveSlider responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
        <ul>
            <?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ 
								if(strpos($Rich_Web_Slider_Images[$i]->Sl_Img_Url, 'youtube') > 0)
								{
									$rest_vImg_url = substr($Rich_Web_Slider_Images[$i]->Sl_Img_Url, 0, -13);
									$link_vImg_sl = $rest_vImg_url.'maxresdefault.jpg';
									if (!@fopen("$link_vImg_sl",'r')) { $link_vImg_sl = $Rich_Web_Slider_Images[$i]->Sl_Img_Url; }
								}
								else
								{
									$link_vImg_sl = $Rich_Web_Slider_Images[$i]->Sl_Img_Url;
								}
							 ?>
            <li class="your-item_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                <div class="rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?> box">
                    <img src="<?php echo $link_vImg_sl;?>" alt=""
                        class="your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "1" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "2" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "3" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "4") { ?>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                        <div class="Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                            <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
                            <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Type=='text'){ ?>
                            <a class="Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                                target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
                                <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Text;?>
                            </a>
                            <?php }else{ ?>
                            <a class="Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                                target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
                                <i
                                    class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_IType;?>'></i>
                            </a>
                            <?php }?>
                            <?php }?>
                            <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Type=='text'){ ?>
                            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url != ''){ ?>
                            <a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                                style="font-family:arial;<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                                <i class='rich_web rich_web-play'></i>
                            </a>
                            <?php }else{ ?>
                            <a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                                style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                                <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Text;?>
                            </a>
                            <?php } ?>
                            <?php }else{ ?>
                            <a class="Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                                style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                                <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url != ''){ ?>
                                <i class='rich_web rich_web-youtube-play'></i>
                                <?php }else{ ?>
                                <i
                                    class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_IType;?>'></i>
                                <?php } ?>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "5" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "6" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "8" || $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "10") { ?>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "7") { ?>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_1_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_2_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_3_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_4_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT == "9"){ ?>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_1_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <div
                        class="rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rw_hov_div<?php print $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_CarSl_HT;?>_2_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    </div>
                    <?php }?>
                    <div class="Rich_Web_PSlider_SC_LPop_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                        <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
                        <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Type=='text'){ ?>
                        <a class="Rich_Web_PSlider_SC_LText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                            target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
                            <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_Text;?>
                        </a>
                        <?php }else{ ?>
                        <a class="Rich_Web_PSlider_SC_L_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                            target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';} ?>">
                            <i
                                class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_L_IType;?>'></i>
                        </a>
                        <?php }?>
                        <?php }?>
                        <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Type=='text'){ ?>
                        <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url != ''){ ?>
                        <a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                            style="font-family:arial;<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                            <i class='rich_web rich_web-play'></i>
                        </a>
                        <?php }else{ ?>
                        <a class="Rich_Web_PSlider_SC_PText_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                            style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                            <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_Text;?>
                        </a>
                        <?php } ?>
                        <?php }else{ ?>
                        <a class="Rich_Web_PSlider_SC_P_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            onclick="Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>('<?php echo $link_vImg_sl;?>','<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>')"
                            style="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){echo 'margin-left:10px;'; }?>">
                            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url != ''){ ?>
                            <i class='rich_web rich_web-play'></i>
                            <?php }else{ ?>
                            <i
                                class='rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PI_IType;?>'></i>
                            <?php } ?>
                        </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="your-item-title_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    <?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></div>
            </li>
            <?php } ?>
        </ul>
    </div>

</div>
<!-- <div class="Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>" onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id;?>)"></div>
				<div class="Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>" onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id;?>)">
					<i class='Rich_Web_PSlider_SC_PCI_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_Type;?>' onclick="Rich_Web_PSlider_SC_Close_Popup(<?php echo $Rich_Web_Slider_Manager[0]->id;?>)"></i>
					<img src=""  class="Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
				</div> -->
<input type='text' style='display:none;' class='yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW;?>'>
<input type='text' style='display:none;' class='yith_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IH;?>'>
<input type="text" style="display:none;" class="ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
    value="<?php print count($Rich_Web_Slider_Images)*($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_IW) ?>">
<input type="text" style="display:none" name="" class="rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
    value="<?php print count($Rich_Web_Slider_Images);?>">