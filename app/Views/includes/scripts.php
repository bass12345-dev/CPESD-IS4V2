    <script type="text/javascript">var base_url = '<?php echo site_url(); ?>';</script>

    <!-- offset area end -->
    <script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/moment.js"></script>
   
    <script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/jquery.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo site_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="<?php echo site_url() ?>assets/js/vendor/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="<?php echo site_url() ?>assets/js/vendor/highcharts.js"></script>
  
      <!-- Start datatable js -->
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/jquery.dataTables.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/responsive.bootstrap.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/buttons.print.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/vendor/datatables/dataTables.dateTime.min.js"></script>

    <script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/buttons.html5.min.js"></script>

  

    <!-- others plugins -->
    <script src="<?php echo site_url(); ?>assets/js/plugins.js"></script>
    <!-- <script src="assets/js/scripts.js"></script> -->
    <script src="<?php echo site_url(); ?>assets/js/vendor/swal2.js" ></script>

    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/vendor/toastify.js"></script>

    <script src="<?php echo site_url(); ?>assets/js/vendor/jquery.mask.min.js" ></script>

    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/vendor/daterangepicker.min.js"></script>

    <script src="<?php echo site_url(); ?>assets/js/vendor/select2.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/vendor/jQuery.print.min.js" ></script>


  

    <script type="text/javascript">

    var _validFileExtensions = [".pdf"];    
    var validImageExtensions = [".png",".jpg","jpeg"];

     $(document).on('click','a#update-cso-status',function (e) {

        const id = $(this).data('id');
        const status = $(this).data('status');
        $('#update_cso_status_modal').modal('show');
        $('#cso_status_update option[value='+status+']').attr('selected','selected'); 
        $('input[name=cso_id]').val(id);
    });


     
    
    $(document).on('click','a#view_transaction',function (e) {

        window.open( base_url + 'view-transaction?id=' + $(this).data('id'),'_self');

})


$(document).on('click','a#view_rfa',function (e) {

        window.open( base_url + 'user/pending/update-rfa?id=' + $(this).data('id'),'_self');

})


$(document).on('click','a#view_rfa_',function (e) {

        window.open( base_url + 'view-rfa?id=' + $(this).data('id'),'_self');

})

        $(document).on('click','a#view_user',function (e) {

        window.open( base_url + 'view-user?id=' + $(this).data('id'),'_self');

})


function count_total_reffered_rfa(){


     $.ajax({
                    type: "POST",
                    url: base_url + 'api/count-reffered-rfa',
                    cache: false,
                    dataType: 'text',  
                    success: function(data){

                        $('.count_reffered_rfa').text(data);
                    }

                })

}



$(document).on('click','a.back-button',function (e) {

        history.back()

})



