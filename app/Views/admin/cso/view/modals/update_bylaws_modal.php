<div class="modal fade" id="update_bylaws_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update ByLaws</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="update_bylaws_form" class="p-2">
            <div class="modal-body">
              
               
                  <div class="form-group">
                  <label for="exampleInputPassword1">COR</label><span class="text-danger">*</span><span class="pull-right text-danger">*Pdf file only</span>
                  <input type="file" class="form-control" name="update_cor"  placeholder="" onchange="Validate_file(this);">
               </div> 
              
              
              
            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn  btn-update-cso sub-button " name="btn-update-cso " >Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>