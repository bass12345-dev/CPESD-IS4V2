<!doctype html>
<html class="no-js" lang="en">
   <head>
      <?php echo view('includes/meta.php') ?>
      <?php echo view('includes/css.php') ?> 

   </head>
   <body>
      <?php echo view('includes/preloader') ?> 
      <div class="page-container sbar_collapsed">
         <div class="main-content">

            <?php echo view('global/view_user/includes/view_user_topbar'); ?>
            <?php echo view('global/view_user/includes/view_user_breadcrumbs'); ?>
            <div class="main-content-inner "  style="padding: 100px;" >
                
                      <div class="row">
                        <div class="col-12 ">
                           <div class="card" style="border: 1px solid;  ">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12"> 



                                         <?php echo view('global/view_user/section/user_data_section'); ?>
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>    
               
                </div>
            </div>
         </div>
        <?php echo view('global/view_user/modals/update_profile_picture'); ?>
              <?php echo view('global/view_user/modals/update_password'); ?>
           <?php echo view('global/view_user/modals/old_password'); ?>
      <?php echo view('global/view_user/modals/update_information'); ?>
    
      <?php echo view('includes/scripts.php') ?> 
      <script src="<?php echo base_url(); ?>assets/js/overly.js"></script>

      <script type="text/javascript">

        function Validate_file(oInput) { if (oInput.type == "file") { var sFileName = oInput.value; if (sFileName.length > 0) { var blnValid = false; for (var j = 0; j < validImageExtensions.length; j++) { var sCurExtension = validImageExtensions[j]; if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) { blnValid = true; break; } } if (!blnValid) { alert("Sorry, " + sFileName + " is invalid, allowed extension is " + validImageExtensions.join(", ") + ' onlyvalidImageExtensions'); oInput.value = ""; return false; } } } return true; }function load_user_data(){ $.ajax({ type: "POST", url: base_url + 'api/get-user-data', data : {'id' : '<?php echo $_GET['id'] ?>'}, cache: false, dataType: 'json', success: function(data){ $('.name').text(data.name); $('.email_address').text(data.email_address); $('.contact_number').text(data.contact_number); $('.address').text(data.barangay); $('.username').text(data.username); $("#profile_picture").attr('src', data.profile_picture); $('input[name=first_name]').val(data.first_name); $('input[name=middle_name]').val(data.middle_name); $('input[name=last_name]').val(data.last_name); $('input[name=extension]').val(data.extension); $('select[name=barangay]').val(data.barangay); $('input[name=email_address]').val(data.email_address); $('input[name=contact_number]').val(data.contact_number); $('input[name=user_id]').val(data.user_id); $('input[name=username]').val(data.username); } }) } load_user_data();$('#update_oldpassword_form').on('submit', function(e) { e.preventDefault(); $.ajax({ type: "POST", url: base_url + 'api/verify-old-password', data : $(this).serialize(), cache: false, dataType: 'json', beforeSend: function() { $('.btn-old-password').text('Please wait...'); $('.btn-old-password').attr('disabled','disabled'); }, success: function(data) { if (data.response) { $('#old_password_modal').modal('hide'); $('.btn-old-password').text('Submit'); $('.btn-old-password').removeAttr('disabled'); $('#update_password_modal').modal('show'); }else { $('.btn-old-password').text('Submit'); $('.btn-old-password').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); } } }) });$('#update_password_form').on('submit', function(e) { e.preventDefault(); const password = $('input[name=password]').val(); const confirm_password = $('input[name=confirm_password]').val(); if (password != confirm_password) { Swal.fire({ text: "Password Don't Match", icon: "error", buttonsStyling: false, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }); }else if (confirm_password.length < 6) { Swal.fire({ text: "Password must least 6 characters", icon: "error", buttonsStyling: false, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }); }else { $.ajax({ type: "POST", url: base_url + 'api/update-password', data : $(this).serialize(), cache: false, dataType: 'json', beforeSend: function() { $('.btn-update-password').text('Please wait...'); $('.btn-update-password').attr('disabled','disabled'); }, success: function(data) { if (data.response) { $('#update_password_modal').modal('hide'); $('.btn-update-password').text('Submit'); $('.btn-update-password').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); Swal.fire({ title: "Logout?", text: "", icon: "warning", showCancelButton: true, confirmButtonText: "Confirm", cancelButtonText: "No, cancel!", reverseButtons: true }).then(function(result) { if (result.value) { window.location.href = base_url + 'api/auth/sign_out'; } else if (result.dismiss === "cancel") { swal.close() } }); }else { $('.btn-update-password').text('Submit'); $('.btn-update-password').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); } } }) } });$('#update_information_form').on('submit', function(e) { e.preventDefault(); $.ajax({ type: "POST", url: base_url + 'api/update-user-information', data: new FormData(this), contentType: false, cache: false, processData:false, dataType: 'json', beforeSend: function() { $('.btn-update-info').text('Please wait...'); $('.btn-update-info').attr('disabled','disabled'); }, success: function(data) { if (data.response) { $('#update_information_modal').modal('hide'); $('.btn-update-info').text('Save Changes'); $('.btn-update-info').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); load_user_data(); }else { $('.btn-update-info').text('Save Changes'); $('.btn-update-info').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); } }, error: function(xhr) { alert("Error occured.please try again"); $('.btn-update-info').text('Save Changes'); $('.btn-update-info').removeAttr('disabled'); }, }); });$('#update_profile_pic_form').on('submit', function(e) { e.preventDefault(); $.ajax({ type: "POST", url: base_url + 'api/update-user-profile', data: new FormData(this), contentType: false, cache: false, processData:false, dataType: 'json', beforeSend: function() { $('.btn-update-profile').text('Please wait...'); $('.btn-update-profile').attr('disabled','disabled');  JsLoadingOverlay.show({
                    'overlayBackgroundColor': '#666666',
                    'overlayOpacity': 0.6,
                    'spinnerIcon': 'ball-atom',
                    'spinnerColor': '#000',
                    'spinnerSize': '2x',
                    'overlayIDName': 'overlay',
                    'spinnerIDName': 'spinner',
                  });
 }, success: function(data) { if (data.response) { $('#update_profile_picture').modal('hide'); $('#update_profile_pic_form')[0].reset(); $('.btn-update-profile').text('Save Changes'); $('.btn-update-profile').removeAttr('disabled');  JsLoadingOverlay.hide(); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); load_user_data(); }else { $('.btn-update-profile').text('Submit'); $('.btn-update-profile').removeAttr('disabled'); Toastify({ text: data.message, className: "info", style: { "background" : "linear-gradient(to right, #00b09b, #96c93d)", "height" : "60px", "width" : "350px", "font-size" : "20px" } }).showToast(); } }, error: function(xhr) { alert("Error occured.please try again"); $('.btn-update-profile').text('Save Changes'); $('.btn-update-profile').removeAttr('disabled'); }, }); });


      </script>

   </body>
</html>