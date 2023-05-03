<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php echo view('includes/css') ?>
    <?php echo view('includes/meta') ?> 
</head>

<body>
    <?php echo view('includes/preloader') ?> 
    <div class="login-area login-bg" >       
        <div class="container">
            <div class="login-box  animate__animated animate__zoomInDown" >
                <form id="login_form" style="width: 700px;">
                    <div class="login-form-head">                    
                       
                        <h1 class="mt-2" style="color: #fff;">CPESD-IS REGISTRATION</h1>
                     
                    </div>
                        <div class="login-form-body">
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" >
                                  
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Middle Name</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" >
                                  
                                  </div>


                                   <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" >
                                  
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Extension</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" >
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <select class="custom-select" id="input_barangay" name="barangay" style=" solid;height: 45px;" required>
                                               <option  value="" selected>Select Barangay</option>
                                                 <?php foreach ($barangay as $row) { ?>
                                                  <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                                                  <?php } ?>
                                </select> 
                                  </div>


                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Work Status</label>
                                    <select class="custom-select" id="input_barangay" name="barangay" style=" solid;height: 45px;" required>
                                                 <?php foreach ($work_status as $row) { ?>
                                                  <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                                                  <?php } ?>
                                </select> 
                                  </div>


                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Username</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" >
                                  </div>
                            
                            <button id="form_submit" type="submit" class="btn  btn-lg btn-block mb-4"  style="background-color: #3F6BA4; color: #fff; font-size: 15px;" >Register</button>

                             <a  class="btn  btn-lg btn-block"  style=" font-size: 15px;" >Back to Login</a>
                        </div>
                </form>
            </div>
        </div>
    </div>

<script src="<?php echo site_url(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
<!-- offset area end -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<!-- jquery latest version -->
<!-- <script src="<?php echo site_url(); ?>assets/js/vendor/jquery-2.2.4.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- bootstrap 4 js -->
<script src="<?php echo site_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.all.min.js" integrity="sha512-KfbhdnXs2iEeelTjRJ+QWO9veR3rm6BocSoNoZ4bpPIZCsE1ysIRHwV80yazSHKmX99DM0nzjoCZjsjNDE628w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
