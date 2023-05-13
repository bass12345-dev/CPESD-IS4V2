    <script type="text/javascript">var base_url = '<?php echo site_url(); ?>';</script>

 
   
    <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bundle.js"></script>


    <script src="<?php echo base_url(); ?>assets/datepicker/bootstrap-datetimepicker.min.js"></script>
    


  

    <script type="text/javascript">
var _validFileExtensions = [".pdf"];
var validImageExtensions = [".png", ".jpg", "jpeg"];
$(document).on('click', 'a#update-cso-status', function (e) {
   const id = $(this).data('id');
   const status = $(this).data('status');
   $('#update_cso_status_modal').modal('show');
   $('#cso_status_update option[value=' + status + ']').attr('selected', 'selected');
   $('input[name=cso_id]').val(id);
});
$(document).on('click', 'a#view_transaction', function (e) {
   window.open(base_url + 'view-transaction?id=' + $(this).data('id'), '_self');
});
$(document).on('click', 'a#view_rfa', function (e) {
   window.open(base_url + 'user/pending/update-rfa?id=' + $(this).data('id'), '_self');
});
$(document).on('click', 'a#view_rfa_', function (e) {
   window.open(base_url + 'view-rfa?id=' + $(this).data('id'), '_self');
});
$(document).on('click', 'a#view_user', function (e) {
   window.open(base_url + 'view-user?id=' + $(this).data('id'), '_self');
});

   $(document).on('click', '#view_my_calendar', function (e) { 
            window.open(base_url + 'user/calendar-of-activities', '_blank'); 
        }); 

function count_total_reffered_rfa() {
   $.ajax({
      type: "POST",
      url: base_url + 'api/count-reffered-rfa',
      cache: false,
      dataType: 'text',
      success: function (data) {
         $('.count_reffered_rfa').text(data);
      }
   })
}
$(document).on('click', 'a.back-button', function (e) {
   history.back()
});
count_total_reffered_rfa();

function count_total_rfa_pending() {
   $.ajax({
      type: "POST",
      url: base_url + 'api/count-pending-rfa',
      cache: false,
      dataType: 'text',
      success: function (data) {
         $('.count_pending_rfa').text(data);
      }
   })
}
count_total_rfa_pending();

function load_total_pending_transactions() {
   $.ajax({
      type: "POST",
      url: base_url + 'api/count-pending-transactions',
      cache: false,
      dataType: 'json',
      success: function (data) {
         $('.count_pending').text(data);
      }
   })
}
load_total_pending_transactions();
$(document).on('click', 'a#add_transactions', function (e) {
   window.open(base_url + 'user/pending-transactions/add-transaction', '_self');
});
$(document).on('click', 'a#request_for_assistance', function (e) {
   window.open(base_url + 'user/request-for-assistance', '_self');
});
$(document).on('click', '#back-button', function (e) {
   window.history.back();
});

function loadlink() {
   load_total_pending_transactions();
   count_total_rfa_pending();
   count_total_reffered_rfa();
}
// setInterval(function () {
//    loadlink()
// }, 8000);
$('.dropdown-toggle').dropdown();
var preloader = $('#preloader');
$(window).on('load', function () {
   setTimeout(function () {
      preloader.fadeOut('slow', function () {
         $(this).remove();
      });
   }, 300)
});
if (window.innerWidth <= 1364) {
   $('.page-container').addClass('sbar_collapsed');
}
$('.nav-btn').on('click', function () {
   $('.page-container').toggleClass('sbar_collapsed');
});
var e = function () {
   var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
   (e -= 67) < 1 && (e = 1), e > 67 && $(".main-content").css("min-height", e + "px")
};
$(window).ready(e), $(window).on("resize", e);
$("#menu").metisMenu();
$('.menu-inner ').slimScroll({
   height: 'auto',
});
$('.nofity-list').slimScroll({
   height: '435px'
});
$('.timeline-area').slimScroll({
   height: '500px'
});
$('.recent-activity').slimScroll({
   height: 'calc(100vh - 114px)'
});
$('.settings-list').slimScroll({
   height: 'calc(100vh - 158px)'
});
$(window).on('scroll', function () {
   var scroll = $(window).scrollTop(),
      mainHeader = $('#sticky-header'),
      mainHeaderHeight = mainHeader.innerHeight();
   if (scroll > 1) {
      $("#sticky-header").addClass("sticky-menu");
   } else {
      $("#sticky-header").removeClass("sticky-menu");
   }
});
$('[data-toggle="popover"]').popover();
window.addEventListener('load', function () {
   var forms = document.getElementsByClassName('needs-validation');
   var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
         if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
         }
         form.classList.add('was-validated');
      }, false);
   });
}, false);
$('ul#nav_menu').slicknav({
   prependTo: "#mobile_menu"
});
$('.form-gp input').on('focus', function () {
   $(this).parent('.form-gp').addClass('focused');
});
$('.form-gp input').on('focusout', function () {
   if ($(this).val().length === 0) {
      $(this).parent('.form-gp').removeClass('focused');
   }
});
$('.settings-btn, .offset-close').on('click', function () {
   $('.offset-area').toggleClass('show_hide');
   $('.settings-btn').toggleClass('active');
});

