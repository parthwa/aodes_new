(function($) {

    "use strict";


    $(window).load(function() {
        $('.preloader-area').fadeOut('.1');
     });

    $('.product-categories').addClass('shop-cat-list');
    $('.cat-parent').addClass('sub-cat');
    $( ".cat-parent" ).append( '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path></svg>' );

    document.addEventListener('lazybeforeunveil', function(e){
        var bg = e.target.getAttribute('data-bg');
        if(bg){
            e.target.style.backgroundImage = 'url(' + bg + ')';
        }
    });
 

    document.addEventListener('DOMContentLoaded', function() {
        /*
        	gsap start
        */
        var gsapTimeline = new TimelineMax();
        var controller = new ScrollMagic.Controller({
            loglevel: 0
        });


        $('.brator-app-area').each(function() {

            var bgImg = $(this).find(".brator-app-content-area");
            var tween2 = TweenMax.fromTo(
                bgImg,
                1, {
                    css: {
                        backgroundPosition: '45% -25px'
                    },
                    ease: Linear.easeNone
                }, {
                    css: {
                        backgroundPosition: '55% -25px'
                    },
                    ease: Linear.easeNone
                }
            );
            gsapTimeline
                .add(tween2);
            var sectionBg = new ScrollMagic.Scene({
                    tweenChanges: true,
                    triggerElement: this,
                    offset: 0,
                    duration: "60%",
                    triggerHook: 'onCenter', /// onEnter // onLeave
                    loglevel: 2
                })
                .addTo(controller)
                .setTween(
                    gsapTimeline
                )
        });


        /*
        	scroll start
        */

        function headerStyle() {
            if ($('.scroll-top').length) {
                var windowpos = $(window).scrollTop();
                var scrollLink = $('.scroll-top');
                if (windowpos >= 270) {
                    scrollLink.addClass('open');
                } else {
                    scrollLink.removeClass('open');
                }
            }
        }

        if ($('.scroll-to-target').length) {
            $(".scroll-to-target").on('click', function() {
                var target = $(this).attr('data-target');
                // animate
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 1000);

            });
        }


        function scrollMenuStyle() {
            if ($('.scroll-menu').length) {
                var windowpos = $(window).scrollTop();
                var scrollLink = $('.scroll-menu');
                if (windowpos >= 270) {
                    scrollLink.addClass('open');
                } else {
                    scrollLink.removeClass('open');
                }
            }
        }

        $(window).on('scroll', function() {
            headerStyle();
            scrollMenuStyle();
        });


        /*
        	counter start
        */
        if ($('.brator-our-story-count').length) {
            $('.brator-our-story-count p span').counterUp({
                delay: 10,
                time: 1000
            });
        }

        /*
        	splide start
        */
       
        let elms = document.getElementsByClassName('splide');
        if (elms.length > 0) {
            for (let i = 0, len = elms.length; i < len; i++) {
                new Splide(elms[i]).mount();
            }
        }



        // window.onresize = doALoadOfStuff;

        // function doALoadOfStuff() {
            
        //     let elms = document.getElementsByClassName('splide');
        //     if (elms.length > 0) {
        //         for (let i = 0, len = elms.length; i < len; i++) {
        //             new Splide(elms[i]).mount();
        //         }
        //     }

        // }





        var productSliderPrice = document.getElementById('brator-rang-item-slider-nou');
        if (productSliderPrice != null) {
            noUiSlider.create(productSliderPrice, {
                start: [20, 80],
                connect: true,
                range: {
                    'min': 0,
                    'max': 100
                }
            });
        }


        let reviewSyncAuthore = document.getElementsByClassName('brator-client-review-author');
        let reviewSyncReview = document.getElementsByClassName('brator-client-review');

        if (reviewSyncAuthore.length > 0) {
            // reviewSliderCount
            var reviewSlider = new Splide('.brator-client-review', {
                type: 'fade',
                cover: true,
                rewind: true,
                pagination: false
            });
            var reviewSliderAuthor = new Splide('.brator-client-review-author', {
                // rewind     : true,
                focus: 1,
                pagination: false,
                arrows: false,
                perPage: 3,
                perMove: 1,
                breakpoints: {
                    1026: {
                        perPage: 2
                    },
                    767: {
                        perPage: 1
                    }
                }
            });
            reviewSlider.sync(reviewSliderAuthor);
            reviewSlider.mount();
            reviewSliderAuthor.mount();
        }

        /*
        	tab start
        */
        let productInfoTab = document.getElementsByClassName('js-tabs');
        if (productInfoTab.length > 0) {
            var tabProductItem = new Tabs({
                elem: "tabs-product-content",
                open: 0
            });
            tabProductItem.open(0);
        }

        if ($('.brator-slide-menu-area .mega-menu-li').length) {
            $('.brator-slide-menu-area .mega-menu-li').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg>')
        }

        if ($('.brator-slide-menu-area .mega-menu-li').length) {
            $('.brator-slide-menu-area .mega-menu-li svg').on('click', function(e) {

                $(this).toggleClass('open');

                $(this).closest('.mega-menu-li').children('.mega-menu-area').slideToggle(500);

            })
        }

        if ($('.brator-slide-menu-area .menu-item-has-children').length) {
            $('.brator-slide-menu-area .menu-item-has-children').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg>')
        }


        if ($('.brator-slide-menu-area .menu-item-has-children').length) {
            $('.brator-slide-menu-area .menu-item-has-children svg').on('click', function(e) {
                $(this).toggleClass('open');
                $(this).closest('.menu-item-has-children').children('ul').slideToggle(500);
            })
        }

        if ($('.brator-categories-list-load-more').length) {
            $('.brator-categories-more-button').on('click', function(e) {
                $('.brator-categories-list').addClass('open');
                $('.brator-categories-list-load-more').hide();
            })
        }

    });


    const cart = document.querySelector('.brator-cart-link')
    if(cart != null )
        cart.addEventListener('click', e => {
            // http://brator.local/cart/
            
            fetch(`http://brator.local/cart/`)
            .then((response) => {
                return response.text();
            })
            .then((state) => {
                document.querySelector('.brator-megasell-area').innerHTML = state
                console.log(state);

            }).catch(() => {

            });
        })

    /*
    cart start
    */
    if ($('.brator-cart-link').length) {
        $('.brator-cart-link a').on('click', function(e) {
            $('.brator-cart-item-list').toggleClass('mini-cart-open');
        });
    }

    $('.brator-cart-close').on('click', function(e) {
        $('.brator-cart-item-list').removeClass('mini-cart-open');
    });


    if ($('.brator-icon-link-text').length) {
        $('.brator-icon-link-text a').on('click', function(e) {
            $('.vehicle-list-wapper').toggleClass('open');
        });
    }

    /*
    	menu start
    */

    var getLogo = $('.brator-header-area .brator-logo').html();
    var getMenu = $('.brator-header-menu-area .brator-header-menu').html();

    if ($('.brator-logo button').length) {
        $('.brator-logo button').on('click', function() {
            $('body').addClass('mobile-menu-open');
        });

        $('.brator-slide-menu-bg').on('click', function() {
            $('body').removeClass('mobile-menu-open');
        });
        $('.brator-slide-menu-close').on('click', function() {
            $('body').removeClass('mobile-menu-open');
        });

        if ($('.brator-slide-logo-items').length) {
            $('.brator-slide-logo-items').append(getLogo);
        }
        if ($('.brator-slide-menu-items').length) {
            $('.brator-slide-menu-items').append(getMenu);
        }

    }

    if ($('.sticky-menu').length) {
        $('.sticky-menu').append(getMenu);
    }

    /*
    	filtter start
    */

    if ($('.filter-enable').length) {
        $('.filter-enable').on('click', function() {
            $('body').addClass('shop-filter-open');
        });
    }

    if ($('.brator-sidebar-area.design-one .close-fillter').length) {
        $('.brator-sidebar-area.design-one .close-fillter').on('click', function() {
            $('body').removeClass('shop-filter-open');
        });
    }

    /*
    	mega menu  start
    */


    $(".close-menu-bg").click(function() {
        $(".brator-header-menu li").removeClass('active');
        $('body').removeClass('brator-header-menu-bg');
        let docHeight = 'auto'
        $('.close-menu-bg').css("height", docHeight);
    });

    $(".brator-mega-menu-close").click(function() {
        $(".brator-header-menu li").removeClass('active');
        $('body').removeClass('brator-header-menu-bg');
        let docHeight = 'auto'
        $('.close-menu-bg').css("height", docHeight);
    });

    /*
    	filter  start
    */

    if ($('.brator-filter-item-area').length) {
        $('.brator-filter-item-title').on("click", function() {
            if ($(this).hasClass('current')) {
                $(this).removeClass('current');
                let elHeight = $(this)[0].nextElementSibling.scrollHeight
                $(this).next().css("maxHeight", `${0}px`)
                $(this).next().css("height", `${0}px`)
            } else {
                $(this).addClass('current');
                let elHeight = $(this)[0].nextElementSibling.scrollHeight
                $(this).next().css("maxHeight", `${elHeight}px`)
                $(this).next().css("height", `${elHeight}px`)
            }
        });
    }

    if ($('.rest-all-checkbox').length) {
        $('.rest-all-checkbox').on("click", function() {
            $('.shop-sidebar-content input:checkbox').removeAttr('checked');
        });
    }

    if ($('.sub-cat').length) {
        $('.sub-cat').on("click", function() {

            if ($(this).hasClass('current')) {
                $(this).removeClass('current');
            } else {
                $(this).addClass('current');
            }
        });
    }

    /*
    	view more text  start
    */

    if ($('.brator-makes-list-view-more button').length) {
        $('.brator-makes-list-view-more button').on("click", function() {
            if ($('.brator-makes-list-single.disable').hasClass('current')) {
                $('.brator-makes-list-single.disable').removeClass('current');
                $('.brator-makes-list-view-more button span b ').text('view more');
                $('.brator-makes-list-view-more button').removeClass('current');
            } else {
                $('.brator-makes-list-single.disable').addClass('current');
                $('.brator-makes-list-view-more button span b ').text('view less');
                $('.brator-makes-list-view-more button').addClass('current');
            }
        });
    }

    if ($('.brator-more-text-view-more').length) {
        $('.brator-more-text-view-more').on("click", function() {
            if ($('.brator-more-text-view-more').hasClass('current')) {
                $('.brator-more-text-view-more').removeClass('current');
                $('.brator-more-text-content .disable').removeClass('current');
                $('.brator-more-text-view-more button span').text('view more');
            } else {
                $('.brator-more-text-content .disable').addClass('current');
                $('.brator-more-text-view-more').addClass('current');
                $('.brator-more-text-view-more button span').text('view less');
            }
        });
    }

    /*
    	input start
    */

    let priceMin = $(".brator-rang-item-input-single input[name='min']").attr('value');
    if (priceMin != '') {
        $(".brator-rang-item-input-single input[name='min']").addClass('current')
    }

    let priceMax = $(".brator-rang-item-input-single input[name='max']").attr('value');
    if (priceMax != '') {
        $(".brator-rang-item-input-single input[name='max']").addClass('current')
    }

    $(".brator-rang-item-input-single input[name='min']").change(e => {
        let priceMinUpdate = e.target.value;
        if (priceMinUpdate != '') {
            $(".brator-rang-item-input-single input[name='min']").addClass('current-yaps')
        } else {
            $(".brator-rang-item-input-single input[name='min']").removeClass('current-yaps')
        }
    })

    $(".brator-rang-item-input-single input[name='max']").change(e => {
        let priceMaxUpdate = e.target.value;
        if (priceMaxUpdate != '') {
            $(".brator-rang-item-input-single input[name='max']").addClass('current-yaps')
        } else {
            $(".brator-rang-item-input-single input[name='max']").removeClass('current-yaps')
        }
    })

    /*
    	coming soon start
    */

    if ($('.brator-coming-soon-counter').length) {
        (function() {
      
            var countdate = $('.brator-coming-soon-counter').data("attr");
            var activeId = $('#countdown').data('id');
            function makeTimer() {
                
                var endTime = new Date(countdate);			
                    endTime = (Date.parse(endTime) / 1000);
        
                    var now = new Date();
                    now = (Date.parse(now) / 1000);
        
                    var timeLeft = endTime - now;
        
                    var days = Math.floor(timeLeft / 86400); 
                    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
                    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
            
                    if (hours < "10") { hours = "0" + hours; }
                    if (minutes < "10") { minutes = "0" + minutes; }
                    if (seconds < "10") { seconds = "0" + seconds; }
        
                    $("#days").html(days);
                    $("#hours").html(hours);
                    $("#minutes").html(minutes);
                    $("#seconds").html(seconds);
            
            }
            setInterval(function() { makeTimer(); }, 1000);



        }());
    }

/*
   ttInputCounter
*/

(function($){
	//ttInputCounter
	var inputCounter = $('.tt-input-counter');
	if (inputCounter.length){
		inputCounter.find('.minus-btn, .plus-btn').on('click',function(e) {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val(), 10) + parseInt(e.currentTarget.className === 'plus-btn' ? 1 : -1, 10);
			$input.val(count).change();
		});
		inputCounter.find("input").change(function() {
			var _ = $(this);
			var min = 1;
			var val = parseInt(_.val(), 10);
			var max = parseInt(_.attr('size'), 10);
			val = Math.min(val, max);
			val = Math.max(val, min);
			_.val(val);
		})
		.on("keypress", function( e ) {
			if (e.keyCode === 13) {
				e.preventDefault();
			}
		});
	}
})(jQuery);


      
        function brator_search_product() {
          var pro_search = $('#prosearch').val();
          var cat_search = $('#header-cat-search').find(":selected").val();

          $.ajax({
            type: 'post', 
            dataType: "html",
            url: brator_ajax_localize.ajax_url, 
            data: {
                action: 'brator_products_search',
                pro_search: pro_search,
                cat_search: cat_search,
            }, 
            beforeSend: function(){
                $("#productdatasearch").html("<p class='loading'>"+brator_ajax_localize.loading+"</p>");
            },
            success: function( res ) {
                if(typeof cat_search !== 'undefined' && cat_search != ''){
                    $('#productdatasearch').html("");
                    $('#productdatasearch').append( res );
                }else if(pro_search != '' && pro_search.length > 3){
                    $('#productdatasearch').html("");
                    $('#productdatasearch').append( res );
                }else{
                    if(pro_search != '' && pro_search.length < 4){
                        $("#productdatasearch").html("<p class='loading'>"+brator_ajax_localize.no_result+"</p>");    
                    }else{
                        $('#productdatasearch').empty( res );
                    }
                }
            }
          })
        }
      
        $("#prosearch").on("keyup", function () {
          // Run AJAX search.
            brator_search_product();
        });
    
        $("#header-cat-search").change(function(){
            brator_search_product();
        });



      $(".ajax_add_to_cart_more").on('click',function(){
            var product_ids = $(this).data('product_ids');
            $.ajax({
                type: 'post', 
                url: brator_ajax_localize.ajax_url, 
                data: {
                    action: 'woocommerce_maybe_add_multiple_products_to_cart',
                    product_ids: product_ids,
                }, 
                success: function( res ) {
                    
                }
            })
       });



    if(brator_ajax_localize.woocommerce_cart_redirect_after_add!='yes'){
        $(".ajax_add_to_cart_more").on('click',function(e){
            e.preventDefault();
            var product_url = window.location,
                form = $(this);
            form.addClass('added');
            $.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
                if ($(result).find('.woocommerce-error').length) {
                    if ($("[id^=product]").prev('.woocommerce-error').length > 0) {
                        $(".woocommerce-error").html($(result).find('.woocommerce-error').html())
                    } else {
                        $('.tt-add-to-cart').html($(result).find('.woocommerce-error').clone())
                        $("[id^=product]").before($(result).find('.woocommerce-error').clone())
                    }
                }
                $.ajax({
                    url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                    type: 'POST',
                    success: function (data) {
                        if (data && data.fragments) {
                            $.each(data.fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });
                            $(document.body).trigger('wc_fragments_refreshed');
                            $(document.body).trigger('added_to_cart');
                        }
                    }
                });
            });
        });

    }


