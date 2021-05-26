<script>
jQuery(document).ready(function() {
    function resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>() {
        var yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
            '.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
        var yith_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
            '.yith_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
        if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() <=
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) {
            jQuery(
                    '.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?>,.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .css('width', jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .width());
            jQuery(
                    '.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .css('height', Math.floor(jQuery(
                        '.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() *
                    yith_<?php echo $Rich_Web_Slider_Manager[0]->id;?> /
                    yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>));
            // jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("width","3000px")
            jQuery(
                    '.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .removeClass('your-item-pic-anim_<?php echo $Rich_Web_Slider_Manager[0]->id;?>');
        } else if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() >
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) {
            jQuery(
                    '.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?>,.your-item_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .css('width', yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);
            jQuery(
                    '.rw_cont_img_hov_div<?php echo $Rich_Web_Slider_Manager[0]->id;?>,.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .css('height', yith_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);
            jQuery('.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').addClass(
                'your-item-pic-anim_<?php echo $Rich_Web_Slider_Manager[0]->id;?>');
        }
        if (parseInt(jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width()) >=
            parseInt(jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").width())) {
            jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('width', jQuery(
                ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").width());
            jQuery(".Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").css('display',
                'none');
        } else {
            jQuery('.your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('width', "100%");
            jQuery(".Rich_Web_PSlider_SC_Arr_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").css('display',
                'block');
        }
        jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('width',
            Math.floor(600 * jQuery(window).width() / 1000) + 'px');
        jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height',
            Math.floor(400 * jQuery(window).width() / 1000) + 'px');
    }
    var array_carousel<?php echo $Rich_Web_Slider;?> = [];
    jQuery(".your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").each(function() {
        if (jQuery(this).attr("src") != "") {
            array_carousel<?php echo $Rich_Web_Slider;?>.push(jQuery(this).attr("src"));
        }
    })
    var y_carousel<?php echo $Rich_Web_Slider;?> = 0;
    var yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = 0;
    var rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id;?> = 0;
    var ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?> = 0;
    var width<?php echo $Rich_Web_Slider_Manager[0]->id;?> = 0;

    function best<?php echo $Rich_Web_Slider;?>() {
        if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() <= parseInt(
                jQuery('.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val())) {
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
                ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").parent().width());
        } else if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() > parseInt(
                jQuery('.yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val())) {
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
                ".yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").val());
        }
        rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
            ".rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id;?>").val());
        if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() <=
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) {
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("max-width",
                rw_sl_imgs_count<?php echo $Rich_Web_Slider_Manager[0]->id;?> *
                yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>);
            ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
                ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("max-width"));
        } else if (jQuery('.responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() >
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) {
            ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
                ".ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>").val());
        }
        width<?php echo $Rich_Web_Slider_Manager[0]->id;?> = parseInt(jQuery(
            ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").width());
    }
    var next<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "";
    var prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "";

    function nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>() {
        if ((jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left +
                ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) - (jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left +
                width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) <
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> && (jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left +
                ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) - (jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left +
                width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) > 0) {
            next<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "trueFalse";
        } else if ((jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left +
                ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) - (jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left +
                width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) < 0) {
            next<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "false";
        } else {

            next<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "trueFalse";
        }
        if (jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left - jQuery(
                ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left == 0) {
            prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "true";
        } else if (jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left -
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left < 0 &&
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left - jQuery(
                ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left > -
            yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?>) {
            prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "false";
        } else {
            prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> = "trueFalse";
        }
    }

    function next_anim() {
        if (next<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "true") {
            console.log(next<?php echo $Rich_Web_Slider_Manager[0]->id;?>)
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", "-=" + ((
                jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul")
                .offset().left + ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?>) - (jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset()
                .left + width<?php echo $Rich_Web_Slider_Manager[0]->id;?>)) + "");
            next<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "false"

        } else if (next<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "false") {
            console.log(next<?php echo $Rich_Web_Slider_Manager[0]->id;?>)
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", "0px");


        }
        if (next<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "trueFalse") {
            console.log(next<?php echo $Rich_Web_Slider_Manager[0]->id;?>)
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", "-=" +
                yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> + "");
        }
    }

    function prev_anim() {
        if (prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "true") {
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").offset().left -
                ul_width<?php echo $Rich_Web_Slider_Manager[0]->id;?> +
                width<?php echo $Rich_Web_Slider_Manager[0]->id;?> - jQuery(
                    ".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").offset().left);
        } else if (prev<?php echo $Rich_Web_Slider_Manager[0]->id;?> == "false") {
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", "0");
        } else {
            jQuery(".responsiveSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> ul").css("left", "+=" +
                yitw_<?php echo $Rich_Web_Slider_Manager[0]->id;?> + "");
        }
    }
    for (i = 0; i < array_carousel<?php echo $Rich_Web_Slider;?>.length; i++) {
        jQuery("<img class='your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>' />").attr('src',
            array_carousel<?php echo $Rich_Web_Slider;?>[i]).on("load", function() {
            y_carousel<?php echo $Rich_Web_Slider;?>++;
            if (y_carousel<?php echo $Rich_Web_Slider;?> == array_carousel<?php echo $Rich_Web_Slider;?>
                .length) {
                setTimeout(function() {
                    resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
                }, 100);
                jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>")
                    .remove();
                jQuery(".your-slider-wrap<?php echo $Rich_Web_Slider_Manager[0]->id;?>").fadeIn(1000);
                best<?php echo $Rich_Web_Slider;?>();
            }
        })
    }
    jQuery(".slider-arrow_right_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").click(function() {
        nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
        next_anim();
    })
    jQuery(".slider-arrow_left_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").click(function() {
        nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
        prev_anim();
    })
    document.onkeydown = checkKey;

    function checkKey(e) {

        e = e || window.event;

        if (e.keyCode == '37') {
            nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
            prev_anim();
        } else if (e.keyCode == '39') {
            nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
            next_anim();
        }

    }

    var allImgs<?php echo $Rich_Web_Slider_Manager[0]->id;?> = document.querySelectorAll(
        '.your-item-pic_<?php echo $Rich_Web_Slider_Manager[0]->id;?>');

    for (var i = 0; i < allImgs<?php echo $Rich_Web_Slider_Manager[0]->id;?>.length; i++) {
        allImgs<?php echo $Rich_Web_Slider_Manager[0]->id;?>[i].addEventListener('touchstart', handleTouchStart,
            false);
        allImgs<?php echo $Rich_Web_Slider_Manager[0]->id;?>[i].addEventListener('touchmove', handleTouchMove,
            false);
    }



    var xDown = null;
    var yDown = null;



    function handleTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    };



    function handleTouchMove(evt) {
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            /*most significant*/
            if (xDiff > 0) {
                nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
                prev_anim();
            } else {
                nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
                next_anim();
            }
        } else {
            if (yDiff > 0) {
                /* up swipe */
            } else {
                /* down swipe */
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    };



    jQuery(window).resize(function() {
        resp<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
        best<?php echo $Rich_Web_Slider;?>();
        nextPrev<?php echo $Rich_Web_Slider_Manager[0]->id;?>();
    })
})
</script>
<script type="text/javascript">
function createPopup() {
    var overlay = document.createElement("div");
    overlay.setAttribute("onclick",
        "Rich_Web_PSlider_SC_Close_Popup<?php echo $Rich_Web_Slider_Manager[0]->id;?>(<?php echo $Rich_Web_Slider_Manager[0]->id;?>)"
        );
    overlay.setAttribute("class", "Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    document.body.appendChild(overlay);
    var popupContent = document.createElement("div");
    popupContent.setAttribute("class", "Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    document.body.appendChild(popupContent);
    var popupContentImg = document.createElement("img");
    popupContentImg.setAttribute("src", "");
    popupContentImg.setAttribute("class",
        "Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    popupContent.appendChild(popupContentImg);
    var popupContentVideo = document.createElement("iframe");
    popupContentVideo.setAttribute("src", "");
    popupContentVideo.setAttribute("webkitAllowFullScreen", "webkitAllowFullScreen");
    popupContentVideo.setAttribute("mozallowfullscreen", "mozallowfullscreen");
    popupContentVideo.setAttribute("allowFullScreen", "allowFullScreen");
    popupContentVideo.setAttribute("class",
        "Rich_Web_PSlider_SC_Popup_Video_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    popupContent.appendChild(popupContentVideo);
    var popupContentIcon = document.createElement("i");
    popupContentIcon.setAttribute("onclick",
        "Rich_Web_PSlider_SC_Close_Popup<?php echo $Rich_Web_Slider_Manager[0]->id;?>(<?php echo $Rich_Web_Slider_Manager[0]->id;?>)"
        );
    popupContentIcon.setAttribute("class",
        "Rich_Web_PSlider_SC_PCI_<?php echo $Rich_Web_Slider_Manager[0]->id;?> rich_web rich_web-<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_SC_PCI_Type;?>"
        );
    popupContent.appendChild(popupContentIcon);
}

createPopup();



function Rich_Web_PSlider_SC_Open_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>(PSlider_Src, PSlider_vSrc) {
    jQuery('.Rich_Web_PSlider_SC_Popup_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').animate({
        'width': '100%'
    }, 500);
    jQuery('.Rich_Web_PSlider_SC_Popup_Photo_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').attr('src', PSlider_Src);
    jQuery('.Rich_Web_PSlider_SC_Popup_Image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css({
        'transform': 'translateX(0px)',
        '-ms-transform': 'translateX(0px)',
        '-o-transform': 'translateX(0px)',
        '-moz-transform': 'translateX(0px)',
        '-webkit-transform': 'translateX(0px)'
    });
    setTimeout(function() {
        if (PSlider_vSrc != '') {
            jQuery('.Rich_Web_PSlider_SC_Popup_Video_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css(
                'display', 'block');
            jQuery('.Rich_Web_PSlider_SC_Popup_Video_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').attr('src',
                PSlider_vSrc + '?rel=0&amp;autoplay=1');
        }
    }, 100)
}

function Rich_Web_PSlider_SC_Close_Popup<?php echo $Rich_Web_Slider_Manager[0]->id;?>(a) {
    jQuery('.Rich_Web_PSlider_SC_Popup_Image_' + a + '').css({
        'transform': 'translateX(5200px)',
        '-ms-transform': 'translateX(5200px)',
        '-o-transform': 'translateX(5200px)',
        '-moz-transform': 'translateX(5200px)',
        '-webkit-transform': 'translateX(5200px)'
    });
    jQuery('.Rich_Web_PSlider_SC_Popup_Video_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('display', 'none');
    jQuery('.Rich_Web_PSlider_SC_Popup_Video_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').attr('src', '');
    setTimeout(function() {
        jQuery('.Rich_Web_PSlider_SC_Popup_Photo_' + a + '').attr('src', '');
        jQuery('.Rich_Web_PSlider_SC_Popup_' + a + '').animate({
            'width': '0'
        }, 500);
    }, 200)
}
</script>