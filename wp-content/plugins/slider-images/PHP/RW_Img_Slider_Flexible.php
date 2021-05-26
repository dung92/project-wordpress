<?php if(!empty($Rich_Web_Slider_Effect_Loader)){ ?>
<div id="RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>"
    style="<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_Loading_Show == "true") { ?>display: block;<?php } else { ?>display: none;<?php } ?>">
    <div class="center_content<?php echo $Rich_Web_Slider;?>">
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 1") { ?>
        <div class="RW_Loader_Frame_Navigation RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?>">
            <div class="loader_Navigation1 loader_Navigation1<?php echo $Rich_Web_Slider;?>" id="loader_Navigation1">
            </div>
            <div class="loader_Navigation2 loader_Navigation2<?php echo $Rich_Web_Slider;?>" id="loader_Navigation2">
            </div>
            <div class="loader_Navigation3 loader_Navigation3<?php echo $Rich_Web_Slider;?>" id="loader_Navigation3">
            </div>
            <div class="loader_Navigation4" id="loader_Navigation4"></div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 2") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 3") { ?>
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
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_L_T == "Type 4") { ?>
        <div class="cssload-thecube<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_Show == "true") { ?>
        <?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 1") { ?>
        <div class="cssload-loader<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT;?></div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 2") { ?>
        <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>">
            <?php foreach($text_array as $key=>$v){ ?>
            <div id="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>"
                class="inTurnFadingTextG<?php echo $Rich_Web_Slider;?>"><?php Print $v;?></div>
            <?php } ?>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 3") { ?>
        <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>">
            <div class="cssload-preloader<?php echo $Rich_Web_Slider;?>-box">
                <?php foreach($text_array as $key=>$v){ ?>
                <div><?php Print $v;?></div>
                <?php } ?>
            </div>
        </div>
        <?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT_T == "Type 4") { ?>
        <div class="RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>">
            <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_FlexibleSl_LT;?>
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
<figure class="rw_fl_slider_figure<?php echo $Rich_Web_Slider_Manager[0]->id;?>" style="height:0px; overflow:hidden;">
    <div class="mis-stage mis-stage_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
        <ol class="mis-slider mis-slider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
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
            <li class="mis-slide_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                <?php if($Rich_Web_Slider_Images[$i]->Sl_Link_Url != ''){ ?>
                <figure>
                    <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SVis == "on"){ ?>


                    <div style="overflow: auto; position: relative; margin-bottom: 20px;">
                        <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
                        <i class='rw_vfl_popup rw_vFlexable_ic rich_web rich_web-play'
                            data-image='<?php echo $link_vImg_sl; ?>'
                            data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
                        <?php } else { ?>
                        <i class='rw_vfl_popup rich_web rich_web-search' data-image='<?php echo $link_vImg_sl; ?>'
                            data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
                        <?php } ?>
                        <img class="rw_fl_slider_img rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                            src="<?php echo $link_vImg_sl;?>" data-image="<?php echo $link_vImg_sl;?>"
                            data-video="<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>"
                            alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>">
                    </div>
                    <a href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                        target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>"
                        class="mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                        <figcaption><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>
                        </figcaption>
                    </a>
                    <?php }else{ ?>
                    <a href="<?php echo $Rich_Web_Slider_Images[$i]->Sl_Link_Url;?>"
                        target="<?php if($Rich_Web_Slider_Images[$i]->Sl_Link_NewTab=='checked'){ echo '_blank';}?>"
                        class="mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                        <div style="overflow: auto; position: relative; margin-bottom: 20px;">
                            <img class="rw_fl_slider_img rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                src="<?php echo $link_vImg_sl;?>" data-image="<?php echo $link_vImg_sl;?>"
                                data-video="<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url;?>"
                                alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>">
                        </div>

                        <figcaption><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>
                        </figcaption>
                    </a>
                    <?php } ?>
                </figure>
                <?php }else{ ?>
                <span class="mis-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>">
                    <figure>
                        <div style="overflow: auto; position: relative; margin-bottom: 20px;">
                            <?php if($Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SVis == "on"){ ?>
                            <?php if($Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== '' && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== null && $Rich_Web_Slider_Videos[$i]->Sl_Video_Url !== "undefined") { ?>
                            <i class='rw_vfl_popup rw_vFlexable_ic rich_web rich_web-play'
                                data-image='<?php echo $link_vImg_sl; ?>'
                                data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
                            <?php } else { ?>
                            <i class='rw_vfl_popup rich_web rich_web-search' data-image='<?php echo $link_vImg_sl; ?>'
                                data-video='<?php echo $Rich_Web_Slider_Videos[$i]->Sl_Video_Url; ?>'></i>
                            <?php } ?>
                            <?php } ?>
                            <img class="rw_fl_slider_img rw_fl_slider_img<?php echo $Rich_Web_Slider_Manager[0]->id;?>"
                                src="<?php echo $link_vImg_sl;?>"
                                alt="<?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>">
                        </div>
                        <figcaption><?php echo html_entity_decode($Rich_Web_Slider_Images[$i]->SL_Img_Title);?>
                        </figcaption>
                    </figure>
                </span>
                <?php }?>
            </li>
            <?php } ?>
        </ol>
    </div>
</figure>
<input type='text' style='display:none;' class='RW_SL_Number' value='<?php echo $Rich_Web_Slider_Manager[0]->id;?>'>
<input type='text' style='display:none;' class='Rich_Web_Sl_FS_SVis<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_SVis;?>'>
<input type='text' style='display:none;' class='Rich_Web_Sl_FS_Arr_Type<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
    value='<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_FS_Arr_Type;?>'>