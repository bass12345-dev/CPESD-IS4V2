<div class="modal fade" id="print_option_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Print Option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
         <form id="add_project_form" class="p-2">
            <div class="modal-body">
              <input type="hidden" name="cso_idd">

              <div class="row ">
                <div class="col-md-8 mb-2">
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" type="checkbox" name="options"  value="print_cso_information">
                       <label class="form-check-label" for="inlineCheckbox1">CSO Information</label>
                     </div>
                     <div class="form-check form-check-inline">
                       <input class="form-check-input" type="checkbox" id="cso_project_option" name="options"  value="print_cso_project">
                       <label class="form-check-label" for="inlineCheckbox2">CSO Project</label>
                     </div>
                      <div class="form-check form-check-inline">
                       <input class="form-check-input" type="checkbox" name="options"  value="print_cso_officers">
                       <label class="form-check-label" for="inlineCheckbox2">Officers</label>
                     </div>
                </div>
                <div class="col-md-4" id="select_year_section" hidden>
                     <select id="select_year_cso_project" class="form-control">
                       <option value="0" selected>Select Year</option>
                       <option value="2023">2023</option>
                       <option value="2024">2024</option>
                       <option value="2025">2025</option>
                     </select>
                  
                </div>
              </div>
              <div class="row mt-3">
               <button type="button" class="btn sub-button btn-block" id="generate_for_print">Generate</button>
              </div>
            </div>
           
         </form>
      </div>
   </div>
</div>