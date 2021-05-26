<?php if(!empty($Rich_Web_Slider_Effect_Loader)){ ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>"
    style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 1") { ?>
        <div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?>">
            <div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider;?>" id="loader_Navigation1">
            </div>
            <div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider;?>" id="loader_Navigation2">
            </div>
            <div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider;?>" id="loader_Navigation3">
            </div>
            <div class="loader_Navigation4" id="loader_Navigation4"></div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 2") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 3") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_L_T == "Type 4") { ?>
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 1") { ?>
        <div class="cssload-loader<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT;?></div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 2") { ?>
        <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>">
            <?php foreach($text_array as $key=>$v){ ?>
            <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>"
                class="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>"><?php Print $v;?></div>
            <?php } ?>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 3") { ?>
        <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>-box">
                <?php foreach($text_array as $key=>$v){ ?>
                <div><?php Print $v;?></div>
                <?php } ?>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT_T == "Type 4") { ?>
        <div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_AccSl_LT;?>
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
<section class="main" id="rw_acc_main<?php echo $Rich_Web_Slider_Manager[0]->id;?>" style="display: none;">
    <div class="ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
        style='border:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BW;?>px solid <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_BC;?>;'>
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
        <figure class='figure_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
            style='box-shadow:0px 0px 0px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_BSh;?>px <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_BShC;?>'>
            <img class='img_<?php echo $Rich_Web_Slider_Manager[0]->id;?>' src="<?php echo $link_vImg_sl;?>" />

            <input class='input_<?php echo $Rich_Web_Slider_Manager[0]->id;?>' type="radio"
                name="radio-set_<?php echo $Rich_Web_Slider_Manager[0]->id;?>" checked="checked" />
            <figcaption class='figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
                <?php if($Rich_Web_Slider_Images[$i]->SL_Img_Title!=''){ ?>
                <span class='span_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
                    style='font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_FF;?>;color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_C;?>;text-shadow:unset;background:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_BgC;?>'>
                    <?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>
                </span>
                <?php } ?>
                <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
                <a style='font-family:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_FF;?>;color:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_C;?>;text-shadow:unset;background:<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_BgC;?>'
                    href='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>'
                    target='<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>'
                    class='Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
                    <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_Text;?>
                </a>
                <?php } ?>
                <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
                <span class='icBg' data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></span><i
                    class='rw_video_acc rich_web rich_web-play'
                    data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
                <?php } ?>
            </figcaption>
            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
            <iframe class='rw_acc_video<?php echo $Rich_Web_Slider; ?> rw_acc_video' src='' webkitAllowFullScreen
                mozallowfullscreen allowFullScreen></iframe>
            <?php } ?>
            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
            <i class='rw_icc_delIc rich_web rich_web-times'></i>
            <?php } ?>
            <?php } ?>
            <?php for($i=0;$i<count($Rich_Web_Slider_Images);$i++){ ?>
        </figure>
        <?php } ?>
    </div>
</section>
<input type='text' style='display:none;' class='Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_W;?>'>
<input type='text' style='display:none;' class='Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_H;?>'>
<input type='text' style='display:none;' class='Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Img_W;?>'>
<input type='text' style='display:none;' class='Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Title_FS;?>'>
<input type='text' style='display:none;' class='Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_AcSL_Link_FS;?>'>