function slider_area() {
   var owl = $('.testimonial-carousel').owlCarousel({
      margin: 50,
      loop: true,
      autoplay: false,
      nav: false,
      dots: true,
      responsive: {
         0: {
            items: 1
         },
         450: {
            items: 1
         },
         768: {
            items: 2
         },
         1000: {
            items: 2
         },
         1360: {
            items: 1
         },
         1600: {
            items: 2
         }
      }
   });
}
slider_area();
if ($('#full-view').length) {
   var requestFullscreen = function (ele) {
      if (ele.requestFullscreen) {
         ele.requestFullscreen();
      } else if (ele.webkitRequestFullscreen) {
         ele.webkitRequestFullscreen();
      } else if (ele.mozRequestFullScreen) {
         ele.mozRequestFullScreen();
      } else if (ele.msRequestFullscreen) {
         ele.msRequestFullscreen();
      } else {
         console.log('Fullscreen API is not supported.');
      }
   };
   var exitFullscreen = function () {
      if (document.exitFullscreen) {
         document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
         document.webkitExitFullscreen();
      } else if (document.mozCancelFullScreen) {
         document.mozCancelFullScreen();
      } else if (document.msExitFullscreen) {
         document.msExitFullscreen();
      } else {
         console.log('Fullscreen API is not supported.');
      }
   };
   var fsDocButton = document.getElementById('full-view');
   var fsExitDocButton = document.getElementById('full-view-exit');
   fsDocButton.addEventListener('click', function (e) {
      e.preventDefault();
      requestFullscreen(document.documentElement);
      $('body').addClass('expanded');
   });
   fsExitDocButton.addEventListener('click', function (e) {
      e.preventDefault();
      exitFullscreen();
      $('body').removeClass('expanded');
   });
};
jQuery(document).ready(function () {
   jQuery('.form-wizard-next-btn').click(function () {
      var parentFieldset = jQuery(this).parents('.wizard-fieldset');
      var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
      var next = jQuery(this);
      var nextWizardStep = true;
      parentFieldset.find('.wizard-required').each(function () {
         var thisValue = jQuery(this).val();
         console.log(thisValue);
         if (thisValue == "") {
            jQuery(this).siblings(".wizard-form-error").slideDown();
            nextWizardStep = false;
         } else {
            jQuery(this).siblings(".wizard-form-error").slideUp();
         }
      });
      if (nextWizardStep) {
         next.parents('.wizard-fieldset').removeClass("show", "400");
         currentActiveStep.removeClass('active').addClass('activated').next().addClass('active', "400");
         next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
         jQuery(document).find('.wizard-fieldset').each(function () {
            if (jQuery(this).hasClass('show')) {
               var formAtrr = jQuery(this).attr('data-tab-content');
               jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
                  if (jQuery(this).attr('data-attr') == formAtrr) {
                     jQuery(this).addClass('active');
                     var innerWidth = jQuery(this).innerWidth();
                     var position = jQuery(this).position();
                     jQuery(document).find('.form-wizard-step-move').css({
                        "left": position.left,
                        "width": innerWidth
                     });
                  } else {
                     jQuery(this).removeClass('active');
                  }
               });
            }
         });
      }
   });
   jQuery('.form-wizard-previous-btn').click(function () {
      var counter = parseInt(jQuery(".wizard-counter").text());;
      var prev = jQuery(this);
      var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
      prev.parents('.wizard-fieldset').removeClass("show", "400");
      prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
      currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active', "400");
      jQuery(document).find('.wizard-fieldset').each(function () {
         if (jQuery(this).hasClass('show')) {
            var formAtrr = jQuery(this).attr('data-tab-content');
            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
               if (jQuery(this).attr('data-attr') == formAtrr) {
                  jQuery(this).addClass('active');
                  var innerWidth = jQuery(this).innerWidth();
                  var position = jQuery(this).position();
                  jQuery(document).find('.form-wizard-step-move').css({
                     "left": position.left,
                     "width": innerWidth
                  });
               } else {
                  jQuery(this).removeClass('active');
               }
            });
         }
      });
   });
   jQuery(document).on("click", ".form-wizard .form-wizard-submit", function () {
      var parentFieldset = jQuery(this).parents('.wizard-fieldset');
      var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
      parentFieldset.find('.wizard-required').each(function () {
         var thisValue = jQuery(this).val();
         if (thisValue == "") {
            jQuery(this).siblings(".wizard-form-error").slideDown();
         } else {
            jQuery(this).siblings(".wizard-form-error").slideUp();
         }
      });
   });
   jQuery(".form-control").on('focus', function () {
      var tmpThis = jQuery(this).val();
      if (tmpThis == '') {
         jQuery(this).parent().addClass("focus-input");
      } else if (tmpThis != '') {
         jQuery(this).parent().addClass("focus-input");
      }
   }).on('blur', function () {
      var tmpThis = jQuery(this).val();
      if (tmpThis == '') {
         jQuery(this).parent().removeClass("focus-input");
         jQuery(this).siblings('.wizard-form-error').slideDown("3000");
      } else if (tmpThis != '') {
         jQuery(this).parent().addClass("focus-input");
         jQuery(this).siblings('.wizard-form-error').slideUp("3000");
      }
   });
});
    </script>
  