<?php if(!empty($Rich_Web_Slider_Effect_Loader)){ ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>"
    style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 1") { ?>
        <div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?>">
            <div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider;?>" id="loader_Navigation1">
            </div>
            <div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider;?>" id="loader_Navigation2">
            </div>
            <div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider;?>" id="loader_Navigation3">
            </div>
            <div class="loader_Navigation4" id="loader_Navigation4"></div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 2") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 3") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T == "Type 4") { ?>
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <?php } ?>

        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 1") { ?>
        <div class="cssload-loader<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;?></div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 2") { ?>
        <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>">
            <?php foreach($text_array as $key=>$v){ ?>
            <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>"
                class="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>"><?php Print $v;?></div>
            <?php } ?>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 3") { ?>
        <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>-box">
                <?php foreach($text_array as $key=>$v){ ?>
                <div><?php Print $v;?></div>
                <?php } ?>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T == "Type 4") { ?>
        <div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<?php } ?>
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
<div id="rich_webSlider1_<?php echo $Rich_Web_Slider;?>" style="display:none;">
    <div class="flexslider flexslider_<?php echo $Rich_Web_Slider;?>" style='position:relative;max-width:100%;'>
        <ul class="slides">
            <i class='delIc delIc<?php echo $Rich_Web_Slider;?> rich_web rich_web-times'></i>
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
            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined"){  ?>
            <li class="<?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined"){ echo "pointer"; } ?>"
                onclick="rw_nav_video_cl<?php echo $Rich_Web_Slider;?>('<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>',this)">
                <img class='IMHR<?php echo $Rich_Web_Slider;?>' src="<?php echo $link_vImg_sl;?>"
                    alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>"
                    data-thumbnail="<?php echo $link_vImg_sl;?>" />
                <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
                <iframe class='rw_nav_video<?php echo $Rich_Web_Slider; ?> rw_nav_video' src='' webkitAllowFullScreen
                    mozallowfullscreen allowFullScreen></iframe><i class='plIc plIc_nav rich_web rich_web-play'></i>
                <?php } ?>
            </li>
            <?php } else { ?>
            <li class="<?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined"){ echo "pointer"; } ?>"
                onclick="">
                <a class="Sl_Link_Url"
                    style="<?php if(!$Rich_Web_Slider_Images[$i]->Sl_Link_Url) { ?>cursor: default;<?php } ?>"
                    href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>">
                    <img class='IMHR<?php echo $Rich_Web_Slider;?>' src="<?php echo $link_vImg_sl;?>"
                        alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>"
                        data-thumbnail="<?php echo $link_vImg_sl;?>" />
                </a>
                <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
                <iframe class='rw_nav_video<?php echo $Rich_Web_Slider; ?> rw_nav_video' src='' webkitAllowFullScreen
                    mozallowfullscreen allowFullScreen></iframe><i class='plIc plIc_nav rich_web rich_web-play'></i>
                <?php } ?>
            </li>
            <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<input type='text' style='display:none;' class='SLWIDTHR_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>'>
<input type='text' style='display:none;' class='SLHEIGHTR_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>'>
<input type='text' style='display:none;' class='SLCLWR_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>'>
<input type='text' style='display:none;' class='SlClPrFS_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFS;?>'>
<input type='text' style='display:none;' class='hovEffType_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff;?>'>
<input type='text' style='display:none;' class='navWidth_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavW;?>'>
<input type='text' style='display:none;' class='navHeight_<?php echo $Rich_Web_Slider;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavH;?>'>
<input type='text' style='display:none;' class='navType'
    value='<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos;?>'>