<div class="modal fade" id="update_client_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="update_client_form" class="p-2">
            <div class="modal-body">
               <div class="form-group">
                  <input type="hidden" name="client_id_">
                  <div class="col-12">First Name<span class="text-danger">*</span></div>
                  <input type="text" class="form-control input" name="update_first_name"  placeholder="" required>
               </div>
               <div class="form-group">
                  <div class="col-12">Middle Name<span class="text-danger">*</span></div>
                  <input type="text" class="form-control input" name="update_middle_name"  placeholder="" >
               </div>
              
               
               <div class="form-group">
                  <label for="exampleInputPassword1">Last Name</label><span class="text-danger">*</span>
                  <input type="text" class="form-control input" name="update_last_name"  placeholder="">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Extenstion</label><span class="text-danger">*</span>
                  <input type="text"  name="update_extension" class="form-control input">
               </div>
                <div class="form-row">
                  <div class="col-12 ml-3">Address<span class="text-danger">*</span></div>
                  <div class="form-group col-md-3">
                     <div class="input-group ">
                        <div class="input-group-prepend">
                           <span class="input-group-text" >Purok</span>
                        </div>
                        <input type="number" class="form-control input" name="update_purok"   aria-label="Username" aria-describedby="basic-addon1">
                     </div>
                  </div>
                  <div class="form-group col-md-9">
                     <div class="input-group " style="height: 45px;">
                        <div class="input-group-prepend">
                           <span class="input-group-text" for="input_barangay"  >Barangay</span>
                        </div>
                         <select class="custom-select" id="input_barangay" name="update_barangay" style="border: 1px solid;height: 45px;" required>
                           <option  value="" selected>Select Barangay</option>
                             <?php foreach ($barangay as $row) { ?>
                              <option  value="<?php echo $row ?>"><?php echo $row; ?></option>
                              <?php } ?>
                        </select>
                     </div>
                  </div>
               </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Contact Number</label><span class="text-danger">*</span>
                  <input type="text" value="09" class="form-control input" name="update_contact_number"  placeholder=""  data-mask="09000000000" required>
               </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Age</label><span class="text-danger">*</span>
                  <input type="number" class="form-control input" name="update_age"  placeholder="">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Employment Status</label><span class="text-danger">*</span>
                   <select class="custom-select"  name="update_employment_status" style="border: 1px solid;height: 45px;" required>

                        <option value="">Select Employment Status</option> 
                     <?php 

                           foreach ($employment_status as $row) : ?>

                        <option value="<?php echo $row  ?>"><?php echo $row ?></option>

                           <?php endforeach;?>
                         

                     </select>
               </div>

            </div>
            <div class="modal-footer" id="update_cso_footer">
               <button type="button" class="btn btn-danger update-cso-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn   sub-button btn-update-client" >Update</button>
            </div>
         </form>
      </div>
   </div>
</div>