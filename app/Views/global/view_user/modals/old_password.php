<div class="modal fade" id="old_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered  " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="update_oldpassword_form" class="p-2">
            <div class="modal-body">
              <input type="hidden" name="user_id">
                <div class="form-group">
                  <label for="exampleInputPassword1">Type Old Password</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="old_password"  placeholder="" required>
               </div>
              
            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn  btn-update-password sub-button " name="btn-update-cso " >Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>