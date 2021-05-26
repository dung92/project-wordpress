<script type="text/javascript">
jQuery(document).ready(function() {
    var array_dynamic<?php echo $Rich_Web_Slider;?> = [];
    jQuery(".rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id;?>").each(function() {
        if (jQuery(this).attr("rel") != "") {
            array_dynamic<?php echo $Rich_Web_Slider;?>.push(jQuery(this).attr("rel"));
        }
    })
    var y_dynamic<?php echo $Rich_Web_Slider;?> = 0;
    for (i = 0; i < array_dynamic<?php echo $Rich_Web_Slider;?>.length; i++) {
        jQuery("<img class='rw_img_dynamic<?php echo $Rich_Web_Slider_Manager[0]->id;?>' />").attr('src',
            array_dynamic<?php echo $Rich_Web_Slider;?>[i]).on("load", function() {
            y_dynamic<?php echo $Rich_Web_Slider;?>++;
            if (y_dynamic<?php echo $Rich_Web_Slider;?> == array_dynamic<?php echo $Rich_Web_Slider;?>
                .length) {
                jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").fadeIn(1000);
                jQuery("#RW_Load_Content_Navigation<?php echo $Rich_Web_Slider_Manager[0]->id;?>")
                    .remove();
            }
        })
    }
})
</script>
<script type="text/javascript">
var y = true;
jQuery(".rw_vd_popup").on("click", function() {
    y = false;
    console.log(y);
});


