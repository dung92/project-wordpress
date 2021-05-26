<script>
jQuery(document).ready(function() {
    var Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    var Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    var Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    var Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    var Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    var array_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = [];
    jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').each(function() {
            if (jQuery(this).attr("src") != "") {
                array_<?php echo $Rich_Web_Slider_Manager[0]->id;?>.push(jQuery(this));
            }
        });
    jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('width', Math.floor(Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width() / 1000));
    jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery('#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width() / 1000));

    function resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>() {
        // jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('width',Math.floor(Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width()/1000));
        // jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height',Math.floor(Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?>*jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width()/1000));

        jQuery('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('max-height',
            Rich_Web_AccordSl_Height_<?php echo $Rich_Web_Slider_Manager[0]->id;?> /
            Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * document.querySelector(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').clientWidth);
        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('width', Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * document
                .querySelector('.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').clientWidth /
                Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);

        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('left', ((Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?> -
                    Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) / (
                    array_<?php echo $Rich_Web_Slider_Manager[0]->id;?>.length - 1)) * document.querySelector(
                    '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').clientWidth /
                Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);
        console.log(jQuery(
            '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figure_<?php echo $Rich_Web_Slider_Manager[0]->id;?>'
            ).css('left'))
        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .input_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('width', ((Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?> -
                    Rich_Web_AccordSl_ImgW_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) / (
                    array_<?php echo $Rich_Web_Slider_Manager[0]->id;?>.length - 1)) * document.querySelector(
                    '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').clientWidth /
                Rich_Web_AccordSl_Width_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);
        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('font-size', Math.floor(
                Rich_Web_AccordSl_TitleFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                    '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width() / 1000));
        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('line-height', '1.5');
        jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .figcaption_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .span_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .css('padding', '0px 7px');
        jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('font-size', Math.floor(
            Rich_Web_AccordSl_LinkFS_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.ia-container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').parent().width() / 1000));
        jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('line-height', '2');
        jQuery('.Tot_Accord_Link_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('padding', '0px 7px');
    }
    var array_accordion<?php echo $Rich_Web_Slider;?> = [];
    jQuery(".img_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").each(function() {
        if (jQuery(this).attr("src") != "") {
            array_accordion<?php echo $Rich_Web_Slider;?>.push(jQuery(this).attr("src"));
        }
    })
    var y_accordion<?php echo $Rich_Web_Slider;?> = 0;
    for (i = 0; i < array_accordion<?php echo $Rich_Web_Slider;?>.length; i++) {
        jQuery("<img class='img_<?php echo $Rich_Web_Slider_Manager[0]->id;?>' />").attr('src',
            array_accordion<?php echo $Rich_Web_Slider;?>[i]).on("load", function() {
            y_accordion<?php echo $Rich_Web_Slider;?>++;
            if (y_accordion<?php echo $Rich_Web_Slider;?> ==
                array_accordion<?php echo $Rich_Web_Slider;?>.length) {
                jQuery("#rw_acc_main<?php echo $Rich_Web_Slider_Manager[0]->id;?>").fadeIn(1000);
                jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>")
                    .remove();
                resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
            }
        })
    }
    jQuery(window).resize(function() {
        // setTimeout(function(){
        resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
        // },2000)	 
    })
})
</script>
<script type="text/javascript">
var iconsBg = document.querySelectorAll(".icBg");
var icons = document.querySelectorAll(".rw_video_acc");
var videos = document.querySelectorAll(".rw_acc_video<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
var delIcons = document.querySelectorAll(".rw_icc_delIc");
var inputs = document.querySelectorAll(".input_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");

function playVideo(arr) {
    for (var i = 0; i < arr.length; i++) {
        arr[i].onclick = function() {
            var vURL = event.target.dataset.video;
            console.log(event.target.parentElement)
            var el = event.target.parentElement.nextElementSibling;
            var delIc = el.nextElementSibling;
            el.setAttribute("src", vURL + "?rel=0&amp;autoplay=1");
            el.style.display = "block";
            setTimeout(function() {
                delIc.style.display = "block";
            }, 1000)
        }
    }
}

playVideo(iconsBg);
playVideo(icons);

function delVideo() {
    for (var i = 0; i < videos.length; i++) {
        videos[i].style.display = "none";
        videos[i].setAttribute("src", "");
        delIcons[i].style.display = "none";
    }
}

for (var i = 0; i < delIcons.length; i++) {
    delIcons[i].onclick = function() {
        delVideo();
    }
}

for (var i = 0; i < inputs.length; i++) {
    inputs[i].onclick = function() {
        delVideo();
    }
}
</script>