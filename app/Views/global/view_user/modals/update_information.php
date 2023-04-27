<div class="modal fade" id="update_information_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="update_information_form" class="p-2">
            <div class="modal-body">
              
            <div class="form-group">
               <input type="hidden" name="user_id" >
                <div class="form-group">
                  <label for="exampleInputPassword1">Username</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="username"  placeholder="">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">First Name</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="first_name"  placeholder="">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name</label><span class="text-danger">*</span>
                  <input type="text"  class="form-control input" name="middle_name"  placeholder=""   >
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="last_name"  placeholder=""  >
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Extension</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="extension"  placeholder="">
               </div>
                <div class="form-group">
                  <label>Address<span class="text-danger">*</span></label>
                   <select class="custom-select" id="input_barangay" name="barangay" style="border: 1px solid;height: 45px;" required>
                                 <option  value="" selected>Select Barangay</option>
                                   <?php foreach ($barangay as $row) { ?>
                                    <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                                    <?php } ?>
                  </select> 
               </div>

        
                <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label><span class="text-danger">*</span>
                  <input type="email" class="form-control input" name="email_address"  placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Contact Number</label><span class="text-danger">*</span>
                  <input type="text" value="09" class="form-control input" name="contact_number"  placeholder=""  data-mask="09000000000" required>
               </div>
            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn  btn-update-info sub-button " name="btn-update-cso " >Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>