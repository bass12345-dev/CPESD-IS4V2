<div class="modal fade" id="update_aoc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update COR</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="update_aoc_form" class="p-2">
            <div class="modal-body">
              
                 <input type="" name="cso_idd">
                  <div class="form-group">
                  <label for="exampleInputPassword1">COR</label><span class="text-danger">*</span><span class="pull-right text-danger">*Pdf file only</span>
                  <input type="file" class="form-control" name="update_aoc"  placeholder="" onchange="Validate_file(this);" required>
               </div> 
              
              
              
            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn  update-aoc-cso sub-button " >Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>