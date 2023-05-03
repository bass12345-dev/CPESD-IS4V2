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
                <form id="registration_form" style="width: 700px;">
                    <div class="login-form-head">                    
                       
                        <h1 class="mt-2" style="color: #fff;">CPESD-IS REGISTRATION</h1>
                     
                    </div>
                        <div class="login-form-body">
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required >
                                  
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name" >
                                  
                                  </div>


                                   <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                  
                                  </div>
                                  <div class="form-group">
                                      <i><label class="pull-right ">Jr Sr ...</label></i>
                                    <label for="exampleInputPassword1">Extension</label>
                                    <input type="extension" class="form-control"  name="extension" >
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <select class="custom-select"  name="barangay" style=" solid;height: 45px;" required>
                                               <option  value="" selected>Select Barangay</option>
                                                 <?php foreach ($barangay as $row) { ?>
                                                  <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                                                  <?php } ?>
                                </select> 
                                  </div>


                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Work Status</label>
                                    <select class="custom-select"  name="work_status" style=" solid;height: 45px;" required>
                                                 <?php foreach ($work_status as $row) { ?>
                                                  <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                                                  <?php } ?>
                                </select> 
                                  </div>


                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Username</label>
                                    <input type="text" class="form-control" name="username" required >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="text" class="form-control" name="password" required  >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="text" class="form-control" name="confirm_password" required  >
                                  </div>
                            
                            <button id="form_submit" type="submit" class="btn  btn-lg btn-block mb- btn-add-user"  style="background-color: #3F6BA4; color: #fff; font-size: 15px;" >Register</button>
                            <div class="alert"></div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.all.min.js" integrity="sha512-KfbhdnXs2iEeelTjRJ+QWO9veR3rm6BocSoNoZ4bpPIZCsE1ysIRHwV80yazSHKmX99DM0nzjoCZjsjNDE628w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">

     var base_url = '<?php echo base_url(); ?>';  
        

    
        $('#registration_form').on('submit', function(e) {
    e.preventDefault();

    const password = $('input[name=password]').val();
    const confirm_password = $('input[name=confirm_password]').val();
    const username = $('input[name=username]').val();

    if (username.length < 5) {
         Swal.fire({
                    text: "Username must least 5 characters",
                     icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                            confirmButton: "btn btn-primary"
                    }
                });
    }else if (password != confirm_password) {
        Swal.fire({
                    text: "Password Don't Match",
                     icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                            confirmButton: "btn btn-primary"
                    }
                });
    }else if (confirm_password.length < 6) {

          Swal.fire({
                    text: "Password must least 6 characters",
                     icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                            confirmButton: "btn btn-primary"
                    }
                });
    }else {

         $.ajax({
            type: "POST",
            url: base_url + 'api/register',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function() {
                $('.btn-add-user').text('Please wait...');
                $('.btn-add-user').attr('disabled','disabled');
            },
             success: function(data)
            {            
                if (data.response) {
                    $('#registration_form')[0].reset();
                    $('.btn-add-user').text('Submit');
                    $('.btn-add-user').removeAttr('disabled');
                    $('.alert').html(' <div class="alert-dismiss mt-2">\
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">\
                                                            <strong>'+data.message+'.\
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>\
                                                            </button>\
                                                            </div>\
                                                    </div>');
                    
                    setTimeout(function() { 
                        $('.alert').html('')
                    }, 3000);
                   
                }else {
                    $('.btn-add-user').text('Submit');
                    $('.btn-add-user').removeAttr('disabled');
                    $('.alert').html(' <div class="alert-dismiss mt-2">\
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">\
                                                            <strong>'+data.message+'.\
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>\
                                                            </button>\
                                                            </div>\
                                                    </div>');
                }
           },
            error: function(xhr) { // if error occured
                    alert("Error occured.please try again");
                    $('.btn-add-user').text('Submit');
                    $('.btn-add-user').removeAttr('disabled');
            },


        });


    }

    }); 

    

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
