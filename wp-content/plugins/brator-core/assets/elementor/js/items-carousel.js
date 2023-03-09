(function ($) {
  "use strict";

  var brator_main_slider_js = function () {
    if ($('.brator-banner-slider').length) {
      var splide = new Splide( '.brator-banner-slider' );
      splide.mount();
    }
  }

  var brator_sidebar_slider_js = function () {
    if ($('.brator-sidebar-slider').length) {
      var splide = new Splide( '.brator-sidebar-slider' );
      splide.mount();
    }
  }
  

  var brator_hot_offer_slider_js = function () {
    if ($('.brator-offer-slider').length) {
      var splide = new Splide( '.brator-offer-slider' );
      splide.mount();
    }
  }

  var brator_products_section_js = function () {

     $('.brator-product-slider').each(function() {
      var splide = new Splide( '.brator-product-slider' );
      splide.mount();
    });

  }

  var brator_shop_category_js = function () {
    if ($('.brator-categories-slider').length) {
      var splide = new Splide( '.brator-categories-slider' );
      splide.mount();
    }
  }

  var brator_reviews_slider_js = function () {
    if ($('.brator-review-slider').length) {
      var splide = new Splide( '.brator-review-slider' );
      splide.mount();
    }
  }

  var brator_blog_slider_js = function () {
    if ($('.brator-blog-slider').length) {
      var splide = new Splide( '.brator-blog-slider' );
      splide.mount();
    }
  }

  var brator_testimonial_js = function () {
    if ($('.brator-client-review').length) {
      var splide = new Splide( '.brator-client-review' );
      splide.mount();
    }
  }

  var brator_clients_js = function () {
    if ($('.brator-brand').length) {
      var splide = new Splide( '.brator-brand' );
      splide.mount();
    }
  }

  var brator_team_js = function () {
    if ($('.brator-team-slider').length) {
      var splide = new Splide( '.brator-team-slider' );
      splide.mount();
    }
  }

  var brator_megasell_slider_js = function () {
    if ($('.brator-megasell-slide-active').length) {
      var splide = new Splide( '.brator-megasell-slide-active' );
      splide.mount();
    }
  }

  var brator_sidebar_review_slider_js = function () {
    if ($('.brator-sidebar-review-slider').length) {
      var splide = new Splide( '.brator-sidebar-review-slider' );
      splide.mount();
    }
  }



  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_main_slider.default', brator_main_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_hot_offer_slider.default', brator_hot_offer_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_offer_slider.default', brator_hot_offer_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_products_section.default', brator_products_section_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_recently_viewed_products.default', brator_products_section_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_shop_category.default', brator_shop_category_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_testimonial.default', brator_testimonial_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_clients.default', brator_clients_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_team.default', brator_team_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_megasell_slider.default', brator_megasell_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_banner_slider.default', brator_megasell_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_sidebar_testimonial.default', brator_sidebar_review_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_sidebar_blog.default', brator_sidebar_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_reviews.default', brator_reviews_slider_js);
    elementorFrontend.hooks.addAction('frontend/element_ready/brator_blog.default', brator_blog_slider_js);
  });


})(window.jQuery);