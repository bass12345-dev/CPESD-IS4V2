<div class="row">
   <div class="col-xl-12 col-lg-5 col-md-12 mt-5">
      <div class="card">
         <div class="card-body">
            <div class="d-sm-flex flex-wrap justify-content-between mb-4 align-items-center">
               <h4 class="header-title mb-0">CPESD Member</h4>
            </div>
            <div class="member-box" id="user_list">

         <?php  foreach ($users_list as $row) {
            // code...
          ?>
          <div class="s-member">
                  <div class="media align-items-center">
                     <!-- <img src="" class="d-block ui-w-30 rounded-circle" alt=""> -->
                     <div class="media-body ml-5">
                        <p><?php echo $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension ?></p>
                        <span><?php echo $row->user_type ?></span>
                     </div>
                     <div class="tm-social">
                        <a href="#"><i class="fa fa-eye"></i></a>
                        
                     </div>
                  </div>
               </div> 

            <?php }  ?> 

            </div>
         </div>
      </div>
   </div>
</div>