var pro_ids_list = $('input.fb_pro_price');
var pro_ids_val = [];
var pro_price_val = [];

$.each(pro_ids_list, function() {
    var $this = $(this);
    // check if the checkbox is checked
    $this.on('change', function() {
        if ($this.prop('checked')==true){ 
            // put the checked animal value to the html list
           var ids_val = $this.val();
           pro_ids_val.push(ids_val);
           $('.ajax_add_to_cart_more').attr('data-product_ids', pro_ids_val);

            var price_val = $this.attr('data-price');
            var currva = $('#to_pro_price').val();
            var totalPrice = parseInt(price_val)+parseInt(currva);
            $('#to_pro_price').val(totalPrice);

        }else{
           var id_val = $this.val();

           var all_ids = $('.ajax_add_to_cart_more').attr('data-product_ids');
           var numbersArray = all_ids.split(',');

           const index = numbersArray.indexOf(id_val);
            if (index > -1) {
                numbersArray.splice(index, 1);
            }
         
            const str = numbersArray.toString();

            $('.ajax_add_to_cart_more').attr('data-product_ids', str);

            var price_val = $this.attr('data-price');
            var currva = $('#to_pro_price').val();
            var totalPrice = parseInt(currva)-parseInt(price_val);
            $('#to_pro_price').val(totalPrice);
        }
    });	
});	


$(document).ready(function() {
    $('.brator-select-active').select2();
});


if ($('.brator-header-four .brator-header-menu #menu-primary-menu .menu-item-has-children').length) {
    $('.brator-header-four .brator-header-menu #menu-primary-menu > .menu-item-has-children > a').append('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg>')
}



})(window.jQuery);