(function() {

    var pluginName = "rSlider",
        defaults = {
            currentSlide: 0,
            defaultSlide: 0,
            delay: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_PT*1000;?>,
            height: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_H;?>,
            width: undefined,
            minHeight: 150,
            automatic: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_AP;?>,
            dirButtons: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_Show;?>,
            dirButtonNext: "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_RT;?>",
            dirButtonPrev: "<?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Arr_LT;?>",
            transitions: <?php echo $Rich_Web_Slider_Effect[0]->Rich_Web_Sl_DS_Tr;?>
        };
    var Plugin = function(context, options) {
        this.$context = jQuery(context);
        this.$view = this.$context.find(".rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.$slides = this.$view.find(".rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.$images = this.$slides.find(".rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.$container = this.$slides.find(
        ".rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.$dotsControls = this.$context.find(
            ".rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.$arrowControls = this.$context.find(
            ".rSlider--arrow-controls_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        this.slidesLen = this.$slides.length;
        this.settings = jQuery.extend(defaults, options);
        this.w = this.settings.width || this.$context.width();
        this.h = this.settings.height || this.$context.height();
        this.delayTimer = undefined;
        this.resizeTimer = undefined;
        this.init();
    };
    var pluginProto = {
        init: function() {
            var self = this;
            if (self.settings.currentSlide !== self.settings.defaultSlide)
                self.setSlide(self.settings.defaultSlide)
            self.events();
            self.setStyle();
            self.startAutomaticMovement();
            self.setDotsControls();
            self.setArrowControls();
            self.activateButton(self.settings.currentSlide);
            self.fixSlideHeight();
            self.moveSlide();
            self.setAnimations();
        },
        calculateMargin: function() {
            var self = this,
                margin = -self.settings.currentSlide * self.w;
            return margin;
        },
        startAutomaticMovement: function() {
            if (!y) {
                return;
            }
            var self = this,
                moving = function() {
                    self.goToSlide(self.nextSlide());
                    self.activateButton();
                    self.moveSlide();
                };
            if (self.settings.automatic) {
                clearInterval(self.delayTimer);
                self.delayTimer = setInterval(moving, self.settings.delay)
            }
        },
        stopAutomaticMovement: function() {
            y = true;
            var self = this;
            clearInterval(self.delayTimer);
        },
        setStyle: function() {
            var self = this;
            self.setMetrics();
            self.setBackgroundImages();
        },
        setBackgroundImages: function() {
            var self = this,
                $imgs = self.$images.find("img"),
                assignAttribute = function() {
                    var $img = jQuery(this),
                        $parent = $img.parent(),
                        attr = $img.attr("src");
                    $parent.css({
                        "background": "url('" + attr + "')"
                    });
                }
            jQuery.each($imgs, assignAttribute);
            $imgs.remove();
        },
        setDotsControls: function() {
            var self = this,
                buttons = "",
                i = 0;
            jQuery.each(self.$images, function() {
                buttons += "<button data-slide-index='" + i + "'></button>";
                i++;
            });
            self.$dotsControls.append(buttons);
        },
        setArrowControls: function() {
            var self = this,
                buttons = "";
            if (!self.settings.dirButtons) return;
            buttons += "<span><button data-dir='prev'>" + self.settings.dirButtonPrev + "</button></span>";
            buttons += "<span><button data-dir='next'>" + self.settings.dirButtonNext + "</button></span>";
            self.$arrowControls.append(buttons);
        },
        setMetrics: function() {
            var self = this;
            self.$slides.width(self.w);
            if (self.settings.height && self.settings.width) {
                self.$view.height(self.h);
                self.$context.width(self.w);
            }
        },
        nextSlide: function() {
            var self = this,
                index;
            index = self.settings.currentSlide + 1;
            if (self.settings.currentSlide === self.slidesLen - 1) index = 0;
            return index;
        },
        prevSlide: function() {
            var self = this,
                index = self.settings.currentSlide - 1;
            if (self.settings.currentSlide === 0) index = self.slidesLen - 1;
            return index;
        },
        setSlide: function(index) {
            var self = this;
            self.settings.currentSlide = index;
            return index;
        },
        moveSlide: function() {
            var self = this;
            self.$view.css({
                "margin-left": self.calculateMargin()
            })
        },
        goToSlide: function(slideIndex) {
            var self = this,
                index = slideIndex;
            // next or prev
            switch (index) {
                case "next":
                    index = self.nextSlide();
                    break;
                case "prev":
                    index = self.prevSlide();
                    break;
            };
            self.setSlide(index);
            self.fixSlideHeight();
            return self.settings.currentSlide;
        },
        activateButton: function(index) {
            var self = this,
                buttons = self.$dotsControls.children("button"),
                index = index || self.settings.currentSlide;
            buttons.removeClass('active');
            buttons.eq(index).addClass('active');
        },
        resizeImages: function(containerWidth) {
            var self = this;
            self.w = containerWidth;
            self.moveSlide();
            self.$slides.width(containerWidth);
        },
        userEvents: {
            handleDotsControls: function($btn) {
                var self = this,
                    dir = $btn.data("slide-index");
                self.goToSlide(dir);
                self.startAutomaticMovement();
                self.activateButton();
                self.moveSlide();
                return self.settings.currentSlide;
            },
            handleArrowControls: function($btn) {
                var self = this,
                    dir = $btn.data("dir");
                self.goToSlide(dir);
                self.startAutomaticMovement();
                self.activateButton();
                self.moveSlide();
                return self.settings.currentSlide;
            },
            resizeWindow: function() {
                var self = this,
                    w = self.$context.innerWidth();
                self.resizeImages(w);
                self.fixSlideHeight();
                self.removeAnimations();
            }
        },
        fixSlideHeight: function() {
            var self = this,
                numSlide = self.settings.currentSlide,
                $slide = self.$slides.eq(numSlide),
                $image = $slide.find(".rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>"),
                h = self.settings.height,
                minH = self.settings.minHeight;
            if (h < minH) h = minH;
            if (h > self.$context.outerHeight()) h = h;
            self.$slides.height(h);
            $slide.height(h);
            return h;
        },
        removeAnimations: function() {
            var self = this,
                className = "css-transitions";
            self.$context.removeClass(className);
            clearTimeout(self.resizeTimer);
            self.resizeTimer = setTimeout(self.setAnimations.bind(self), 500);
        },
        setAnimations: function() {
            var self = this,
                className = "css-transitions";
            if (!self.settings.transitions) return;
            self.$context.addClass(className);
        },
        events: function() {
            var self = this;
            self.$dotsControls.on("click", "button", function() {
                var $btn = jQuery(this);
                self.userEvents.handleDotsControls.call(self, $btn);
            });
            self.$arrowControls.on("click", "span", function() {
                var $btn = jQuery(this).children("button");
                self.userEvents.handleArrowControls.call(self, $btn);
            });
            jQuery(window).on("load resize", self.userEvents.resizeWindow.bind(self));

            self.$context.on("mouseover", self.stopAutomaticMovement.bind(self));

            self.$context.on("mouseleave", self.startAutomaticMovement.bind(self));



            // jQuery(".dnSlDelIcon<?php echo $Rich_Web_Slider_Manager[0]->id;?>").on("click",self.startAutomaticMovement.bind(self));
        }
    };
    jQuery.extend(Plugin.prototype, pluginProto);
    jQuery.fn[pluginName] = function(options) {
        return jQuery.each(jQuery(this), function() {
            return new Plugin(this, options);
        });
    };
    jQuery(".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>").rSlider();
}());
jQuery(document).ready(function() {
    var RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> = jQuery(
        '.RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').val();
    jQuery('.rSlider--image_RW').css("width", "0px");

    function resp() {
        jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider--bg-color_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider--image_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider--view_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)))
        jQuery('.rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('height', Math.floor(
            RW_DSL_H_<?php echo $Rich_Web_Slider_Manager[0]->id;?> * jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() / (jQuery(
                '.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() + 150)));
        jQuery('.rSlider--dots-controls_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').css('padding', Math
            .floor(20 * jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
            .width() / (jQuery('.rSlider--container_<?php echo $Rich_Web_Slider_Manager[0]->id;?>')
                .width() + 150)) + 'px');
        if (jQuery('.rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?>').width() <= 350) {
            jQuery(
                    ".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id;?> a")
                .css("display", "none");
            jQuery('.rSlider--image_RW').css("width", "100%");
            jQuery('.rSlider--image_RW').css("cursor", "pointer");
        } else {
            jQuery(
                    ".rSlider_<?php echo $Rich_Web_Slider_Manager[0]->id;?> .slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id;?> a")
                .css("display", "inline-block");
            jQuery('.rSlider--image_RW').css("width", "0px");
            jQuery('.rSlider--image_RW').css("cursor", "default");
        }
    }
    jQuery('.rSlider--image_RW').each(function() {
        jQuery(this).click(function() {
            if (jQuery(this).attr('name') != '') {
                if (jQuery(this).attr('alt') == "checked") {
                    window.open(jQuery(this).attr('name'), '_blank');
                } else {
                    window.open(jQuery(this).attr('name'), "_self")
                }
            }
        })
    })
    setTimeout(function() {
        resp();
    }, 100)
    jQuery(window).load(function() {
        resp();
    })
    jQuery(window).resize(function() {
        resp();
    })
})
</script>
<script type="text/javascript">
var Rich_Web_Sl_DS_DFS<?php echo $Rich_Web_Slider_Manager[0]->id;?> = document.querySelector(
    ".Rich_Web_Sl_DS_DFS<?php echo $Rich_Web_Slider_Manager[0]->id;?>").getAttribute("value");
console.log(Rich_Web_Sl_DS_DFS<?php echo $Rich_Web_Slider_Manager[0]->id;?>);

jQuery(".slide-styled_<?php echo $Rich_Web_Slider_Manager[0]->id;?> a").click(function() {
    event.stopPropagation();
})

function resp(el) {
    el.style.maxHeight = el.clientWidth * 56.25 / 100 + "px";
    if (parseInt(el.style.maxHeight) > window.innerHeight) {
        el.style.maxHeight = window.innerHeight + "px";
        el.style.maxWidth = window.innerHeight * 16 / 9 + "px";
    } else {
        console.log(el.clientWidth)
        el.style.maxWidth = "100%";
        el.style.maxHeight = window.innerWidth * 56.25 / 100 + "px";
    }
}

function createPopup(vSrc, iSrc) {
    if (Rich_Web_Sl_DS_DFS<?php echo $Rich_Web_Slider_Manager[0]->id;?> != "true") {
        return;
    }
    var overlay = document.createElement("div");
    overlay.setAttribute("class", "dPopupOverlay<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    document.body.appendChild(overlay);
    var content = document.createElement("div");
    content.setAttribute("class", "dPopupOverlayContent<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    overlay.appendChild(content);
    var delIcon = document.createElement("div");
    delIcon.setAttribute("class", "dnSlDelIcon<?php echo $Rich_Web_Slider_Manager[0]->id;?> rich_web rich_web-times");
    overlay.appendChild(delIcon);
    var image = document.createElement("img");
    image.setAttribute("class", "dPopupImg<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
    image.setAttribute("src", iSrc);
    content.appendChild(image);
    resp(content);
    window.onresize = function(event) {
        resp(content);
    };
    if (vSrc != "") {
        var video = document.createElement("iframe");
        video.setAttribute("class", "dPopupVideo<?php echo $Rich_Web_Slider_Manager[0]->id;?>");
        video.setAttribute("src", vSrc);
        video.setAttribute("webkitAllowFullScreen", "webkitAllowFullScreen");
        video.setAttribute("mozallowfullscreen", "mozallowfullscreen");
        video.setAttribute("allowFullScreen", "allowFullScreen");
        content.appendChild(video);
    }
    setTimeout(function() {
        overlay.classList.add("dPopupOverlay<?php echo $Rich_Web_Slider_Manager[0]->id;?>_anim");
        content.classList.add("dPopupOverlayContent<?php echo $Rich_Web_Slider_Manager[0]->id;?>_anim");

    }, 100)
    setTimeout(function() {
        if (vSrc != "") {
            video.setAttribute("src", vSrc + "?rel=0&amp;autoplay=1");
            video.style.display = "block";
        }
    }, 400)

    function delPop() {
        if (vSrc != "") {
            video.setAttribute("src", "");
            video.style.display = "none";
        }
        overlay.classList.remove("dPopupOverlay<?php echo $Rich_Web_Slider_Manager[0]->id;?>_anim");
        content.classList.remove("dPopupOverlayContent<?php echo $Rich_Web_Slider_Manager[0]->id;?>_anim");
        setTimeout(function() {
            overlay.remove();
        }, 300)
    }

    delIcon.onclick = function() {
        delPop();
    }
    document.onkeyup = function(e) {
        if (e.keyCode == 27) {
            delPop();
        }
    }

}

var allIcons = document.querySelectorAll(".rSlider--slide_<?php echo $Rich_Web_Slider_Manager[0]->id;?>");

for (var i = 0; i < allIcons.length; i++) {
    allIcons[i].onclick = function() {
        createPopup(this.dataset.video, this.dataset.image);
    }
}
</script>