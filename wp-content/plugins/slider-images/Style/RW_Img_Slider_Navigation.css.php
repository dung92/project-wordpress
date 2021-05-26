<?php
	$text=$Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT;
	$text_array=str_split($text);
	$str_sum=0;
	$anim_sum=0.75;
?>
<style>
/* Browser Resets
*********************************/
.flex-container a:active,
.flexslider a:active,
.flex-container a:focus,
.flexslider a:focus {outline: none;}
.slides, .flex-control-nav, .flex-direction-nav {margin: 0 !important; padding: 0; list-style: none;}
/* FlexSlider Necessary Styles
*********************************/
.flexslider {margin: 0; padding: 0;}
.flexslider .slides > li {display: none; -webkit-backface-visibility: hidden;} /* Hide the slides before the JS is
loaded. Avoids image jumping */
.flexslider .slides img {width: 100%; display: block;box-sizing:border-box !important;}
.flex-pauseplay span {text-transform: capitalize;}
/* Clearfix for the .slides element */
.slides:after {content: "\0020"; display: block; clear: both; visibility: hidden; line-height: 0; height: 0;}
/* No JavaScript Fallback */
/* If you are not using another script, such as Modernizr, make sure you
* include js that eliminates this class on page load */
.no-js .slides > li:first-child {display: block;}
/* FlexSlider Default Theme
*********************************/
.flexslider { margin: 0 0 60px; background: #fff; border: 4px solid #fff; position: relative; -webkit-border-radius:
4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2);
-moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); box-shadow: 0 1px 4px
rgba(0,0,0,.2); zoom: 1; }
.flex-viewport { max-height: 2000px; -webkit-transition: all 1s ease; -moz-transition: all 1s ease; -o-transition: all
1s ease; transition: all 1s ease; }
.loading .flex-viewport { max-height: 300px; }
.flexslider .slides { zoom: 1;}
.carousel li { margin-right: 5px; }
/* Direction Nav */
.flex-direction-nav {*height: 0;}
.flex-direction-nav a { text-decoration:none; display: block; width: 40px; height: 40px; margin: -20px 0 0; position:
absolute; top: 50%; z-index: 10; overflow: hidden; opacity: 0; cursor: pointer; color: rgba(0,0,0,0.8); text-shadow: 1px
1px 0 rgba(255,255,255,0.3); -webkit-transition: all .3s ease; -moz-transition: all .3s ease; transition: all .3s ease;
}
.flex-direction-nav .flex-prev { left: -50px; }
.flex-direction-nav .flex-next { right: -50px; text-align: right; }
.flexslider:hover .flex-prev { opacity: 0.7; left: 10px; }
.flexslider:hover .flex-next { opacity: 0.7; right: 10px; }
.flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover { opacity: 1; }
.flex-direction-nav .flex-disabled { opacity: 0!important; filter:alpha(opacity=0); cursor: default; }
/* Control Nav */
.flex-control-nav {width: 100%; height: 30px; position: absolute; text-align: center;}
.flex-control-nav li { display: inline-block; zoom: 1; *display: inline;}
.flex-control-paging li a {background: transparent; display: block; cursor: pointer; text-indent: -9999px;
-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.3); -moz-box-shadow: inset 0 0 3px rgba(0,0,0,0.3); -o-box-shadow: inset
0 0 3px rgba(0,0,0,0.3); box-shadow: inset 0 0 3px rgba(0,0,0,0.3); }
.flex-control-paging li a.flex-active { cursor: default; }
.flex-control-thumbs {margin: 5px 0 0; position: static; overflow: hidden;}
.flex-control-thumbs li {width: 25%; float: left; margin: 0;}
.flex-control-thumbs img {width: 100%; display: block; opacity: .7; cursor: pointer;}
.flex-control-thumbs img:hover {opacity: 1;}
.flex-control-thumbs .flex-active {opacity: 1; cursor: default;}
@media screen and (max-width: 860px)
{
.flex-direction-nav .flex-prev { opacity: 1; left: 10px;}
.flex-direction-nav .flex-next { opacity: 1; right: 10px;}
}


