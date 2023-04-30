<div class="modal fade" id="update_profile_picture" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered  " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Profile Picture</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="update_profile_pic_form" class="p-2">
            <div class="modal-body">
              <input type="hidden" name="user_id">
                <div class="form-group">
                  <label for="exampleInputPassword1">Profile Picture</label><span class="text-danger">*</span>
                  <input type="file" class="form-control input" name="update_profile_picture" onchange="Validate_file(this);"  placeholder="" required>
               </div>
              
            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn  btn-update-profile sub-button " name="btn-update-cso " >Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>