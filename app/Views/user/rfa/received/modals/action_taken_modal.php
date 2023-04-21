


<div class="modal fade" id="add_action_taken_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="add_action_taken_form" class="p-2">
            <div class="modal-body">
               <div class="form-group">
                  <div class="col-12">Action<span class="text-danger">*</span></div>
                  <textarea class="form-control input" id="action_taken_textarea" name="action_taken_textarea" ></textarea>
               </div>

               <input type="" name="transaction_type">
                <input type="" name="rfa_id">

            <div class="form-group select_user" hidden>
                  <label for="exampleInputPassword1">To : </label><span class="text-danger">*</span>
                   <select class="custom-select"  name="select_user" style="border: 1px solid;height: 45px;">

                        <option value="">Select User</option> 
                     <?php 

                           foreach ($users as $row) : ?>

                        <option value="<?php echo $row->user_id  ?>"><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension ?></option>

                           <?php endforeach;?>
                         

                     </select>
               </div>
               </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn   sub-button btn-add-rfa-action-taken" >Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>