<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php echo view('includes/css') ?>
    <?php echo view('includes/meta') ?> 
    <style>
            

            form .error {
  color: #ff0000;
}
/*            #username:focus:invalid + label[for="username"]:after {
  content: "input must contain only letters and numbers";
  color:red;
}
*/
    </style>
</head>

<body>
    <?php echo view('includes/preloader') ?> 
    <div class="login-area login-bg" >       
        <div class="container">
            <div class="login-box  animate__animated animate__zoomInDown" >
                <form id="registration_form" style="width: 700px;">
                    <div class="login-form-head">                    
                        <img src="<?php echo base_url('peso_logo.png'); ?>" width="150" height="200">
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
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text"   class="form-control" name="email" required >
                                    <label for="username"></label>
                                  </div>

                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Contact Number</label>
                                    <input type="text"   class="form-control" name="contact_number" required >
                                    <label for="username"></label>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Username</label>
                                    <input type="text"  pattern="\w+|d\+" class="form-control" name="username" >
                                    <label for="username"></label>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="text" style="-webkit-text-security: disc;" class="form-control" name="password" required  >
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="text" style="-webkit-text-security: disc;" class="form-control" name="confirm_password" required  >
                                  </div>
                            
                            <button id="form_submit" type="submit" class="btn  btn-lg btn-block mb- btn-add-user"  style="background-color: #3F6BA4; color: #fff; font-size: 15px;" >Register</button>
                            <div class="alert"></div>
                             <a href="login" class="btn  btn-lg btn-block"  style=" font-size: 15px;" >Back to Login</a>
                        </div>
                </form>
            </div>
        </div>
    </div>


<!-- offset area end -->
<script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/moment.js"></script>
<!-- jquery latest version -->
<script type="text/javascript" src="<?php echo site_url() ?>assets/js/vendor/jquery.js"></script>
<!-- bootstrap 4 js -->
<script src="<?php echo site_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo site_url(); ?>assets/js/vendor/swal2.js" ></script>
<script src="<?php echo site_url(); ?>assets/js/vendor/validate.js" ></script>

<script type="text/javascript">

     var base_url = '<?php echo base_url(); ?>';  









 
       

         $("#registration_form").validate({

                rules: {
                    username: {
                        required: true,
                        minlength: 6,
                       
                       
                    },
                    email: {
                        required: true,
                         email: true
                       
                    },
                    contact_number : {

                        required : true,
                        digits: true,
                        minlength: 11,
                       

                    },

                     password: {
                        required: true,
                        minlength: 6,
                       
                    },
                     confirm_password: {
                        required: true,
                        minlength: 6,
                       
                    },
                   
                },
                messages: {
                    username: {
                        required: "this field is required",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    password : {

                         required: "this field is required",
                        minlength: "Your password must be at least 6 characters long"

                    },
                     confirm_password : {

                         required: "this field is required",
                        minlength: "Your password must be at least 6 characters long",
                        

                    },
                    email : {

                        required: "this field is required",
                        minlength: "Your email must be valid",

                    },
                    email : {

                        required: "this field is required",
                        minlength: "Contact Number must be 11 digit only",

                    }
                  
                },
            submitHandler: function (form) { // for demo




            const password = $('input[name=password]').val();
            const confirm_password = $('input[name=confirm_password]').val();

               if (password != confirm_password) {
                    Swal.fire({
                                text: "Password Don't Match",
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
                            data:  $("#registration_form").serialize(),
                            cache: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('.btn-add-user').text('Please wait...');
                                $('.btn-add-user').attr('disabled','disabled');
                            },
                             success: function(data)
                            {            
                                if (data.response) {

                                    $("#registration_form")[0].reset();
                                           Swal.fire({
                                        text: data.message,
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });


                                   
                                 $('.btn-add-user').text('Register');
                                 $(".btn-add-user").removeAttr('disabled');
                                    
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


                                $('.btn-add-user').text('Register');
                                 $(".btn-add-user").removeAttr('disabled');
                                    
                                }
                           },
                            error: function(xhr) { // if error occured
                                    alert("Error occured.please try again");
                                   
                            },


                        });




                }
               
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
