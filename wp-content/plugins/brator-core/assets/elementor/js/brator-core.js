(function ($) {
    ("use strict");

    $(document).ready(function() {

      $(".vehicle-list-wapper .select-year-parts").change(function(){
        $('.vehicle-list-wapper .select-make-parts').prop('disabled', false);
      });

      $(".vehicle-list-wapper .select-make-parts").change(function(){
        $('.vehicle-list-wapper .select-model-parts').prop('disabled', false);
      });

      $(".vehicle-list-wapper .select-model-parts").change(function(){
        $('.vehicle-list-wapper .select-engine-parts').prop('disabled', false);
      });

      $(".brator-parts-search-box-area .select-year-parts").change(function(){
        $('.brator-parts-search-box-area .select-make-parts').prop('disabled', false);
      });

      $(".brator-parts-search-box-area .select-make-parts").change(function(){
        $('.brator-parts-search-box-area .select-model-parts').prop('disabled', false);
      });

      $(".brator-parts-search-box-area .select-model-parts").change(function(){
        $('.brator-parts-search-box-area .select-engine-parts').prop('disabled', false);
      });

      $(".brator-parts-search-box-area .select-engine-parts").change(function(){
        $('.brator-parts-search-box-area .select-fueltype-parts').prop('disabled', false);
      }); 

    });

    // if(brator_ajax_localize.models_show_from != 2){
    //   $('#makebrand').removeAttr('disabled');
    //   $('#makemodel').removeAttr('disabled');
    // }

    if(brator_ajax_localize.models_show_from == 2){
      $(".brator-parts-search-box-area .select-make-parts").on('change',function(){
        var makebrand = $(this).val();
        $.ajax({
            type: 'post', 
            url: brator_ajax_localize.ajax_url, 
            dataType: 'html',
            data: {
                action: 'brator_makemodel_name_select',
                makebrand: makebrand,
            },
            beforeSend: function() {
              $('.select-model-parts+.select2').addClass('loading');
            },
            success: function( data ) {
              $('.select-model-parts').empty('');
              $('.select-model-parts+.select2').removeClass('loading');
              $('.select-model-parts').html(data);
            }
        })
      });
    }


  if(brator_ajax_localize.engines_show_from == 2){
    $(".brator-parts-search-box-area .select-model-parts").on('change',function(){
        var makemodel = $(this).val();
        $.ajax({
            type: 'post', 
            url: brator_ajax_localize.ajax_url, 
            dataType: 'html',
            data: {
                action: 'brator_engine_name_select',
                makemodel: makemodel,
            },
            beforeSend: function() {
              $('.select-engine-parts+.select2').addClass('loading');
            },
            success: function( data ) {
              $('.select-engine-parts').empty('');
              $('.select-engine-parts+.select2').removeClass('loading'); 
              $('.select-engine-parts').html(data);
            }
        })
    });
  }

  if(brator_ajax_localize.fueltype_show_from == 2){
    $(".brator-parts-search-box-area .select-engine-parts").on('change',function(){
      var engine = $(this).val();
      $.ajax({
          type: 'post', 
          url: brator_ajax_localize.ajax_url, 
          dataType: 'html',
          data: {
              action: 'brator_fueltype_name_select',
              engine: engine,
          },
          beforeSend: function() {
            $('.select-fueltype-parts+.select2').addClass('loading');
          },
          success: function( data ) {
              $('.select-fueltype-parts').empty('');
              $('.select-fueltype-parts+.select2').removeClass('loading');
              $('.select-fueltype-parts').html(data);
          }
      })
    });
  }


    $('.cat-list_item').on('click', function() {
      $('.cat-list_item').removeClass('active');
      $(this).addClass('active');
      
      product_grid_type =  $('#product_grid_type').val();
      product_per_page =  $('#product_per_page').val();
      product_order_by =  $('#product_order_by').val();
      product_order =  $('#product_order').val();
      catagory_name =  $('#catagory_name').val();
      product_style =  $('#product_style').val();

      $.ajax({
        type: 'POST',
        url: brator_ajax_localize.ajax_url,
        dataType: 'html',
        data: {
          action: 'brator_tab_filter_products',
          category: $(this).data('slug'),
          product_grid_type: product_grid_type,
          product_per_page: product_per_page,
          product_order_by: product_order_by,
          product_order: product_order,
          catagory_name: catagory_name,
          product_style: product_style,
        },
        beforeSend: function() {
          $('.project-tiles .splide__slide').html('<div class="prd-grid-custom-svg-loader"><svg xmlns="http://www.w3.org/2000/svg" width="275" height="455" viewBox="0 0 275 455"><g transform="translate(-731 -1194)"><g transform="translate(731 1194)" fill="#fff" stroke="#e5e5e5" stroke-width="0"><rect width="275" height="455" rx="2" stroke="none"></rect><rect x="0.5" y="0.5" width="274" height="454" rx="1.5" fill="none"></rect></g><rect width="232" height="213" rx="3" transform="translate(753 1216)" fill="#f4f4f8"></rect><rect width="35" height="15" rx="3" transform="translate(753 1468)" fill="#f4f4f8"></rect><rect width="205" height="39" rx="3" transform="translate(753 1493)" fill="#f4f4f8"></rect><rect width="165" height="15" rx="3" transform="translate(753 1542)" fill="#f4f4f8"></rect><rect width="79" height="20" rx="3" transform="translate(753 1605)" fill="#f4f4f8"></rect><rect width="50" height="20" rx="3" transform="translate(838 1605)" fill="#f4f4f8"></rect></g></svg></div>');
        },
        success: function(res) {
          $('.project-tiles').html(res);
          let elms = document.getElementsByClassName('splide');
          if (elms.length > 0) {
              for (let i = 0, len = elms.length; i < len; i++) {
                  new Splide(elms[i]).mount();
              }
          }
        }
      })
    });


    $("#clearvehicle").on('click',function(){
        $.ajax({
            type: 'post', 
            url: brator_ajax_localize.ajax_url, 
            dataType: 'html',
            data: {
                action: 'brator_clearvehicle',
            }, 
            success: function( res ) {
               $('.vehicle-list').empty('');
               $('.vehicle-list').addClass('empty');
            }
        })
    });  


    $('.brator-product-single-item-area').append('<div class="prd-grid-custom-svg-loader"><svg xmlns="http://www.w3.org/2000/svg" width="275" height="455" viewBox="0 0 275 455"><g transform="translate(-731 -1194)"><g transform="translate(731 1194)" fill="#fff" stroke="#e5e5e5" stroke-width="0"><rect width="275" height="455" rx="2" stroke="none"></rect><rect x="0.5" y="0.5" width="274" height="454" rx="1.5" fill="none"></rect></g><rect width="232" height="213" rx="3" transform="translate(753 1216)" fill="#f4f4f8"></rect><rect width="35" height="15" rx="3" transform="translate(753 1468)" fill="#f4f4f8"></rect><rect width="205" height="39" rx="3" transform="translate(753 1493)" fill="#f4f4f8"></rect><rect width="165" height="15" rx="3" transform="translate(753 1542)" fill="#f4f4f8"></rect><rect width="79" height="20" rx="3" transform="translate(753 1605)" fill="#f4f4f8"></rect><rect width="50" height="20" rx="3" transform="translate(838 1605)" fill="#f4f4f8"></rect></g></svg></div>')

    $(window).load(function() {
      $('body').addClass('loading-frame');
      $('.prd-grid-custom-svg-loader').delay(500).fadeOut(200);
    });

  })(jQuery);