count_total_reffered_rfa();

    function count_total_rfa_pending(){


         $.ajax({
                    type: "POST",
                    url: base_url + 'api/count-pending-rfa',
                    cache: false,
                    dataType: 'text',  
                    success: function(data){

                        $('.count_pending_rfa').text(data);
                    }

                })

    }



    count_total_rfa_pending();



     function load_total_pending_transactions(){

            $.ajax({
                    type: "POST",
                    url: base_url + 'api/count-pending-transactions',
                    cache: false,
                    dataType: 'json',  
                    success: function(data){

                        $('.count_pending').text(data);
                    }

                })
     }

     load_total_pending_transactions();

     $(document).on('click','a#add_transactions',function (e) {

        window.open( base_url + 'user/pending-transactions/add-transaction','_self');

        });


    $(document).on('click','a#request_for_assistance',function (e) {

        window.open( base_url + 'user/request-for-assistance','_self');

        });
    
    $(document).on('click','#back-button',function (e) {window.history.back();});
   
    $('.dropdown-toggle').dropdown();

    /*================================
    Preloader
    ==================================*/

    var preloader = $('#preloader');
    $(window).on('load', function() {
        setTimeout(function() {
            preloader.fadeOut('slow', function() { $(this).remove(); });
        }, 300)
    });

    /*================================
    sidebar collapsing
    ==================================*/
    if (window.innerWidth <= 1364) {
        $('.page-container').addClass('sbar_collapsed');
    }
    $('.nav-btn').on('click', function() {
        $('.page-container').toggleClass('sbar_collapsed');
    });

    /*================================
    Start Footer resizer
    ==================================*/
    var e = function() {
        var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
        (e -= 67) < 1 && (e = 1), e > 67 && $(".main-content").css("min-height", e + "px")
    };
    $(window).ready(e), $(window).on("resize", e);

    /*================================
    sidebar menu
    ==================================*/
    $("#menu").metisMenu();

    /*================================
    slimscroll activation
    ==================================*/
    $('.menu-inner').slimScroll({
        height: 'auto'
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

    /*================================
    stickey Header
    ==================================*/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop(),
            mainHeader = $('#sticky-header'),
            mainHeaderHeight = mainHeader.innerHeight();

        // console.log(mainHeader.innerHeight());
        if (scroll > 1) {
            $("#sticky-header").addClass("sticky-menu");
        } else {
            $("#sticky-header").removeClass("sticky-menu");
        }
    });

    /*================================
    form bootstrap validation
    ==================================*/
    $('[data-toggle="popover"]').popover()

    /*------------- Start form Validation -------------*/
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: false
        });
    }
    if ($('#dataTable2').length) {
        $('#dataTable2').DataTable({
            responsive: true
        });
    }
    if ($('#dataTable3').length) {
        $('#dataTable3').DataTable({
            responsive: true
        });
    }


    /*================================
    Slicknav mobile menu
    ==================================*/
    $('ul#nav_menu').slicknav({
        prependTo: "#mobile_menu"
    });

    /*================================
    login form
    ==================================*/
    $('.form-gp input').on('focus', function() {
        $(this).parent('.form-gp').addClass('focused');
    });
    $('.form-gp input').on('focusout', function() {
        if ($(this).val().length === 0) {
            $(this).parent('.form-gp').removeClass('focused');
        }
    });

    /*================================
    slider-area background setting
    ==================================*/
    $('.settings-btn, .offset-close').on('click', function() {
        $('.offset-area').toggleClass('show_hide');
        $('.settings-btn').toggleClass('active');
    });

    /*================================
    Owl Carousel
    ==================================*/
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

    /*================================
    Fullscreen Page
    ==================================*/

    if ($('#full-view').length) {

        var requestFullscreen = function(ele) {
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

        var exitFullscreen = function() {
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

        fsDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            requestFullscreen(document.documentElement);
            $('body').addClass('expanded');
        });

        fsExitDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            exitFullscreen();
            $('body').removeClass('expanded');
        });
    }


    jQuery(document).ready(function() {
    // click on next button
    jQuery('.form-wizard-next-btn').click(function() {
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        var next = jQuery(this);
        var nextWizardStep = true;
        parentFieldset.find('.wizard-required').each(function(){
            var thisValue = jQuery(this).val();

            console.log(thisValue)

            if( thisValue == "") {
                jQuery(this).siblings(".wizard-form-error").slideDown();
                nextWizardStep = false;
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
        if( nextWizardStep) {
            next.parents('.wizard-fieldset').removeClass("show","400");
            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");


           


            jQuery(document).find('.wizard-fieldset').each(function(){
                if(jQuery(this).hasClass('show')){
                    var formAtrr = jQuery(this).attr('data-tab-content');
                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                        if(jQuery(this).attr('data-attr') == formAtrr){
                            jQuery(this).addClass('active');
                            var innerWidth = jQuery(this).innerWidth();
                            var position = jQuery(this).position();
                            jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});





                        }else{
                            jQuery(this).removeClass('active');
                        }
                    });
                }
            });
        }
    });
    //click on previous button
    jQuery('.form-wizard-previous-btn').click(function() {
        var counter = parseInt(jQuery(".wizard-counter").text());;
        var prev =jQuery(this);
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        prev.parents('.wizard-fieldset').removeClass("show","400");
        prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
        currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
        jQuery(document).find('.wizard-fieldset').each(function(){
            if(jQuery(this).hasClass('show')){
                var formAtrr = jQuery(this).attr('data-tab-content');
                jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                    if(jQuery(this).attr('data-attr') == formAtrr){
                        jQuery(this).addClass('active');
                        var innerWidth = jQuery(this).innerWidth();
                        var position = jQuery(this).position();
                        jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                    }else{
                        jQuery(this).removeClass('active');
                    }
                });
            }
        });
    });
    //click on form submit button
    jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        parentFieldset.find('.wizard-required').each(function() {
            var thisValue = jQuery(this).val();
            if( thisValue == "" ) {
                jQuery(this).siblings(".wizard-form-error").slideDown();
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
    });
    // focus on input field check empty or not
    jQuery(".form-control").on('focus', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().addClass("focus-input");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
        }
    }).on('blur', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().removeClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideDown("3000");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideUp("3000");
        }
    });
});



    </script>
    </script>