<!doctype html>
<html class="no-js" lang="en">

<head>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('peso_logo.png') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login-bundle.css'); ?>">
   
    <?php echo view('includes/meta') ?> 
</head>

<body>

    <div class="login-area login-bg" >       
        <div class="container">
            <div class="login-box ptb--100 animate__animated animate__zoomInDown">
                <form id="login_form">
                    <div class="login-form-head">                    
                        <img src="<?php echo base_url('peso_logo.png'); ?>" width="150" height="200">
                        <h1 class="mt-2" style="color: #fff;">CPESD-IS</h1>
             
                    </div>
                        <div class="login-form-body">
                            <div class="form-gp">
                                <label for="exampleInputEmail1">Username</label>
                                    <input type="text" id="exampleInputUsername"  name="username" required >
                                        <i class="ti-user"></i>
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Password</label>
                                    <input type="password"  id="exampleInputPassword1" name="password" style="-webkit-text-security: disc;" required>
                                    <i class="ti-lock lock"></i>
                            </div>
                            
                            <button id="form_submit" type="submit" class="btn  btn-lg btn-block mb-4"  style="background-color: #3F6BA4; color: #fff; font-size: 15px;" > Log In </button>
                            <a   href="register" class="btn  btn-lg btn-block"  style="font-size: 15px;" > Register</a>

                            
                        </div>
                </form>
            </div>
        </div>
    </div>


<!-- offset area end -->


<script type="text/javascript" src="<?php echo site_url() ?>assets/js/login-bundle.js"></script>

<script type="text/javascript">

     var base_url = '<?php echo base_url(); ?>';  
     

    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        
           $.ajax({
            type: "POST",
            url: base_url + 'api/auth/verify',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                    $('#form_submit').html('<span class="loader"></span>');
                    $('#form_submit').attr('disabled','disabled');
                   
            },
            success: function(data)
            {            

                if (data.response) {

                   if (data.res) {

                         window.location.href = data.redirect;
                            
                   }else {

                  

                     Swal.fire({
                        text: data.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    $("#form_submit").removeAttr('disabled');
                     $('#form_submit').html('');
                    $('#form_submit').text('Login');
                   
                    


                   }
                }else {

                   
                    Swal.fire({
                        text: data.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    $("#form_submit").removeAttr('disabled');
                    $('#form_submit').text('Login');
                    $('#form_submit').remove('<span class="loader"></span>');
                    

                }
            }

        })
    })
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

</script>
</body>
</html>
