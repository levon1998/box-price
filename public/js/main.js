$(document).ready(function(){
   var $button = $('.open-video-modal'),
       $overlay = $('.video-overlay'),
       $modal = $('.video-modal'),
       $player = $('#player'),
       $close = $('#video_modal_close'),
       player,
       getVideoID = 'dk9uNWPP7EA';
   
   //setup video
   var onYouTubePlayerAPIReady = function() {
      player = new YT.Player('player', {
        /*height: '390',
        width: '640',*/
        videoId: getVideoID,
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
   }
   
   // Open modal after click
   $button.click(function(e){
      e.preventDefault();
      if (!player) onYouTubePlayerAPIReady();
      $overlay.attr('aria-hidden', 'false');
      $modal.attr('tabindex', '0');
      $button.hide();
   });
   
   // Close modal by btn click/hit
  $close.click(function(e){
     e.preventDefault();
     closeSection();
  });
   
   // autoplay video
   function onPlayerReady(event) {
      event.target.playVideo();
   }

   // Video ends
   function onPlayerStateChange(event) {        
      if(event.data === 0) {
         closeSection();
      }
   }
   
   // Stop video
   function resetPlayer() {
      player.pauseVideo();
   };
   
   //close modal
   function closeSection(){
      $button.show();
      $overlay.attr('aria-hidden', 'true');
      $modal.attr('tabindex', '-1');
      resetPlayer();
   }
   
   //check where mouse is clicked
   $overlay.mousedown(function(e) {
      var clicked = $(e.target); // get the element clicked
      if (clicked.is('.video-modal') || clicked.parents().is('video-modal')) {
         return; // click happened within the dialog, do nothing here
      } else { // click was outside the dialog, so close it
         closeSection();
      }
   });
   
   $(document).keydown(function(e) {
      // ESCAPE key pressed
      if (e.keyCode === 27) {
         closeSection();
      }
   });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
"user strict";
/*
====================== components =======================     
    1.Timer
    2.Smooth scroll
    3.Background-paralax
    4.Header sticky
    5.Mail function
    6.Loader JS
*/
/*-------------------------- 1.Timer --------------------------*/
function makeTimer() {
    now = new Date();
    countTo = new Date('May,22,2018,00:00:00');
    var difference = (now-countTo);

    days    = Math.floor(difference/(60*60*1000*24)*1);
    hours   = Math.floor((difference%(60*60*1000*24))/(60*60*1000)*1);
    minutes = Math.floor(((difference%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);
    seconds = Math.floor((((difference%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);
    if (days < "10") {
        days = "0" + days;
    }
    if (hours < "10") {
        hours = "0" + hours;
    }
    if (minutes < "10") {
        minutes = "0" + minutes;
    }
    if (seconds < "10") {
        seconds = "0" + seconds;
    }
    $(".days").html(days + "<span>Days</span>");
    $(".hours").html(hours + "<span>Hours</span>");
    $(".minutes").html(minutes + "<span>Minutes</span>");
    $(".seconds").html(seconds + "<span>Seconds</span>");
}
setInterval(function() {
    makeTimer();
}, 1000);
var NavBar = $('.navbar ');
/*---------Timer-end-----------*/

/*------------------------------------- 2.Smooth scroll --------------------------------*/
// redirect-btn - this class for smooth scroll of other button instead of header menu ..! 
$(document).ready(function() {
    /*----------------------------- 3.Background-parallax ---------------------------*/
    $(window).scroll(function(e) {
        parallax();
    });

    function parallax() {
        var scrolled = $(window).scrollTop();
        $('.parallax').css('background-position-y', -(scrolled * 0.2) + 'px');
    } /*--------- Background-paralax-end ----------*/

    /*------------------------------- 4.Header sticky -------------------------*/
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var navbarHeight = NavBar.outerHeight();
    $(window).scroll(function(event) {
        didScroll = true;
    });
    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 100);

    function hasScrolled() {
        var st = $(this).scrollTop();
        if (st + $(window).height() < $(document).height()) {
            NavBar.addClass('sticky-header');
            if (st == 0) {
                NavBar.removeClass('sticky-header');
            }
        }
        lastScrollTop = st;
    }
});

/*------------ Hader sticky-end  -------*/

/*--------------------------------- 5.Mail Fucntion -------------------------------*/
$(function() {
    var form = $('#ajax-contact');
    var formMessages = $('#form-messages');
    $(form).submit(function(e) {
        e.preventDefault();
        var formData = $(form).serialize();
        $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData
            })
            .done(function(response) {
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');
                $(formMessages).text(response);
                $('#first_name').val('');
                $('#last_name').val('');
                $('#email').val('');
                $('#message').val('');
            })
            .fail(function(data) {
                $(formMessages).removeClass('success');
                $(formMessages).addClass('error');
                if (data.responseText !== '') {
                    $(formMessages).text(data.responseText);
                } else {
                    $(formMessages).text('Oops! An error occured and your message could not be sent.'); /*--------- Contact submission erroe Message ---------------*/
                }
            });
    });

    var form1 = $('#subscribe_now');
    var mailMessages = $('#mail-messages');
    $(form1).submit(function(e) {
        e.preventDefault();
        var formData = $(form1).serialize();
        $.ajax({
                type: 'POST',
                url: $(form1).attr('action'),
                data: formData
            })
            .done(function(response) {
                $(mailMessages).removeClass('error');
                $(mailMessages).addClass('success');
                $(mailMessages).text(response.message);
                $('#email').val('');
                $('.subscribe-btn').hide();
            })
            .fail(function(data) {
                $(mailMessages).removeClass('success');
                $(mailMessages).addClass('error');
                if (data.responseText !== '') {
                    $(mailMessages).text(data.responseText);
                } else {
                    $(mailMessages).text('Oops! An error occured and your message could not be sent.'); /*--------- Contact submission erroe Message ---------------*/
                }
            });
    });
});

$(document).ready(function($) {
    new WOW().init();

    $('.site-loader').fadeOut(600);
});

