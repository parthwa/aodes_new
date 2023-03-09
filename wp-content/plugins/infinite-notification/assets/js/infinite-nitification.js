(function($) {
  'use strict';

document.addEventListener('DOMContentLoaded', function() {

var timer;
function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
var cookie_limit =  notification_ajax_object.cookie_limit;
$(document).on('click', '.sd-promo-btn-close', function() {
  setCookie("infinite_notification","off",cookie_limit);
  clearTimeout(timer);
   $('.recent-order-product-notice').replaceWith('');
   $('#notify-sound').replaceWith('');
});


function show_sales_notification() {

  var audio =  document.getElementById("notify-sound");
  var data =  notification_ajax_object.data;
  var timeinterval =  notification_ajax_object.timeinterval;
  var toptext =  notification_ajax_object.toptext;
  var poweredbytext =  notification_ajax_object.poweredbytext;
  var dataval = jQuery.parseJSON(data);

  $.each(dataval, function(index, value) {
    var count = index+1;
    var timeout_set = count*timeinterval;
    timer=setInterval(function () {
      audio.muted = false;
      audio.play();
      setTimeout(function () {
        audio.muted = true;
        $(".recent-order-product-notice").empty();
      },8000)
      $('.recent-order-product').replaceWith('');
    
      var tr_str = '<div class="recent-order-product" id="recent-order-product"><button id="promo-close-button" class="sd-promo-btn-close"></button><div class="recent-order-product-content">' +
        '<img src='+value.image+'>' +
        '<div><p>'+toptext+'</p><h6><a href='+value.url+'>' + value.name + '</a>'+ value.price +'</h6>' +
        '<time>' + value.date + value.buyer.city+', '+ value.buyer.country+'</time>'+poweredbytext+'</div></div></div>';
       $(".recent-order-product-notice").append(tr_str).fadeIn('slow');
        
    }, timeout_set);

  });

}

var salesNotification=getCookie("infinite_notification");

if(salesNotification != 'off'){
    show_sales_notification(true);
}


});

})(jQuery);