/* override flexslider default style */
.flexslider { border:0; margin:0px; overflow:hidden; }
.flex-control-nav { width: 100%; position: absolute; text-align: center; z-index:900; }
.flex-direction-nav { width: 100%; position: absolute; left:0; margin: -50px 0 0; z-index:100;padding:0 !important; }
.flex-direction-nav li { overflow:visible; padding:0px 0px 0px 0px !important; margin:0px !important; list-style:none
!important; }
.flex-direction-nav a { overflow:visible; margin: 0; opacity: 1; color: rgba(0,0,0,0.8); text-indent:-9999em !important;
text-shadow: none; -webkit-box-shadow: none; -moz-box-shadow: none; -o-box-shadow: none; outline:none !important;
box-shadow:none !important; border:none !important; }
.flex-direction-nav .arrow { position: absolute; top:0; left:0; z-index:200; }
.flex-direction-nav .flex-prev { left:0px; height:50px; }
.flex-direction-nav .flex-next { right:0px; text-align: left; height:50px;}
.flexslider:hover .flex-prev { left:0; opacity:1}
.flexslider:hover .flex-next { right:0; opacity:1}
.flexslider:hover .flex-prev:hover, .flexslider:hover .flex-next:hover { background-color: #fff; opacity:1; }
.flexslider .slides > li:before,.flex-control-nav > li:before, .flex-direction-nav > li:before { content: '' !important;
}
.immersive_slider { background: #161923; max-width: 100%; height: 480px; opacity: .9; box-sizing: border-box;
-moz-box-sizing: border-box; -webkit-box-sizing: border-box; position: relative; overflow: hidden; }
.immersive_slider .is-slide { display: block; height: 100%; width: 100%; box-sizing: border-box; -moz-box-sizing:
border-box; -webkit-box-sizing: border-box; padding: 50px 60px; position: absolute; }
.is-bg-overflow { width: 100%; height: 100%; position: absolute; z-index: 0; }
.is-overflow, .is-bg-overflow { height: 100%; }
.ease { -webkit-transition: 1000ms ease all; -moz-transition: 1000ms ease all; -o-transition: 1000ms ease all;
transition: 1000ms ease all; }
.bounce { -webkit-transition: 1000ms cubic-bezier(0.175, 0.885, 0.420, 1) all; -moz-transition: 1000ms
cubic-bezier(0.175, 0.885, 0.420, 1.310) all; -o-transition: 1000ms cubic-bezier(0.175, 0.885, 0.420, 1.310) 0 all;
transition: 2000ms cubic-bezier(0.175, 0.885, 0.420, 1.310) all; }
.bounce2 { -webkit-transition: 1000ms cubic-bezier( 0.420, 0.175, 0.885, 1) all; -moz-transition: 1000ms cubic-bezier(
0.420, 0.175, 0.885, -1.310) all; -o-transition: 1000ms cubic-bezier( 0.420, 0.175, 0.885, -1.310) all; transition:
2000ms cubic-bezier( 0.420, 0.175, 0.885, -1.310) all; }
.bounceUp2 { -webkit-transition: 1000ms cubic-bezier(0.175, 0.885, 0.420, 1) all; -moz-transition: 1000ms
cubic-bezier(0.175, 0.885, 0.420, -1.310) all; -o-transition: 1000ms cubic-bezier(0.175, 0.885, 0.420, -1.310) all;
transition: 2000ms cubic-bezier(0.175, 0.885, 0.420, -1.310) all; }
.bounceUp3 { -webkit-transition: 1000ms cubic-bezier(0.175, 0.885, 0.420, 1) all; -moz-transition: 1000ms
cubic-bezier(0.175, -0.885, 0.420, 1.310) all; -o-transition: 1000ms cubic-bezier(0.175, -0.885, 0.420, 1.310) all;
transition: 2000ms cubic-bezier(0.175, -0.885, 0.420, 1.310) all; }
.no-animation { -webkit-transition: none!important; -moz-transition: none!important; -o-transition: none!important;
transition: none !important; }
.immersive_slider .is-slide .image img { position:relative; max-width: 100%; display: inline !important; width: 100%
!important; height:100% !important; max-height:100%; object-fit: contain !important; }
.immersive_slider .is-slide .image iframe { max-width: 100%; display: block; width: 100%; }
.immersive_slider .is-slide .content h2 { font-size: 42px; font-weight: 300; text-align: left; }
.is-container { position: relative; overflow: hidden; }
.is-container .is-background { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
.is-container .is-background.gs_cssblur { -webkit-filter: blur(20px); -moz-filter: blur(20px); -o-filter: blur(20px);
filter: blur(20px); }
.is-pagination li { padding: 0; display: inline-block; text-align: center; position: relative; margin:0px !important;
padding:0px !important; }
.is-pagination li a { padding: 10px; width: 4px; height: 4px; display: block; box-shadow:none !important;
-moz-box-shadow:none !important; -webkit-box-shadow:none !important; outline:none !important; border:none !important; }
.is-pagination li a:before { content: ''; position: absolute; width: 4px; height: 4px; background:
rgba(255,255,255,0.85); border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; }
.is-pagination li a.active:before { width: 10px; height: 10px; background: none; border: 1px solid white; margin-top:
-4px; left: 8px; }
.is-next { right: 10px !important; }
.is-prev { left: 10px !important; }
a { text-decoration: none !important; }
a:hover { text-decoration: none; }
.wrapper { margin: 25px auto !important; }
.cn-slideshow { position: relative; margin: 0 auto; background: transparent; }
.cn-loading { position: absolute; z-index:999; text-indent: -9000px; top:50%; left:50%; margin:-25px 0 0 -25px;
width:50px; height:50px; background:url(../Images/ajax-loader.gif) no-repeat center center; -moz-border-radius: 25px;
-webkit-border-radius: 25px; border-radius: 25px; }
.cn-images { width: 100%; height: 100%; overflow: hidden; position: relative; }
.cn-images img { position: absolute; top: 0px; left: 0px; display: none; width: 100%; height: 100%; }
.cn-bar { height: 74px; position: absolute; right: 50px; left: 50px; color: #f8f8f8; z-index: 999; }
.cn-nav-content { position: absolute; top: 0px; height: 100%; right: 70px; left: 70px; }
.cn-nav-content div { float: left; }
.cn-nav-content div.cn-nav-content-current { text-align: center; width: 280px; position:absolute; top:0px; left:50%;
margin-left:-140px; }
.cn-nav-content h2, .cn-nav-content h3{ padding: 0; margin: 0; }
.cn-nav-content div.cn-nav-content-prev { margin-left: 20px; }
.cn-nav-content div.cn-nav-content-next { text-align: right; margin-right: 20px; float:right; }
.cn-nav-content div span { display: block; margin-top: 5px; }
.cn-nav > a { position: absolute; top: 0px; height: 70px; width: 0px; z-index:2 !important; }
a.cn-nav-prev { left: 0px; text-decoration:none !important; border:none !important; box-shadow:none !important;
-moz-box-shadow:none !important; -webkit-box-shadow:none !important; outline:none !important; }
a.cn-nav-next { right: 0px; text-decoration:none !important; border:none !important; box-shadow:none !important;
-moz-box-shadow:none !important; -webkit-box-shadow:none !important; outline:none !important; }
.cn-nav a span { width: 46px; height: 46px; display: block; text-indent: -9000px; opacity: 0.9; position: absolute; top:
50%; left: 50%; background-size: 17px 25px; margin: -23px 0 0 -23px; perspective-origin:800px !important;
-webkit-perspective-origin:800px !important; -ms-perspective-origin:800px !important; -moz-perspective-origin:800px
!important; -o-perspective-origin:800px !important; -webkit-transition: width 0.3s ease, height 0.3s ease, margin 0.3s
ease !important; -moz-transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease, margin 0.3s ease !important;
-o-transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease, margin 0.3s ease !important; -ms-transition: width
0.3s ease, height 0.3s ease, opacity 0.3s ease, margin 0.3s ease !important; transition: width 0.3s ease, height 0.3s
ease, margin 0.3s ease !important; overflow: hidden; }
.cn-nav a div { width: 90px; height: 90px; position: absolute; top: 50%; left: 50%; perspective-origin:800px !important;
-webkit-perspective-origin:800px !important; -ms-perspective-origin:800px !important; -moz-perspective-origin:800px
!important; -o-perspective-origin:800px !important; transform:translateY(-50%) translateX(-50%) translateZ(0)
scale(0,0); -webkit-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(0,0); -ms-transform:translateY(-50%)
translateX(-50%) translateZ(0) scale(0,0); -moz-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(0,0);
-o-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(0,0); -webkit-backface-visibility:hidden; overflow:
hidden; perspective:800px !important; background-size: 100% 100%; background-position: center center; background-repeat:
no-repeat; margin: 0px; -moz-border-radius: 0px; -webkit-border-radius: 0px; border-radius: 25px; -webkit-filter:
inherit; filter: inherit; -webkit-transition: transform 0.3s ease, background-size 0s ease !important; -moz-transition:
transform 0.3s ease, background-size 0s ease !important; -o-transition: transform 0.3s ease, background-size 0s ease
!important; -ms-transition: transform 0.3s ease, background-size 0s ease !important; transition: transform 0.3s ease,
background-size 0s ease !important; }
.cn-nav a:hover span { width: 100px; height: 100px; opacity: 0.6; margin: -50px 0 0 -50px; background-size: 22px 32px; }
.cn-nav a:hover div { transform:translateY(-50%) translateX(-50%) translateZ(0) scale(1,1);
-webkit-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(1,1); -ms-transform:translateY(-50%)
translateX(-50%) translateZ(0) scale(1,1); -moz-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(1,1);
-o-transform:translateY(-50%) translateX(-50%) translateZ(0) scale(1,1); background-size: 120% 120%; }
#colorbox, #cboxOverlay, #cboxWrapper{position:absolute; top:0; left:0; z-index:9999; overflow:hidden;}
#cboxOverlay{position:fixed; width:100%; height:100%;}
#cboxMiddleLeft, #cboxBottomLeft{clear:left;}
#cboxContent{position:relative;}
#cboxLoadedContent{overflow:auto;}
#cboxTitle{margin:0;}
#cboxLoadingOverlay, #cboxLoadingGraphic{position:absolute; top:0; left:0; width:100%; height:100%;}
#cboxPrevious, #cboxNext, #cboxClose, #cboxSlideshow{cursor:pointer;}
.cboxPhoto{float:left; margin:auto; border:0; display:block; max-width:none;}
#colorbox, #cboxContent, #cboxLoadedContent{box-sizing:content-box; -moz-box-sizing:content-box;
-webkit-box-sizing:content-box;display: none !important;}
#cboxError{padding:50px; border:1px solid #ccc;}
#cboxLoadedContent{margin-bottom:38px; margin-top: 5px;}
#cboxTitle{position:absolute; bottom:0px; left:0; text-align:center; width:100%; }
#cboxCurrent{position:absolute; bottom:0px; left:100px;}
#cboxSlideshow{position:absolute; bottom:4px; right:30px; color:#0092ef;}
#cboxPrevious{position:absolute; bottom:0; left:5px; }
#cboxNext{position:absolute; bottom:0; left:48px; }
#cboxLoadingGraphic{background:url(../Images/ajax-loader.gif) no-repeat center center;}
#cboxClose{position:absolute; bottom:0; right:5px; }
#cboxPrevious:hover, #cboxNext:hover, #cboxClose:hover {opacity: 0.8; }
@media all and (max-width: 750px) { #cboxCurrent{position:absolute; bottom:0px; left:100px; display:none !important}; }

<?php if(!empty($Rich_Web_Slider_Effect_Loader)){ ?>

.center_content<?php echo $Rich_Web_Slider;?>
{
position:relative;
overflow:visible;
top:50%;
transform:translateY(-50%);
-webkit-transform:translateY(-50%);
-ms-transform:translateY(-50%);
-moz-transform:translateY(-50%);
-o-transform:translateY(-50%);
}
#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>
{
margin:20px auto !important;
background-color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_BgC;?> !important;
z-index:999;
width:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
height:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>px;
max-width:100% !important;
}

<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?> { width:45px !important; height:45px !important; }
.loader_Navigation1<?php echo $Rich_Web_Slider;?>
{
border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
}
.loader_Navigation2<?php echo $Rich_Web_Slider;?>
{
border-top: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
border-bottom: 3px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
}
.loader_Navigation3<?php echo $Rich_Web_Slider;?>
{
border-top:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-bottom:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-right:12px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
width:50% !important;
height:50%!important;
}
<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?> { width:60px !important; height:60px !important; }
.loader_Navigation1<?php echo $Rich_Web_Slider;?>
{
border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
}
.loader_Navigation2<?php echo $Rich_Web_Slider;?>
{
border-top: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
border-bottom: 4px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
}
.loader_Navigation3<?php echo $Rich_Web_Slider;?>
{
border-top:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-bottom:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-right:17px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
width:55% !important;
height:55%!important;
}
<?php } else { ?>
.RW_Loader_Frame_Navigation<?php echo $Rich_Web_Slider;?> { width:80px !important; height:80px !important; }
.loader_Navigation1<?php echo $Rich_Web_Slider;?>
{
border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T1_C;?> !important;
}
.loader_Navigation2<?php echo $Rich_Web_Slider;?>
{
border-top: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
border-bottom: 5px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T2_C;?> !important;
}
.loader_Navigation3<?php echo $Rich_Web_Slider;?>
{
border-top:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-bottom:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
border-right:25px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_T3_C;?> !important;
width:60% !important;
height:60%!important;
}
<?php } ?>
.RW_Loader_Frame_Navigation
{
position:relative;
left:50%;
width:80px;
height:80px;
transform:translateX(-50%);
-webkit-transform:translateX(-50%);
-ms-transform:translateX(-50%);
-moz-transform:translateX(-50%);
-o-transform:translateX(-50%);
}
.RW_Loader_Text_Navigation<?php echo $Rich_Web_Slider;?>
{
position:relative;
text-align:center;
margin-top:10px;
font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS;?>px !important;
font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF;?> !important;
color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important;
}
.loader_Navigation1,.loader_Navigation2,.loader_Navigation3,.loader_Navigation4
{
position:absolute;
border:5px solid transparent;
border-radius:50%;
}
.loader_Navigation1<?php echo $Rich_Web_Slider;?>
{
box-sizing:border-box;
-webkit-box-sizing:border-box;
-ms-box-sizing:border-box;
-moz-box-sizing:border-box;
-o-box-sizing:border-box;
}
.loader_Navigation2<?php echo $Rich_Web_Slider;?>
{
-webkit-box-sizing:border-box;
-ms-box-sizing:border-box;
-moz-box-sizing:border-box;
-o-box-sizing:border-box;
top:50%;
left:50%;
transform:translateY(-50%) translateX(-50%);
-webkit-transform:translateY(-50%) translateX(-50%);
-ms-transform:translateY(-50%) translateX(-50%);
-moz-transform:translateY(-50%) translateX(-50%);
-o-transform:translateY(-50%) translateX(-50%);
}
.loader_Navigation3<?php echo $Rich_Web_Slider;?>
{
width:60%;
height:60%;
top:50%;
left:50%;
box-sizing:border-box;
-webkit-box-sizing:border-box;
-ms-box-sizing:border-box;
-moz-box-sizing:border-box;
-o-box-sizing:border-box;
transform:translateY(-50%) translateX(-50%);
-webkit-transform:translateY(-50%) translateX(-50%);
-ms-transform:translateY(-50%) translateX(-50%);
-moz-transform:translateY(-50%) translateX(-50%);
-o-transform:translateY(-50%) translateX(-50%);
animation:clockLoadingmin 1s linear 500;
-webkit-animation:clockLoadingmin 1s linear 500;
-ms-animation:clockLoadingmin 1s linear 500;
-moz-animation:clockLoadingmin 1s linear 500;
-o-animation:clockLoadingmin 1s linear 500;
}
.loader_Navigation1
{
width:100%;
height:100%;
animation:clockLoading 1s linear 500;
-webkit-animation:clockLoading 1s linear 500;
-ms-animation:clockLoading 1s linear 500;
-moz-animation:clockLoading 1s linear 500;
-o-animation:clockLoading 1s linear 500;
}
.loader_Navigation2
{
width:80%;
height:80%;
animation:anticlockLoading 1s linear 500;
-webkit-animation:anticlockLoading 1s linear 500;
-ms-animation:anticlockLoading 1s linear 500;
-moz-animation:anticlockLoading 1s linear 500;
-o-animation:anticlockLoading 1s linear 500;
}
@keyframes clockLoading { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
@keyframes anticlockLoading { from { transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
transform:translateY(-50%) translateX(-50%) rotate(-360deg); } }
@keyframes clockLoadingmin { from { transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
transform:translateY(-50%) translateX(-50%) rotate(360deg);} }
@-moz-keyframes clockLoading { from { -moz-transform:rotate(0deg); } to { -moz-transform:rotate(360deg); } }
@-moz-keyframes anticlockLoading { from { -moz-transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
-moz-transform:translateY(-50%) translateX(-50%) rotate(-360deg); } }
@-moz-keyframes clockLoadingmin { from { -moz-transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
-moz-transform:translateY(-50%) translateX(-50%) rotate(360deg);} }
@-webkit-keyframes clockLoading { from { -webkit-transform:rotate(0deg); } to { -webkit-transform:rotate(360deg); } }
@-webkit-keyframes anticlockLoading { from { -webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
-webkit-transform:translateY(-50%) translateX(-50%) rotate(-360deg); } }
@-webkit-keyframes clockLoadingmin { from { -webkit-transform:translateY(-50%) translateX(-50%) rotate(0deg); } to {
-webkit-transform:translateY(-50%) translateX(-50%) rotate(360deg);} }
/*Second Loader*/
.overlay-loader<?php echo $Rich_Web_Slider;?> { display: block; margin: auto; width: 97px; height: 60px; position:
relative; top: 0; left: 0; right: 0; bottom: 0; }
<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
.overlay-loader<?php echo $Rich_Web_Slider;?> { height: 40px !important; }
.loader<?php echo $Rich_Web_Slider;?> { width: 49px !important; height: 49px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(2) { width: 3px !important; height: 3px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(3) { width: 9px !important; height: 9px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(4) { width: 14px !important; height: 14px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(5) { width: 19px !important; height: 19px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(6) { width: 24px !important; height: 24px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(7) { width: 28px !important; height: 28px !important; }
<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
.overlay-loader<?php echo $Rich_Web_Slider;?> { height: 50px !important; }
.loader<?php echo $Rich_Web_Slider;?> { width: 67px !important; height: 67px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(2) { width: 8px !important; height: 8px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(3) { width: 14px !important; height: 14px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(4) { width: 20px !important; height: 20px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(5) { width: 26px !important; height: 26px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(6) { width: 32px !important; height: 32px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(7) { width: 38px !important; height: 38px !important; }
<?php } else { ?>
.loader<?php echo $Rich_Web_Slider;?> { width: 97px !important; height: 97px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(2) { width: 12px !important; height: 12px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(3) { width: 18px !important; height: 18px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(4) { width: 23px !important; height: 23px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(5) { width: 31px !important; height: 31px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(6) { width: 39px !important; height: 39px !important; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(7) { width: 49px !important; height: 49px !important; }
<?php } ?>
.loader<?php echo $Rich_Web_Slider;?>
{
position: absolute;
top: 0;
left: 0;
right: 0;
bottom: 0;
margin: auto;
width: 97px;
height: 97px;
animation-name: rotateAnim;
-o-animation-name: rotateAnim;
-ms-animation-name: rotateAnim;
-webkit-animation-name: rotateAnim;
-moz-animation-name: rotateAnim;
animation-duration: 0.4s;
-o-animation-duration: 0.4s;
-ms-animation-duration: 0.4s;
-webkit-animation-duration: 0.4s;
-moz-animation-duration: 0.4s;
animation-iteration-count: infinite;
-o-animation-iteration-count: infinite;
-ms-animation-iteration-count: infinite;
-webkit-animation-iteration-count: infinite;
-moz-animation-iteration-count: infinite;
animation-timing-function: linear;
-o-animation-timing-function: linear;
-ms-animation-timing-function: linear;
-webkit-animation-timing-function: linear;
-moz-animation-timing-function: linear;
}
.loader<?php echo $Rich_Web_Slider;?> div
{
width: 8px;
height: 8px;
border-radius: 50%;
border: 1px solid <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C;?>;
position: absolute;
top: 2px;
left: 0;
right: 0;
bottom: 0;
margin: auto;
}
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(odd) { border-top: none; border-left: none; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(even) { border-bottom: none; border-right: none; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(2) { border-width: 2px; left: 0px; top: -4px; width: 12px; height:
12px; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(3) { border-width: 2px; left: -1px; top: 3px; width: 18px; height:
18px; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(4) { border-width: 3px; left: -1px; top: -4px; width: 23px; height:
23px; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(5) { border-width: 3px; left: -1px; top: 4px; width: 31px; height:
31px; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(6) { border-width: 4px; left: 0px; top: -4px; width: 39px; height:
39px; }
.loader<?php echo $Rich_Web_Slider;?> div:nth-child(7) { border-width: 4px; left: 0px; top: 6px; width: 49px; height:
49px; }
@keyframes rotateAnim { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }
@-o-keyframes rotateAnim { from { -o-transform: rotate(360deg); } to { -o-transform: rotate(0deg); } }
@-ms-keyframes rotateAnim { from { -ms-transform: rotate(360deg); } to { -ms-transform: rotate(0deg); } }
@-webkit-keyframes rotateAnim { from { -webkit-transform: rotate(360deg); } to { -webkit-transform: rotate(0deg); } }
@-moz-keyframes rotateAnim { from { -moz-transform: rotate(360deg); } to { -moz-transform: rotate(0deg); } }
/*Third Loader*/
<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
.windows8<?php echo $Rich_Web_Slider;?> { width: 45px !important; height:45px !important; }
.windows8<?php echo $Rich_Web_Slider;?> .wBall { width: 42px !important; height: 42px !important; }
<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
.windows8<?php echo $Rich_Web_Slider;?> { width: 60px !important; height:60px !important; }
.windows8<?php echo $Rich_Web_Slider;?> .wBall { width: 56px !important; height: 56px !important; }
<?php } else { ?>
.windows8<?php echo $Rich_Web_Slider;?> { width: 78px !important; height:78px !important; }
.windows8<?php echo $Rich_Web_Slider;?> .wBall { width: 74px !important; height: 74px !important; }
<?php } ?>
.windows8<?php echo $Rich_Web_Slider;?> { position: relative; width: 78px; height:78px; margin:auto; }
.windows8<?php echo $Rich_Web_Slider;?> .wBall
{
position: absolute;
width: 74px;
height: 74px;
opacity: 0;
transform: rotate(225deg);
-o-transform: rotate(225deg);
-ms-transform: rotate(225deg);
-webkit-transform: rotate(225deg);
-moz-transform: rotate(225deg);
animation: orbit 6.96s infinite;
-o-animation: orbit 6.96s infinite;
-ms-animation: orbit 6.96s infinite;
-webkit-animation: orbit 6.96s infinite;
-moz-animation: orbit 6.96s infinite;
}
.windows8<?php echo $Rich_Web_Slider;?> .wBall .wInnerBall
{
position: absolute;
width: 10px;
height: 10px;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C;?>;
left:0px;
top:0px;
border-radius: 10px;
}
.windows8<?php echo $Rich_Web_Slider;?> #wBall_1
{
animation-delay: 1.52s;
-o-animation-delay: 1.52s;
-ms-animation-delay: 1.52s;
-webkit-animation-delay: 1.52s;
-moz-animation-delay: 1.52s;
}
.windows8<?php echo $Rich_Web_Slider;?> #wBall_2
{
animation-delay: 0.3s;
-o-animation-delay: 0.3s;
-ms-animation-delay: 0.3s;
-webkit-animation-delay: 0.3s;
-moz-animation-delay: 0.3s;
}
.windows8<?php echo $Rich_Web_Slider;?> #wBall_3
{
animation-delay: 0.61s;
-o-animation-delay: 0.61s;
-ms-animation-delay: 0.61s;
-webkit-animation-delay: 0.61s;
-moz-animation-delay: 0.61s;
}
.windows8<?php echo $Rich_Web_Slider;?> #wBall_4
{
animation-delay: 0.91s;
-o-animation-delay: 0.91s;
-ms-animation-delay: 0.91s;
-webkit-animation-delay: 0.91s;
-moz-animation-delay: 0.91s;
}
.windows8<?php echo $Rich_Web_Slider;?> #wBall_5
{
animation-delay: 1.22s;
-o-animation-delay: 1.22s;
-ms-animation-delay: 1.22s;
-webkit-animation-delay: 1.22s;
-moz-animation-delay: 1.22s;
}
@keyframes orbit
{
0% { opacity: 1; z-index:99; transform: rotate(180deg); animation-timing-function: ease-out; }
7% { opacity: 1; transform: rotate(300deg); animation-timing-function: linear; origin:0%; }
30% { opacity: 1; transform:rotate(410deg); animation-timing-function: ease-in-out; origin:7%; }
39% { opacity: 1; transform: rotate(645deg); animation-timing-function: linear; origin:30%; }
70% { opacity: 1; transform: rotate(770deg); animation-timing-function: ease-out; origin:39%; }
75% { opacity: 1; transform: rotate(900deg); animation-timing-function: ease-out; origin:70%; }
76% { opacity: 0; transform: rotate(900deg); }
100% { opacity: 0; transform: rotate(900deg); }
}
@-o-keyframes orbit
{
0% { opacity: 1; z-index:99; -o-transform: rotate(180deg); -o-animation-timing-function: ease-out; }
7% { opacity: 1; -o-transform: rotate(300deg); -o-animation-timing-function: linear; -o-origin:0%; }
30% { opacity: 1; -o-transform:rotate(410deg); -o-animation-timing-function: ease-in-out; -o-origin:7%; }
39% { opacity: 1; -o-transform: rotate(645deg); -o-animation-timing-function: linear; -o-origin:30%; }
70% { opacity: 1; -o-transform: rotate(770deg); -o-animation-timing-function: ease-out; -o-origin:39%; }
75% { opacity: 1; -o-transform: rotate(900deg); -o-animation-timing-function: ease-out; -o-origin:70%; }
76% { opacity: 0; -o-transform:rotate(900deg); }
100% { opacity: 0; -o-transform: rotate(900deg); }
}
@-ms-keyframes orbit
{
0% { opacity: 1; z-index:99; -ms-transform: rotate(180deg); -ms-animation-timing-function: ease-out; }
7% { opacity: 1; -ms-transform: rotate(300deg); -ms-animation-timing-function: linear; -ms-origin:0%; }
30% { opacity: 1; -ms-transform:rotate(410deg); -ms-animation-timing-function: ease-in-out; -ms-origin:7%; }
39% { opacity: 1; -ms-transform: rotate(645deg); -ms-animation-timing-function: linear; -ms-origin:30%; }
70% { opacity: 1; -ms-transform: rotate(770deg); -ms-animation-timing-function: ease-out; -ms-origin:39%; }
75% { opacity: 1; -ms-transform: rotate(900deg); -ms-animation-timing-function: ease-out; -ms-origin:70%; }
76% { opacity: 0; -ms-transform:rotate(900deg); }
100% { opacity: 0; -ms-transform: rotate(900deg); }
}
@-webkit-keyframes orbit
{
0% { opacity: 1; z-index:99; -webkit-transform: rotate(180deg); -webkit-animation-timing-function: ease-out; }
7% { opacity: 1; -webkit-transform: rotate(300deg); -webkit-animation-timing-function: linear; -webkit-origin:0%; }
30% { opacity: 1; -webkit-transform:rotate(410deg); -webkit-animation-timing-function: ease-in-out; -webkit-origin:7%; }
39% { opacity: 1; -webkit-transform: rotate(645deg); -webkit-animation-timing-function: linear; -webkit-origin:30%; }
70% { opacity: 1; -webkit-transform: rotate(770deg); -webkit-animation-timing-function: ease-out; -webkit-origin:39%; }
75% { opacity: 1; -webkit-transform: rotate(900deg); -webkit-animation-timing-function: ease-out; -webkit-origin:70%; }
76% { opacity: 0; -webkit-transform:rotate(900deg); }
100% { opacity: 0; -webkit-transform: rotate(900deg); }
}
@-moz-keyframes orbit
{
0% { opacity: 1; z-index:99; -moz-transform: rotate(180deg); -moz-animation-timing-function: ease-out; }
7% { opacity: 1; -moz-transform: rotate(300deg); -moz-animation-timing-function: linear; -moz-origin:0%; }
30% { opacity: 1; -moz-transform:rotate(410deg); -moz-animation-timing-function: ease-in-out; -moz-origin:7%; }
39% { opacity: 1; -moz-transform: rotate(645deg); -moz-animation-timing-function: linear; -moz-origin:30%; }
70% { opacity: 1; -moz-transform: rotate(770deg); -moz-animation-timing-function: ease-out; -moz-origin:39%; }
75% { opacity: 1; -moz-transform: rotate(900deg); -moz-animation-timing-function: ease-out; -moz-origin:70%; }
76% { opacity: 0; -moz-transform:rotate(900deg); }
100% { opacity: 0; -moz-transform: rotate(900deg); }
}
/*Fourth loader*/
<?php if($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "small") { ?>
.cssload-thecube<?php echo $Rich_Web_Slider;?> { width: 30px !important; height: 30px !important; }
<?php } elseif($Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_S == "middle") { ?>
.cssload-thecube<?php echo $Rich_Web_Slider;?> { width: 40px !important; height: 40px !important; }
<?php } else { ?>
.cssload-thecube<?php echo $Rich_Web_Slider;?> { width: 50px !important; height: 50px !important; }
<?php } ?>
.cssload-thecube<?php echo $Rich_Web_Slider;?>
{
width: 50px;
height: 50px;
margin: 20px auto;
position: relative;
transform: rotateZ(45deg);
-o-transform: rotateZ(45deg);
-ms-transform: rotateZ(45deg);
-webkit-transform: rotateZ(45deg);
-moz-transform: rotateZ(45deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube
{
position: relative;
transform: rotateZ(45deg);
-o-transform: rotateZ(45deg);
-ms-transform: rotateZ(45deg);
-webkit-transform: rotateZ(45deg);
-moz-transform: rotateZ(45deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube
{
float: left;
width: 50%;
height: 50%;
position: relative;
transform: scale(1.1);
-o-transform: scale(1.1);
-ms-transform: scale(1.1);
-webkit-transform: scale(1.1);
-moz-transform: scale(1.1);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube:before
{
content: "";
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_L_C;?>;
animation: cssload-fold-thecube 2.76s infinite linear both;
-o-animation: cssload-fold-thecube 2.76s infinite linear both;
-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
transform-origin: 100% 100%;
-o-transform-origin: 100% 100%;
-ms-transform-origin: 100% 100%;
-webkit-transform-origin: 100% 100%;
-moz-transform-origin: 100% 100%;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c2
{
transform: scale(1.1) rotateZ(90deg);
-o-transform: scale(1.1) rotateZ(90deg);
-ms-transform: scale(1.1) rotateZ(90deg);
-webkit-transform: scale(1.1) rotateZ(90deg);
-moz-transform: scale(1.1) rotateZ(90deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c3
{
transform: scale(1.1) rotateZ(180deg);
-o-transform: scale(1.1) rotateZ(180deg);
-ms-transform: scale(1.1) rotateZ(180deg);
-webkit-transform: scale(1.1) rotateZ(180deg);
-moz-transform: scale(1.1) rotateZ(180deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c4
{
transform: scale(1.1) rotateZ(270deg);
-o-transform: scale(1.1) rotateZ(270deg);
-ms-transform: scale(1.1) rotateZ(270deg);
-webkit-transform: scale(1.1) rotateZ(270deg);
-moz-transform: scale(1.1) rotateZ(270deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c2:before
{
animation-delay: 0.35s;
-o-animation-delay: 0.35s;
-ms-animation-delay: 0.35s;
-webkit-animation-delay: 0.35s;
-moz-animation-delay: 0.35s;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c3:before
{
animation-delay: 0.69s;
-o-animation-delay: 0.69s;
-ms-animation-delay: 0.69s;
-webkit-animation-delay: 0.69s;
-moz-animation-delay: 0.69s;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c4:before
{
animation-delay: 1.04s;
-o-animation-delay: 1.04s;
-ms-animation-delay: 1.04s;
-webkit-animation-delay: 1.04s;
-moz-animation-delay: 1.04s;
}
@keyframes cssload-fold-thecube
{
0%, 10% { transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-o-keyframes cssload-fold-thecube
{
0%, 10% { -o-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -o-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -o-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-ms-keyframes cssload-fold-thecube
{
0%, 10% { -ms-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -ms-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -ms-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-webkit-keyframes cssload-fold-thecube
{
0%, 10% { -webkit-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -webkit-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -webkit-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-moz-keyframes cssload-fold-thecube
{
0%, 10% { -moz-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -moz-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -moz-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
/*First Text*/
.cssload-loader<?php echo $Rich_Web_Slider;?>
{
width: 244px;
height: 49px;
line-height: 49px;
text-align: center;
position: relative;
left: 50%;
transform: translate(-50%, 0%);
-o-transform: translate(-50%, 0%);
-ms-transform: translate(-50%, 0%);
-webkit-transform: translate(-50%, 0%);
-moz-transform: translate(-50%, 0%);
font-family: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF;?> !important;
text-transform: none !important;
font-weight: 900;
font-size:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS;?>px !important;
color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important;
letter-spacing: 0.2em;
margin-top:10px;
}
.cssload-loader<?php echo $Rich_Web_Slider;?>::before, .cssload-loader<?php echo $Rich_Web_Slider;?>::after
{
content: "";
display: block;
width: 15px;
height: 15px;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_BC;?> !important;
position: absolute;
animation: cssload-load 0.81s infinite alternate ease-in-out;
-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
}
.cssload-loader<?php echo $Rich_Web_Slider;?>::before { top: 0; }
.cssload-loader<?php echo $Rich_Web_Slider;?>::after { bottom: 0; }
@keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left:
229px; height: 29px; width: 15px; } }
@-o-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left:
229px; height: 29px; width: 15px; } }
@-ms-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left:
229px; height: 29px; width: 15px; } }
@-moz-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% { left:
229px; height: 29px; width: 15px; } }
@-webkit-keyframes cssload-load { 0% { left: 0; height: 29px; width: 15px; } 50% { height: 8px; width: 39px; } 100% {
left: 229px; height: 29px; width: 15px; } }
/*Second*/
#inTurnFadingTextG<?php echo $Rich_Web_Slider;?> { width:100%; margin:auto; text-align:center; }
.inTurnFadingTextG<?php echo $Rich_Web_Slider;?>
{
font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS;?>px !important;
font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF;?> !important;
color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important;
text-decoration:none;
font-weight:normal;
font-style:normal;
display:inline-block;
animation-name:bounce_inTurnFadingTextG;
-o-animation-name:bounce_inTurnFadingTextG;
-ms-animation-name:bounce_inTurnFadingTextG;
-webkit-animation-name:bounce_inTurnFadingTextG;
-moz-animation-name:bounce_inTurnFadingTextG;
animation-duration:2.09s;
-o-animation-duration:2.09s;
-ms-animation-duration:2.09s;
-webkit-animation-duration:2.09s;
-moz-animation-duration:2.09s;
animation-iteration-count:infinite;
-o-animation-iteration-count:infinite;
-ms-animation-iteration-count:infinite;
-webkit-animation-iteration-count:infinite;
-moz-animation-iteration-count:infinite;
animation-direction:normal;
-o-animation-direction:normal;
-ms-animation-direction:normal;
-webkit-animation-direction:normal;
-moz-animation-direction:normal;
}
<?php foreach($text_array as $key=>$v) { ?>
#inTurnFadingTextG<?php echo $Rich_Web_Slider;?>_<?php Print $key+1;?>
{
animation-delay:<?php Print $anim_sum;?>s !important;
-o-animation-delay:<?php Print $anim_sum;?>s !important;
-ms-animation-delay:<?php Print $anim_sum;?>s !important;
-webkit-animation-delay:<?php Print $anim_sum;?>s !important;
-moz-animation-delay:<?php Print $anim_sum;?>s !important;
}
<?php $anim_sum=$anim_sum+0.15;?>
<?php } ?>
@keyframes bounce_inTurnFadingTextG
{
0% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC;?>; }
100% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important; }
}
@-o-keyframes bounce_inTurnFadingTextG
{
0% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC;?>; }
100% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important; }
}
@-ms-keyframes bounce_inTurnFadingTextG
{
0% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC;?>; }
100% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important; }
}
@-moz-keyframes bounce_inTurnFadingTextG
{
0% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC;?>; }
100% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important; }
}
@-webkit-keyframes bounce_inTurnFadingTextG
{
0% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T2_AnC;?>; }
100% { color:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important; }
}
/*Third text*/
.cssload-preloader<?php echo $Rich_Web_Slider;?> { position: relative; top: 0px; left: 0px; right: 0px; bottom: 0px;
z-index: 10; }
.cssload-preloader<?php echo $Rich_Web_Slider;?> > .cssload-preloader<?php echo $Rich_Web_Slider;?>-box
{
position: relative;
display:inline-block;
margin-left:10px;
margin-top:20px;
height: 29px;
left:50%;
transform:translateX(-50%) !important;
-webkit-transform:translateX(-50%) !important;
-ms-transform:translateX(-50%) !important;
-moz-transform:translateX(-50%) !important;
-o-transform:translateX(-50%) !important;
perspective: 195px;
-o-perspective: 195px;
-ms-perspective: 195px;
-webkit-perspective: 195px;
-moz-perspective: 195px;
}
.cssload-preloader<?php echo $Rich_Web_Slider;?> .cssload-preloader<?php echo $Rich_Web_Slider;?>-box > div
{
position: relative;
width: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS*2;?>px;
height: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS*2;?>px;
background: rgb(204,204,204);
float: left;
text-align: center;
line-height: 2;
font-size: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS;?>px !important;
font-family:<?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FF;?> !important;
color: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_C;?> !important;
}
<?php foreach($text_array as $key=>$v) { ?>
.cssload-preloader<?php echo $Rich_Web_Slider;?> .cssload-preloader<?php echo $Rich_Web_Slider;?>-box >
div:nth-child(<?php Print $key+1;?>)
{
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
margin-right: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_FS;?>px !important;
animation: cssload-movement<?php echo $Rich_Web_Slider;?> 690ms ease <?php Print $str_sum;?>ms infinite alternate;
-o-animation: cssload-movement<?php echo $Rich_Web_Slider;?> 690ms ease <?php Print $str_sum;?>ms infinite alternate;
-ms-animation: cssload-movement<?php echo $Rich_Web_Slider;?> 690ms ease <?php Print $str_sum;?>ms infinite alternate;
-webkit-animation: cssload-movement<?php echo $Rich_Web_Slider;?> 690ms ease <?php Print $str_sum;?>ms infinite
alternate;
-moz-animation: cssload-movement<?php echo $Rich_Web_Slider;?> 690ms ease <?php Print $str_sum;?>ms infinite alternate;
}
<?php $str_sum=$str_sum+86.25;?>
<?php } ?>
@keyframes cssload-movement<?php echo $Rich_Web_Slider;?>
{
from { transform: scale(1.0) translateY(0px) rotateX(0deg); box-shadow: 0 0 0 rgba(0,0,0,0); }
to
{
transform: scale(1.5) translateY(-24px) rotateX(45deg);
box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?>;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
}
}
@-o-keyframes cssload-movement<?php echo $Rich_Web_Slider;?>
{
from { -o-transform: scale(1.0) translateY(0px) rotateX(0deg); -o-box-shadow: 0 0 0 rgba(0,0,0,0); }
to
{
-o-transform: scale(1.5) translateY(-24px) rotateX(45deg);
-o-box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?>;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
}
}
@-ms-keyframes cssload-movement<?php echo $Rich_Web_Slider;?>
{
from { -ms-transform: scale(1.0) translateY(0px) rotateX(0deg); -ms-box-shadow: 0 0 0 rgba(0,0,0,0); }
to
{
-ms-transform: scale(1.5) translateY(-24px) rotateX(45deg);
-ms-box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?>;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
}
}
@-webkit-keyframes cssload-movement<?php echo $Rich_Web_Slider;?>
{
from { -webkit-transform: scale(1.0) translateY(0px) rotateX(0deg); -webkit-box-shadow: 0 0 0 rgba(0,0,0,0); }
to
{
-webkit-transform: scale(1.5) translateY(-24px) rotateX(45deg);
-webkit-box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?>;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
}
}
@-moz-keyframes cssload-movement<?php echo $Rich_Web_Slider;?>
{
from { -moz-transform: scale(1.0) translateY(0px) rotateX(0deg); -moz-box-shadow: 0 0 0 rgba(0,0,0,0); }
to
{
-moz-transform: scale(1.5) translateY(-24px) rotateX(45deg);
-moz-box-shadow: 0 24px 39px <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?>;
background: <?php echo $Rich_Web_Slider_Effect_Loader[0]->Rich_Web_NSL_LT_T3_BgC;?> !important;
}
}

<?php } else { ?>
.center_content<?php echo $Rich_Web_Slider;?>
{
position:relative;
overflow:visible;
top:50%;
transform:translateY(-50%);
-webkit-transform:translateY(-50%);
-ms-transform:translateY(-50%);
-moz-transform:translateY(-50%);
-o-transform:translateY(-50%);
}
#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider;?>
{
margin:20px auto !important;
background-color:transparent !important;
z-index:999;
width:500px;
height:350px;
max-width:100% !important;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> { width: 30px !important; height: 30px !important; }
.cssload-thecube<?php echo $Rich_Web_Slider;?>
{
width: 50px;
height: 50px;
margin: 20px auto;
position: relative;
transform: rotateZ(45deg);
-o-transform: rotateZ(45deg);
-ms-transform: rotateZ(45deg);
-webkit-transform: rotateZ(45deg);
-moz-transform: rotateZ(45deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube
{
position: relative;
transform: rotateZ(45deg);
-o-transform: rotateZ(45deg);
-ms-transform: rotateZ(45deg);
-webkit-transform: rotateZ(45deg);
-moz-transform: rotateZ(45deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube
{
float: left;
width: 50%;
height: 50%;
position: relative;
transform: scale(1.1);
-o-transform: scale(1.1);
-ms-transform: scale(1.1);
-webkit-transform: scale(1.1);
-moz-transform: scale(1.1);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-cube:before
{
content: "";
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBS;?>;
animation: cssload-fold-thecube 2.76s infinite linear both;
-o-animation: cssload-fold-thecube 2.76s infinite linear both;
-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
transform-origin: 100% 100%;
-o-transform-origin: 100% 100%;
-ms-transform-origin: 100% 100%;
-webkit-transform-origin: 100% 100%;
-moz-transform-origin: 100% 100%;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c2
{
transform: scale(1.1) rotateZ(90deg);
-o-transform: scale(1.1) rotateZ(90deg);
-ms-transform: scale(1.1) rotateZ(90deg);
-webkit-transform: scale(1.1) rotateZ(90deg);
-moz-transform: scale(1.1) rotateZ(90deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c3
{
transform: scale(1.1) rotateZ(180deg);
-o-transform: scale(1.1) rotateZ(180deg);
-ms-transform: scale(1.1) rotateZ(180deg);
-webkit-transform: scale(1.1) rotateZ(180deg);
-moz-transform: scale(1.1) rotateZ(180deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c4
{
transform: scale(1.1) rotateZ(270deg);
-o-transform: scale(1.1) rotateZ(270deg);
-ms-transform: scale(1.1) rotateZ(270deg);
-webkit-transform: scale(1.1) rotateZ(270deg);
-moz-transform: scale(1.1) rotateZ(270deg);
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c2:before
{
animation-delay: 0.35s;
-o-animation-delay: 0.35s;
-ms-animation-delay: 0.35s;
-webkit-animation-delay: 0.35s;
-moz-animation-delay: 0.35s;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c3:before
{
animation-delay: 0.69s;
-o-animation-delay: 0.69s;
-ms-animation-delay: 0.69s;
-webkit-animation-delay: 0.69s;
-moz-animation-delay: 0.69s;
}
.cssload-thecube<?php echo $Rich_Web_Slider;?> .cssload-c4:before
{
animation-delay: 1.04s;
-o-animation-delay: 1.04s;
-ms-animation-delay: 1.04s;
-webkit-animation-delay: 1.04s;
-moz-animation-delay: 1.04s;
}
@keyframes cssload-fold-thecube
{
0%, 10% { transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-o-keyframes cssload-fold-thecube
{
0%, 10% { -o-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -o-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -o-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-ms-keyframes cssload-fold-thecube
{
0%, 10% { -ms-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -ms-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -ms-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-webkit-keyframes cssload-fold-thecube
{
0%, 10% { -webkit-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -webkit-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -webkit-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}
@-moz-keyframes cssload-fold-thecube
{
0%, 10% { -moz-transform: perspective(136px) rotateX(-180deg); opacity: 0; }
25%, 75% { -moz-transform: perspective(136px) rotateX(0deg); opacity: 1; }
90%, 100% { -moz-transform: perspective(136px) rotateY(180deg); opacity: 0; }
}

<?php } ?>




.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview
img,.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img
{
box-shadow:none !important;
-moz-box-shadow:none !important;
-webkit-box-shadow:none !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?>
{
margin:20px auto !important;
width:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
height:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_H;?>px;
max-width:100% !important;
}
<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='slide out'){ ?>
/* general style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview
{
width: 360px;
height:100% !important;
position: absolute;
top:0;
left:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
z-index:100;
-webkit-transition: all 0.3s ease-out !important;
-moz-transition: all 0.3s ease-out !important;
transition: all 0.3s ease-out !important;
opacity:0;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt
{
position: absolute;
top:0;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?> !important;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px;
height:100% !important;
color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
text-indent:0;
<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
text-transform: uppercase !important;
<?php }else{?>
text-transform: none !important;
<?php }?>
text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
padding: 0px 5px;
font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-o-box-sizing: border-box;
overflow:hidden;
}
/* next button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview {
right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px; left:auto; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt {
left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px; 
overflow:hidden;

}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt {
overflow:hidden;
right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW*2;?>px; }
/* hover style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev:hover .preview { left:0; opacity:1; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next:hover .preview { right:0; opacity:1; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img
{
position: absolute;
left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
top:0;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
height:100% !important;
-webkit-transition: all 0s ease-out !important;
-moz-transition: all 0s ease-out !important;
transition: all 0s ease-out !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img
{
position: absolute;
right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
top:0;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
height:100% !important;
box-shadow:none !important;
-moz-box-shadow:none !important;
-webkit-box-shadow:none !important;
-webkit-transition: all 0s ease-out !important;
-moz-transition: all 0s ease-out !important;
transition: all 0s ease-out !important;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='flip out'){ ?>
/* general style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview
{
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
height:100% !important;
position: absolute;
top:0;
z-index:100;
-webkit-transition: -webkit-transform 0.3s ease-out;
-moz-transition: -moz-transform 0.3s ease-out;
transition: transform 0.3s ease-out;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img
{
position: absolute;
left:0;
top:0;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
height:100% !important;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img
{
position: absolute;
right:0;
top:0;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
height:100% !important;
-webkit-transition: -webkit-transform 300ms ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt { display:none; }
/* prev button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev
{
-webkit-perspective-origin: 100% 50%;
-moz-perspective-origin: 100% 50%;
perspective-origin: 100% 50%;
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview
{
-webkit-transform: rotateY(90deg);
-moz-transform: rotateY(90deg);
transform: rotateY(90deg);
-webkit-transform-origin: 0% 50%;
-moz-transform-origin: 0% 50%;
transform-origin: 0% 50%;
}
/* next button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next
{
-webkit-perspective-origin: 0% 50%;
-moz-perspective-origin: 0% 50%;
perspective-origin: 0% 50%;
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview
{
left:auto;
-webkit-transform: rotateY(-90deg);
-moz-transform: rotateY(-90deg);
transform: rotateY(-90deg);
-webkit-transform-origin: 100% 100%;
-moz-transform-origin: 100% 100%;
transform-origin: 100% 100%;
}
/* hover style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview
{
opacity:1;
-webkit-transform: rotateY(0deg);
-moz-transform: rotateY(0deg);
transform: rotateY(0deg);
}
/* different hover style for flexslider nav */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a
{
-webkit-transition: none !important;
-moz-transition: none !important;
transition: none !important;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='double flip out'){ ?>
/* general style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview
{
width: 270px;
height:100% !important;
position: absolute;
top:0;
z-index:100;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
-webkit-backface-visibility: hidden !important;
-moz-backface-visibility: hidden !important;
backface-visibility: hidden;
-webkit-perspective-origin: 100% 50%;
-moz-perspective-origin: 100% 50%;
perspective-origin: 100% 50%;
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview img { position: absolute; top:0; height: 100%;
z-index:10; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt
{
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?>;
height:100% !important;
color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
text-indent:0;
<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
text-transform: uppercase !important;
<?php }else{?>
text-transform: none !important;
<?php }?>
text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
padding: 0px 5px;
font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
position: absolute;
top:0;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-o-box-sizing: border-box;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
-webkit-backface-visibility: hidden;
-moz-backface-visibility: hidden;
backface-visibility: hidden;
z-index:5;
overflow:hidden;

}
/* previous button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev
{
-webkit-perspective-origin: 100% 50%;
-moz-perspective-origin: 100% 50%;
perspective-origin: 100% 50%;
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview,
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt
{
-webkit-transform: rotateY(90deg);
-moz-transform: rotateY(90deg);
transform: rotateY(90deg);
-webkit-transform-origin: 0% 50%;
-moz-transform-origin: 0% 50%;
transform-origin: 0% 50%;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
overflow:hidden;

}
/* next button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next
{
-webkit-perspective-origin: 0% 50%;
-moz-perspective-origin: 0% 50%;
perspective-origin: 0% 50%;
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview,
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt
{
left:auto;
-webkit-transform: rotateY(-90deg);
-moz-transform: rotateY(-90deg);
transform: rotateY(-90deg);
-webkit-transform-origin: 100% 50%;
-moz-transform-origin: 100% 50%;
transform-origin: 100% 50%;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
overflow:hidden;

}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img
{
left: 0;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img
{
position: absolute;
right:0;
top:0;
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
-webkit-transition: -webkit-transform 0.3s ease-out !important;
-moz-transition: -moz-transform 0.3s ease-out !important;
transition: transform 0.3s ease-out !important;
}
/* hover style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview,
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview .alt
{
opacity:1;
-webkit-transform: rotateY(0deg);
-moz-transform: rotateY(0deg);
transform: rotateY(0deg);
overflow:hidden;

}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview .alt
{
-webkit-transition-delay: 0.3s !important;
-moz-transition-delay: 0.3s !important;
transition-delay: 0.3s !important;
overflow:hidden;

}
/* different hover style for flexslider nav */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a
{
-webkit-transition: none !important;
-moz-transition: none !important;
transition: none !important;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHEff=='both ways'){ ?>
/* general style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview { height:100% !important; position: absolute;
top:0; z-index:90; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview img
{
position: absolute;
top:0px;
height: 100%;
-webkit-transition: all 0.3s ease-out !important;
-moz-transition: all 0.3s ease-out !important;
transition: all 0.3s ease-out !important;
opacity:0;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a .preview .alt
{
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TBgC;?>;
height:100% !important;
color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TC;?>;
text-indent:0;
<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_TUp=='true'){ ?>
text-transform: uppercase !important;
<?php }else{?>
text-transform: none !important;
<?php }?>
text-align:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TTA;?>;
padding: 0px 5px;
font-family: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_TFF;?>;
position: absolute;
top:0;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-o-box-sizing: border-box;
-webkit-transition: all 0.3s ease-out !important;
-moz-transition: all 0.3s ease-out !important;
transition: all 0.3s ease-out !important;
opacity:0;
overflow:hidden;

}
/* next button */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview {
left:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px; right:auto; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview {
right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px; left:auto; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview img {
left:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview img {
right:<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next .preview .alt
{
left:auto;
overflow:hidden;

right:-<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBoxW;?>px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev .preview .alt { 
overflow:hidden;
	
	left:auto; }
/* hover style */
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-prev:hover .preview .alt
{
transform:translateX(49.5%);
-moz-transform:translateX(49.5%);
-webkit-transform:translateX(49.5%);
opacity:1;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .flex-next:hover .preview .alt
{
transform:translateX(-100%);
-moz-transform:translateX(-100%);
-webkit-transform:translateX(-100%);
opacity:1;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a:hover .preview img
{
transform:translateY(-100%);
-moz-transform:translateY(-100%);
-webkit-transform:translateY(-100%);
opacity:1;
}
<?php }?>
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav
{
height:0 !important;
top:50% !important;
}

.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav .arrow { height:100%;}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a
{
background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBgC;?> ;
opacity: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArOp/100;?> ;
-webkit-transform:translateY(-50%) !important;
-ms-transform:translateY(-50%) !important;
-moz-transform:translateY(-50%) !important;
-o-transform:translateY(-50%) !important;
transform:translateY(-50%) !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-prev:hover .arrow,
.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-next:hover .arrow
{
background-color: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHBgC;?> !important;
opacity: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHOp/100;?>;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav {
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos;?>: 0%; padding:0px !important; }
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-nav li
{
margin: 0 <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPB;?>px;
margin-top:<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavPos=="top"){echo 14;}else{echo 4;}?>px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a
{
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavW;?>px;
height: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavH;?>px;
-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px;
-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px;
-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px;
border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBR;?>px;
border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBW;?>px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBS;?>
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavBC;?>;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a:hover { background:
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavHC;?>;}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-control-paging li a.flex-active { background:
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_NavCC;?>;}
.flexslider_<?php echo $Rich_Web_Slider;?>
{
width: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_W;?>px;
margin: 0 auto !important;
-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
}
.flexslider_<?php echo $Rich_Web_Slider;?>
{
position: relative;
z-index: 0;
overflow: unset;
}
<?php if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 1') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 0 10px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 10px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 10px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 2') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
z-index: -1;
position: absolute;
content: "";
bottom: 15px;
left: 10px;
width: 50%;
top: 80%;
max-width:300px;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
transform: rotate(-3deg);
-moz-transform: rotate(-3deg);
-webkit-transform: rotate(-3deg);
}
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
transform: rotate(3deg);
-moz-transform: rotate(3deg);
-webkit-transform: rotate(3deg);
right: 10px;
left: auto;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 3') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>:before
{
z-index: -1;
position: absolute;
content: "";
bottom: 15px;
left: 10px;
width: 50%;
top: 80%;
max-width:300px;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
transform: rotate(-3deg);
-moz-transform: rotate(-3deg);
-webkit-transform: rotate(-3deg);
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 4') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
z-index: -1;
position: absolute;
content: "";
bottom: 15px;
right: 10px;
left: auto;
width: 50%;
top: 80%;
max-width:300px;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 15px 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
transform: rotate(3deg);
-moz-transform: rotate(3deg);
-webkit-transform: rotate(3deg);
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 5') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
z-index: -1;
position: absolute;
content: "";
bottom: 25px;
left: 10px;
width: 50%;
top: 80%;
max-width:300px;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
box-shadow: 0 35px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 35px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 35px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
transform: rotate(-8deg);
-moz-transform: rotate(-8deg);
-webkit-transform: rotate(-8deg);
}
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
transform: rotate(8deg);
-moz-transform: rotate(8deg);
-webkit-transform: rotate(8deg);
right: 10px;
left: auto;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 6') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
position:relative;
box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-webkit-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-moz-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
content:"";
position:absolute;
z-index:-1;
box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
top:50%;
bottom:0;
left:10px;
right:10px;
border-radius:100px / 10px;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 7') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
position:relative;
box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-webkit-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-moz-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
content:"";
position:absolute;
z-index:-1;
box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
top:0;
bottom:0;
left:10px;
right:10px;
border-radius:100px / 10px;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
right:10px;
left:auto;
transform:skew(8deg) rotate(3deg);
-moz-transform:skew(8deg) rotate(3deg);
-webkit-transform:skew(8deg) rotate(3deg);
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 8') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
position:relative;
box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-webkit-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
-moz-box-shadow:0 1px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>, 0 0 40px
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?> inset;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
content:"";
position:absolute;
z-index:-1;
box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow:0 0 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
top:10px;
bottom:10px;
left:0;
right:0;
border-radius:100px / 10px;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
right:10px;
left:auto;
transform:skew(8deg) rotate(3deg);
-moz-transform:skew(8deg) rotate(3deg);
-webkit-transform:skew(8deg) rotate(3deg);
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 9') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>:before, .flexslider_<?php echo $Rich_Web_Slider;?>:after
{
position:absolute;
content:"";
box-shadow:0 10px 25px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow:0 10px 25px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow:0 10px 25px 20px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
top:40px;left:20px;bottom:50px;
width:15%;
z-index:-1;
-webkit-transform: rotate(-5deg);
-moz-transform: rotate(-5deg);
transform: rotate(-5deg);
}
.flexslider_<?php echo $Rich_Web_Slider;?>:after
{
-webkit-transform: rotate(5deg);
-moz-transform: rotate(5deg);
transform: rotate(5deg);
right: 20px;left: auto;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 10') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 0 0 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 0 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 0 10px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 11') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 4px -4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 4px -4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 4px -4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 12') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 5px 5px 3px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 5px 5px 3px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 5px 5px 3px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 13') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 2px 2px white, 4px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 2px 2px white, 4px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 2px 2px white, 4px 4px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 14') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 8px 8px 18px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 8px 8px 18px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 8px 8px 18px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 15') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 0 8px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 8px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 8px 6px -6px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else if($Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxS == 'Type 16') { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: 0 0 18px 7px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-moz-box-shadow: 0 0 18px 7px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
-webkit-box-shadow: 0 0 18px 7px <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_BoxSC;?>;
}
<?php } else { ?>
.flexslider_<?php echo $Rich_Web_Slider;?>
{
box-shadow: none !important;
-moz-box-shadow: none !important;
-webkit-box-shadow: none !important;
}
<?php }?>
.flexslider_<?php echo $Rich_Web_Slider;?> .slides, .flexslider_<?php echo $Rich_Web_Slider;?> .slides li img,
.flexslider_<?php echo $Rich_Web_Slider;?> .slides li, .flexslider_<?php echo $Rich_Web_Slider;?> .slides
{
position:relative !important;
width:100% !important;
height:100% !important;
padding:0px !important;
margin-left:0px !important;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .slides li img
{
-webkit-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px solid
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
-moz-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px solid
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
-o-border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px solid
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
border: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBW;?>px solid
<?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBC;?>;
-webkit-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
-moz-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
-o-border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
border-radius: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_IBR;?>px;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a.flex-next .arrow
{
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBgC;?> url("<?php echo plugin_dir_url( __DIR__ ).'Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png'?>") no-repeat center center;
background-size:70% 70%;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-next:hover .arrow
{
right:0;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHBgC;?> url("<?php echo plugin_dir_url( __DIR__ ).'Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png'?>") no-repeat center center;
background-size:70% 70%;
}
.flexslider_<?php echo $Rich_Web_Slider;?> .flex-direction-nav a.flex-prev .arrow
{
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArBgC;?> url("<?php echo plugin_dir_url( __DIR__ ).'Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png'?>") no-repeat center center;
background-size:70% 70%;
}
.flexslider_<?php echo $Rich_Web_Slider;?>:hover .flex-prev:hover .arrow
{
right:0;
background: <?php echo $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArHBgC;?> url("<?php echo plugin_dir_url( __DIR__ ).'Images/icon-'. $Rich_Web_Slider_Effect[0]->rich_web_Sl1_ArType .'.png'?>") no-repeat center center;
background-size:70% 70%;
}



.rw_nav_video<?php echo $Rich_Web_Slider;?>,.rw_nav_video{
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
z-index:9;
display:none !important;
}

.rw_nav_video<?php echo $Rich_Web_Slider;?>_anim,.rw_nav_video_anim{
display:block !important;
}

.pointer{
cursor:pointer !important;
}

.flex-active-slide i.plIc{
position:absolute;
font-size:20px;
padding:10px 25px;
background-color: red;
border-radius: 8px;
color:#ffffff;
top:50%;
left:50%;
-webkit-transform:translateY(-50%) translateX(-50%);
-ms-transform:translateY(-50%) translateX(-50%);
-moz-transform:translateY(-50%) translateX(-50%);
-o-transform:translateY(-50%) translateX(-50%);
transform:translateY(-50%) translateX(-50%);
}

.delIc<?php echo $Rich_Web_Slider;?>{
position:absolute;
cursor: pointer;
font-size:20px;
color:#ffffff;
top:5px;
right:8px;
text-shadow:0px 0px 30px #000000;
display:none;
z-index: 99;
}

</style>