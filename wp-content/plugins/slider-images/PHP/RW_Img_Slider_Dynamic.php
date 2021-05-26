<?php if(!empty($Rich_Web_Slider_Effect_Loader)) { ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>"
    style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 1") { ?>
        <div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?>">
            <div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider;?>" id="loader_Navigation1">
            </div>
            <div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider;?>" id="loader_Navigation2">
            </div>
            <div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider;?>" id="loader_Navigation3">
            </div>
            <div class="loader_Navigation4" id="loader_Navigation4"></div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 2") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 3") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_L_T == "Type 4") { ?>
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 1") { ?>
        <div class="cssload-loader<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT;?></div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 2") { ?>
        <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>">
            <?php foreach($text_array as $key=>$v){ ?>
            <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>"
                class="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>"><?php Print $v;?></div>
            <?php } ?>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 3") { ?>
        <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>-box">
                <?php foreach($text_array as $key=>$v){ ?>
                <div><?php Print $v;?></div>
                <?php } ?>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT_T == "Type 4") { ?>
        <div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_DynamicSl_LT;?>
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
<div class='rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>' style="display:none;">
    <div class='rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
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
        <div class='rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
            data-image='<?php echo $link_vImg_sl; ?>'
            data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'>>
            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
            <i class='rw_vd_popup rw_vDinamic_ic rich_web rich_web-play' data-image='<?php echo $link_vImg_sl; ?>'
                data-video='<?php $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
            <?php } ?>
            <div class='rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
                <div class='slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
                    <?php if($Rich_Web_Slider_Images[$i]->SL_Img_Title!=''){ ?>
                    <h2><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?></h2>
                    <?php }?>
                    <?php if($Rich_Web_Slider_Images[$i]->Sl_Img_Description!=''){ ?>
                    <div class="rw_description_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                        <?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->Sl_Img_Description);?>
                    </div>
                    <?php }?>
                    <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url!=''){ ?>
                    <a class="rw_link<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                        href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                        target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>"><?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_LT;?></a>
                    <?php }?>
                </div>
                <div class='rSlider--image_RW' name='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>'
                    alt='<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_NewTab;?>'></div>
            </div>
            <div class='rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id;?> '><img
                    src='<?php echo $link_vImg_sl;?>' /></div>
            <div class='rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'></div>
            <input type="text" style="display:none;" class="rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                rel="<?php echo $link_vImg_sl;?>">
        </div>
        <?php }?>
    </div>
    <div class='rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'></div>
    <div class='rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'></div>
</div>
<input type='text' style='display:none;' class='RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_H;?>'>
<input type="text" style="display:none;" class="Rich_Web_Sl_DS_DFS<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
    value="<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_DFS;?>">